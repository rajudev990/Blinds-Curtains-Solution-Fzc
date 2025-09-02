<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Mail\CustomerSetupInstallMail;
use App\Mail\GoogleReviewLinkMail;
use App\Mail\InstallationTimeSetupSuccessMail;
use App\Mail\InstallationTimeSetupSuccessMailDue;
use App\Mail\PaymentSuccessMail;
use App\Mail\SendProductionMail;
use App\Mail\CustomerFeedBackMail;
use App\Models\Book;
use App\Models\CatalogueItem;
use App\Models\CatalougeBook;
use Illuminate\Support\Facades\Http; // For making API requests
use App\Models\Coupon;
use App\Models\Order;
use App\Models\InstallationReview;
use App\Models\OrderDetails;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Linning;
use App\Models\Location;
use App\Models\Opening;
use App\Models\Polling;
use App\Models\FullNess;
use App\Models\PageNumber;
use App\Models\SectionTitle;
use App\Models\Setting;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use Barryvdh\DomPDF\Facade\Pdf;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;

class OrderController extends Controller
{
    public function index($id)
    {
        $order = Order::updateOrCreate(
            [
                'order_code' => rand(1111, 9999),
                'book_id'    => $id,
            ]
        );

        $notification = array(
            'message'    => 'Order Created Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.order.create', $order->order_code);
    }

    public function create($id)
    {
        $order = Order::where('order_code', $id)->first();

        $styles = Product::whereHas('category', function ($q) {
            $q->where('name', '!=', 'Accessories');
        })->get();

  

        $accessories = Product::whereHas('category', function ($q) {
            $q->where('name', '=', 'Accessories');
        })->get();
        $cataloge = Catalogue::where('status',1)->get();
        
        $fullness = FullNess::where('status',1)->get();
        $polling = Polling::where('status',1)->get();
        $opening = Opening::where('status',1)->get();
        $location = Location::where('status',1)->get();
        $linning = Linning::where('status',1)->get();


        $OrderItems = OrderItem::with('product','catalogueItems')->where('order_id', $order->id)->get();


        return view('admin.order.index', compact('order', 'styles', 'accessories', 'OrderItems','cataloge','fullness','polling','opening','location','linning'));
    }
    
    // public function updateStatus(Request $request)
    // {
    //     $orderItem = OrderItem::find($request->id);
        
    //     if ($orderItem) {
    //         $orderItem->status = $request->status;
    //         $orderItem->save();
    
    //         return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
    //     }
    
    //     return response()->json(['success' => false, 'message' => 'Item not found.']);
    // }
    
    
    
    public function updateOrderTotals($orderId)
    {
        $order = Order::findOrFail($orderId);
        $orderItems = OrderItem::where('order_id', $orderId)->where('status', 1)->get();
    
        $totalWindows = 0;
        $totalAccessories = 0;
    
        foreach ($orderItems as $item) {
            $itemCost = 0; // Initialize $itemCost with a default value
    
            // Ensure numeric values for dimensions
            $width = floatval($item->width ?? 0);
            $heightLeft = floatval($item->height_left ?? 0);
            $heightMiddle = floatval($item->height_middle ?? 0);
            $heightRight = floatval($item->height_right ?? 0);
            $qty = intval($item->qty ?? 0);
    
            // Ensure product-related charges are numeric
            $priceRate = floatval($item->product?->price_rate ?? 0);
            $baseCharge = floatval($item->product?->base_charge ?? 0);
            $additionalCharge = floatval($item->product?->additional_charge ?? 0);
    
            if ($item->order_type === 'windows') {
                // Get the largest height value
                $largestHeight = max([$heightLeft, $heightMiddle, $heightRight]);
    
                // Calculate cost for windows
                if ($width > 280 && $largestHeight > 260) {
                    $itemCost = (($width * $largestHeight) / 10000) * $priceRate +
                                $baseCharge +
                                (($width * $largestHeight) / 10000) * $additionalCharge;
                } else {
                    $itemCost = (($width * $largestHeight) / 10000) * $priceRate +
                                $baseCharge;
                }
    
                // Multiply by quantity
                $totalWindows += $itemCost * $qty;
            } elseif ($item->order_type === 'accessories') {
                // Accessories Calculation
                if ($item->product->cm_length === 'per piece') {
                    $lineCost = $priceRate + $baseCharge;
                    $itemCost = $lineCost * $qty;
                } elseif ($item->product->cm_length === 'per line meter') {
                    $lineCost = (($width / 100) * ($priceRate + $baseCharge));
                    $itemCost = $lineCost * $qty;
                }
    
                // Add to totalAccessories
                $totalAccessories += $itemCost;
            }
        }
    
        // Subtotal before discounts
        $subtotal = $totalWindows + $totalAccessories;
    
        // Apply coupon discount
        $discountAmount = 0;
        if ($order->order_coupon && $subtotal > 0) {
            $discountAmount = ($order->order_coupon / 100) * $subtotal;
        }
    
        // Subtotal after discount
        $subtotalAfterDiscount = $subtotal - $discountAmount;
    
        // Add 5% VAT
        $vatAmount = (5 / 100) * $subtotalAfterDiscount;
    
        // Final total with VAT
        $total = $subtotalAfterDiscount + $vatAmount;
    
        // Calculate monthly payment (3 installments)
        $paymonthly = $total / 3;
    
        // Update order in the database
        $order->update([
            'order_total'    => number_format($total,2),
            'order_subtotal' => number_format($subtotal,2),
            'payment_monthly' => number_format($paymonthly,2),
            'order_coupon'   => $order->order_coupon
        ]);
    
        return response()->json(['success' => true, 'message' => 'Order updated successfully!']);
    }
    
    public function updateStatus(Request $request)
    {
        $orderItem = OrderItem::find($request->id);
    
        if ($orderItem) {
            $orderItem->status = $request->status;
            $orderItem->save();
    
            // Update order totals
            $this->updateOrderTotals($orderItem->order_id);
    
            return response()->json(['success' => true, 'message' => 'Status updated successfully!']);
        }
    
        return response()->json(['success' => false, 'message' => 'Item not found.']);
    }


    public function noteCreate(Request $request, $id)
    {
        $order = Order::where('id', $id)->first();

        $order_media = $request->hasFile('order_media') ? ImageHelper::uploadImage($request->file('order_media')) : null;

        if ($request->hasFile('order_media') && $order->order_media) {
            Storage::disk('public')->delete($order->order_media);
        }

       
        $order->updateOrCreate(
            [
                'id' => $id,
            ],
            [
                'order_note' => $request->order_note ?? null,
                'order_media' => $order_media ?? null,
            ]
        );

        $notification = array(
            'message'    => 'Save Successfully !!!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function itemCreate(Request $request, $orderId)
    {

        // dd($request->all());
        $request->validate([
            'catalogue_id.*' => 'required|integer',
            'catalogue_book_id.*' => 'required|integer',
            'page_number_id.*' => 'nullable|integer',
            'catalouge_qty.*' => 'nullable',
            // 'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/order_items'), $imageName);
                $images[] = $imageName;
            }
        }
        
        $orderItem = OrderItem::create([
            'order_id'      => $orderId,
            'order_type'    => $request->order_type,
            'status'        => $request->status ?? 0,
            'window_name'   => $request->window_name ?? null,
            'fullness'      => $request->fullness ?? null,
            'width'         => $request->width ?? null,
            'height'         => $request->height ?? null,
            'window_id'         => $request->window_id ?? null,
            'polling'       => $request->polling ?? null,
            'height_left'   => $request->height_left ?? null,
            'opening'       => $request->opening ?? null,
            'height_middle' => $request->height_middle ?? null,
            'location'      => $request->location ?? null,
            'height_right'  => $request->height_right ?? null,
            'lining'        => $request->lining ?? null,
            'comment'       => $request->comment ?? null,
            'product_id'    => $request->product_id ?? null,
            'description'   => $request->description ?? null,
            'qty'           => $request->qty ?? null,
            'status'           => $request->status,
            'images' => json_encode($images),
        ]);


        // Fetch the ID of the newly created OrderItem
        $orderItemId = $orderItem->id; // Use the ID, not the object itself

        if($request->catalogue_id)
        {
            foreach ($request->catalogue_id as $key => $catalogueId) {
                CatalogueItem::create([
                    'order_item_id' => $orderItemId, // This should be an integer
                    'catalogue_id' => $catalogueId, // Cast to integer
                    'catalogue_book_id' => $request->catalogue_book_id[$key], // Cast to integer
                    'page_number_id' => $request->page_number_id[$key] ?? '',// Cast to integer
                    'qty' => $request->catalouge_qty[$key] ?? '' // Cast to integer
                ]);
            }
        }


        

        $notification = array(
            'message'    => 'Item Created Successfully !!!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function itemCopy($id)
    {

       
        $item = OrderItem::with('catalogueItems')->findOrFail($id);
        // dd($item);

        // Create a new OrderItem and get the instance
        $orderItem = OrderItem::create([
            'order_id'      => $item->order_id,
            'order_type'    => $item->order_type,
            'status'        => $item->status ?? 0,
            'window_name'   => $item->window_name ?? null,
            'fullness'      => $item->fullness ?? null,
            'width'         => $item->width ?? null,
            'height'         => $item->height ?? null,
            'window_id'      => $item->window_id ?? null,
            'polling'       => $item->polling ?? null,
            'height_left'   => $item->height_left ?? null,
            'opening'       => $item->opening ?? null,
            'height_middle' => $item->height_middle ?? null,
            'location'      => $item->location ?? null,
            'height_right'  => $item->height_right ?? null,
            'lining'        => $item->lining ?? null,
            'comment'       => $item->comment ?? null,
            'product_id'    => $item->product_id ?? null,
            'description'   => $item->description ?? null,
            'qty'           => $item->qty ?? null,
            'status'           => $item->status ?? 0,
            'images' =>        $item->images,
        ]);

        // Check if there are associated CatalogueItems to replicate
        if($item->catalogueItems)
        {
            // Loop through the associated catalogue items and copy them for the new OrderItem
            foreach ($item->catalogueItems as $catalogueItem) {
                CatalogueItem::create([
                    'order_item_id'     => $orderItem->id, // Link to the new OrderItem
                    'catalogue_id'      => $catalogueItem->catalogue_id, // Use the existing catalogue_id value
                    'catalogue_book_id' => $catalogueItem->catalogue_book_id, // Use the existing catalogue_book_id value
                    'page_number_id'    => $catalogueItem->page_number_id ?? '', // Use the existing page_number_id value
                    'qty'    => $catalogueItem->catalouge_qty ?? '' // Use the existing page_number_id value
                ]);
            }
        }

    

        $notification = [
            'message'    => 'Item copied successfully!',
            'alert-type' => 'success',
        ];

        return back()->with($notification);
    }

    public function itemupdate(Request $request, $id)
    {

        // Validate input data
        $request->validate([
            'catalogue_id.*' => 'required|integer',
            'catalogue_book_id.*' => 'required|integer',
            'page_number_id.*' => 'nullable|integer',
            'catalouge_qty.*' => 'nullable',
            // 'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Find the existing OrderItem
        $orderItem = OrderItem::findOrFail($id);

        $images = json_decode($orderItem->images, true) ?? [];

        // If new images are uploaded
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('uploads/order_items'), $imageName);
                $images[] = $imageName;
            }
        }

        // Update the OrderItem record
        $orderItem->update([
            'order_id'      => $request->orderId,
            'order_type'    => $request->order_type,
            'status'        => $request->status ?? 0,
            'window_name'   => $request->window_name ?? null,
            'fullness'      => $request->fullness ?? null,
            'width'         => $request->width ?? null,
            'height'         => $request->height ?? null,
            'window_id'      => $request->window_id ?? null,
            'polling'       => $request->polling ?? null,
            'height_left'   => $request->height_left ?? null,
            'opening'       => $request->opening ?? null,
            'height_middle' => $request->height_middle ?? null,
            'location'      => $request->location ?? null,
            'height_right'  => $request->height_right ?? null,
            'lining'        => $request->lining ?? null,
            'comment'       => $request->comment ?? null,
            'product_id'    => $request->product_id ?? null,
            'description'   => $request->description ?? null,
            'qty'           => $request->qty ?? null,
            'status'           => $request->status,
            'images' => json_encode($images),
        ]);

        // Sync catalogue items (delete and recreate existing records)
        if($request->catalogue_id)
        {
            // Delete existing CatalogueItems related to this OrderItem
            CatalogueItem::where('order_item_id', $orderItem->id)->delete();

            // Recreate CatalogueItems based on the submitted data
            foreach ($request->catalogue_id as $key => $catalogueId) {
                CatalogueItem::create([
                    'order_item_id' => $orderItem->id,
                    'catalogue_id' => $catalogueId,
                    'catalogue_book_id' => $request->catalogue_book_id[$key],
                    'page_number_id' => $request->page_number_id[$key] ?? '',
                    'qty' => $request->catalouge_qty[$key] ?? ''
                ]);
            }
        }

        // Success notification
        $notification = array(
            'message'    => 'Item Updated Successfully !!!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function removeImage(Request $request, $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $images = json_decode($orderItem->images, true);

        if (($key = array_search($request->image_name, $images)) !== false) {
            unset($images[$key]);

            // Delete the image from the server
            $imagePath = public_path('uploads/order_items/' . $request->image_name);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            // Update the images field
            $orderItem->images = json_encode(array_values($images));
            $orderItem->save();
        }

        return response()->json(['success' => 'Image removed successfully!']);
    }

    public function itemDelete($id)
    {
        $order = OrderItem::findOrFail($id);

        $order->catalogueItems()->delete();

         // Find and delete all OrderItems where window_id matches the given id
        OrderItem::where('window_id', $id)->each(function ($relatedOrder) {
            // Delete related catalogue items for each related order
            $relatedOrder->catalogueItems()->delete();
            $relatedOrder->delete();
        });

        $order->delete();

        $notification = array(
            'message'    => 'Item Deleted Successfully !!!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function couponApply(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);


        // Find the order by corder_code (assuming corder_code is a unique identifier for the order)
        $order = Order::where('order_code', $request->coupon_id)->first();

        // If order is found
        if ($order) {
            // Check if the coupon exists in the Coupon model
            $coupon = Coupon::where('name', $request->name)->first();

            // If the coupon exists, update the order
            if ($coupon) {
                $order->update([
                    'order_coupon' => $coupon->amount,  // Replace this with the actual field and value you want to update
                ]);

                $notification = array(
                    'message'    => 'Coupon Applied Successfully !!!',
                    'alert-type' => 'success',
                );
                return back()->with($notification);
            } else {
                $notification = array(
                    'message'    => 'Coupon Not Available !!!',
                    'alert-type' => 'error',
                );
                return back()->with($notification);
            }
        }

       

        // $coupon = Coupon::where('name', $request->name)
        //     ->where('status', 1)
        //     ->first();

        // if ($coupon && $coupon->status == 1) {
        //     Session::put('coupon', [
        //         'name'   => $coupon->name,
        //         'amount' => $coupon->amount,
        //     ]);

        //     $notification = array(
        //         'message'    => 'Coupon Applied Successfully !!!',
        //         'alert-type' => 'success',
        //     );
        //     return back()->with($notification);
        // } else {

        //     $notification = array(
        //         'message'    => 'Coupon Not Available !!!',
        //         'alert-type' => 'error',
        //     );
        //     return back()->with($notification);
        // }
    }

    public function orderSave(Request $request)
    {
        // if (Session::has('coupon')) {
        //     $order_total = $request->total - (Session::get('coupon')['amount'] / 100) * $request->total;
        //     $monthly = $order_total / 3;
        // } else {
        //     $order_total = $request->total;
        //     $monthly = $order_total / 3;
        // }

        // if ($request->coupon) {
        //     $order_total = $request->total - ($request->coupon / 100) * $request->total;
        //     $monthly = $order_total / 3;
        // } else {
        //     $order_total = $request->total;
        //     $monthly = $order_total / 3;
        // }

        $order = Order::findOrFail($request->order_id);
        
        // dd($request->all());

        $order->update([
            'order_total'    => $request->total,
            'order_subtotal' => $request->subtotal,
            'payment_monthly' => $request->monthly,
            'order_coupon' =>  $request->coupon,
        ]);

        return response()->json([
            'message'    => 'Order Save Successfully',
            'alert-type' => 'success',
        ]);
    }

    public function userPayment(Request $request, $code)
    {
        $request->validate([
            'payment_status' => 'required',
        ], [
            'payment_status.required' => 'Please Select Payment Option.',
        ]);
    
        // Update the order information
        $order = Order::where('order_code', $code)->first();
        $order->update([
            'payment_status' => $request->payment_status,
            'status' => 'payment',
            'paid' => $request->amount,
            'mail_send' => 'complete',
            'mail_send_date' => now(),
            'payment_method' => 'ziina'
        ]);
    
        // Prepare data for Ziina Payment API
        $paymentData = [
            'amount' => $request->amount * 100, // Amount in fils (100 AED = 10000 fils)
            'currency' => 'AED',
            'success_url' => route('payment.success', ['payment_intent_id' => $code]), // Success URL
            'cancel_url' => route('payment.cancel', ['payment_intent_id' => $code]), // Cancel URL
        ];
        
        
        // Call Ziina Payment API to create the Payment Intent
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'Bearer ' . env('ZIINA_API_KEY'), // API key
        ])->post('https://api-v2.ziina.com/api/payment_intent', $paymentData);
        
        // Handle API response
        if ($response->successful()) {
            // Get the payment intent details from the response
            $paymentIntent = $response->json();
            $paymentIntentId = $paymentIntent['id']; // Extract the payment_intent_id
    
            // Update the success and cancel URLs with the actual payment_intent_id
            $successUrl = route('payment.success', ['payment_intent_id' => $paymentIntentId]);
            $cancelUrl = route('payment.cancel', ['payment_intent_id' => $paymentIntentId]);
    
            // Redirect the user to the Ziina payment page
            return redirect($paymentIntent['redirect_url'] . '?success_url=' . urlencode($successUrl) . '&cancel_url=' . urlencode($cancelUrl));
        } else {
            // Handle failure response
            return redirect()->back()->with('error', 'Payment creation failed. Please try again.');
        }
        
    }
    
   public function paymentConfirmHalf($id)
    {
        $order = Order::findOrFail($id);
    
        // Ensure order total is a valid float
        $orderTotal = (float) preg_replace('/[^0-9.]/', '', $order->order_total);
        
        // Default values
        $totalAfterDiscount = $orderTotal;
        
        // If coupon exists and is greater than zero, apply discount
        if (!empty($order->coupon)) {
            $coupon = (float) preg_replace('/[^0-9.]/', '', $order->coupon);
            
            if ($coupon > 0) {
                $discountAmount = ($orderTotal * $coupon) / 100;
                $totalAfterDiscount = $orderTotal - $discountAmount;
            }
        }
    
        // Calculate half total
        $halfTotal = $totalAfterDiscount / 2;
        
    
    
        // Update order payment status
        $order->update([
            'payment_status' => 'half',
            'status' => 'payment',
            'mail_send' => 'complete',
            'mail_send_date' => now(),
        ]);
    
        // Create order details record
        OrderDetails::create([
            'order_id'        => $order->id,
            'amount'          => $halfTotal,
            'payment_method'  => 'Cash 50% Advance',
            'currency_code'   => 'AED',
            'transaction_id'  => '1111000011110000',
            'transaction_date'=> now(),
        ]);
        
        
        $phoneNumber = $order->book->phone;
        $name = $order->book->name;
        $orderId = $order->order_code;
        $link = 'https://g.page/r/CVd284EcuEI0EBE/review';
        
        // Optionally, send an email to the customer
        Mail::to($order->book->email)->send(new PaymentSuccessMail($order));
        Mail::to('admin@curtainssolutions.com')->send(new PaymentSuccessMail($order));


        $apidata = [
            "apiKey" =>"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
            "campaignName" => "step_four",
            "destination" => $phoneNumber,
            "userName" => "Blinds & Curtains Solution Fzc",
            "templateParams" => [
                "$name",
                "$orderId",

            ],
            "source" => "new-landing-page form",
            "media" => [],
            "buttons" =>[],
            "carouselCards" => [],
            "location" => [],
            "paramsFallbackValue" => [
                "FirstName" => '$name'
            ]
        ];
    
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://backend.aisensy.com/campaign/t1/api/v2', $apidata);
        
        
        
        
         $notification = array(
             'message'    => 'Payment confirmed successfully',
             'alert-type' => 'success',
         );
 
         return redirect()->back()->with($notification);
    
    }
    
    public function paymentConfirmFull($id)
    {
        $order = Order::findOrFail($id);
    
        // Ensure order total is a valid float
        $orderTotal = (float) preg_replace('/[^0-9.]/', '', $order->order_total);
        
        // Default values
        $totalAfterDiscount = $orderTotal;
        
        // If coupon exists and is greater than zero, apply discount
        if (!empty($order->coupon)) {
            $coupon = (float) preg_replace('/[^0-9.]/', '', $order->coupon);
            
            if ($coupon > 0) {
                $discountAmount = ($orderTotal * $coupon) / 100;
                $totalAfterDiscount = $orderTotal - $discountAmount;
            }
        }
    
        // Calculate half total
        $halfTotal = $totalAfterDiscount;
        
    
        // Update order payment status
        $order->update([
            'payment_status' => 'half',
            'status' => 'payment',
            'mail_send' => 'complete',
            'mail_send_date' => now(),
        ]);
    
        // Create order details record
        OrderDetails::create([
            'order_id'        => $order->id,
            'amount'          => $halfTotal,
            'payment_method'  => 'Cash 100%',
            'currency_code'   => 'AED',
            'transaction_id'  => '1111000011110000',
            'transaction_date'=> now(),
        ]);
        
        
        $phoneNumber = $order->book->phone;
        $name = $order->book->name;
        $orderId = $order->order_code;
        $link = 'https://g.page/r/CVd284EcuEI0EBE/review';
        
        Mail::to($order->book->email)->send(new GoogleReviewLinkMail($order));
        Mail::to('admin@curtainssolutions.com')->send(new GoogleReviewLinkMail($order));
        
        $apidata = [
            "apiKey" =>"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
            "campaignName" => "step_eight",
            "destination" => $phoneNumber,
            "userName" => "Blinds & Curtains Solution Fzc",
            "templateParams" => [
                "$name",
                "$orderId",
                "$link",
                

            ],
            "source" => "new-landing-page form",
            "media" => [],
            "buttons" =>[],
            "carouselCards" => [],
            "location" => [],
            "paramsFallbackValue" => [
                "FirstName" => '$name'
            ]
        ];
    
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://backend.aisensy.com/campaign/t1/api/v2', $apidata);

            
        
         $notification = array(
             'message'    => 'Payment confirmed successfully',
             'alert-type' => 'success',
         );
 
         return redirect()->back()->with($notification);
    
    }
    
    
    public function paymentConfirmFullTabby($id)
    {
        $order = Order::findOrFail($id);
    
        // Ensure order total is a valid float
        $orderTotal = (float) preg_replace('/[^0-9.]/', '', $order->order_total);
        
        // Default values
        $totalAfterDiscount = $orderTotal;
        
        // If coupon exists and is greater than zero, apply discount
        if (!empty($order->coupon)) {
            $coupon = (float) preg_replace('/[^0-9.]/', '', $order->coupon);
            
            if ($coupon > 0) {
                $discountAmount = ($orderTotal * $coupon) / 100;
                $totalAfterDiscount = $orderTotal - $discountAmount;
            }
        }
    
        // Calculate half total
        $halfTotal = $totalAfterDiscount;
        
    
        // Update order payment status
        $order->update([
            'payment_status' => 'half',
            'status' => 'payment',
            'mail_send' => 'complete',
            'mail_send_date' => now(),
        ]);
    
        // Create order details record
        OrderDetails::create([
            'order_id'        => $order->id,
            'amount'          => $halfTotal,
            'payment_method'  => 'Tabby 100%',
            'currency_code'   => 'AED',
            'transaction_id'  => '1111000011110000',
            'transaction_date'=> now(),
        ]);
        
        
        $phoneNumber = $order->book->phone;
        $name = $order->book->name;
        $orderId = $order->order_code;
        $link = 'https://g.page/r/CVd284EcuEI0EBE/review';
        
        Mail::to($order->book->email)->send(new GoogleReviewLinkMail($order));
        Mail::to('admin@curtainssolutions.com')->send(new GoogleReviewLinkMail($order));
        
        $apidata = [
            "apiKey" =>"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
            "campaignName" => "step_eight",
            "destination" => $phoneNumber,
            "userName" => "Blinds & Curtains Solution Fzc",
            "templateParams" => [
                "$name",
                "$orderId",
                "$link",
                

            ],
            "source" => "new-landing-page form",
            "media" => [],
            "buttons" =>[],
            "carouselCards" => [],
            "location" => [],
            "paramsFallbackValue" => [
                "FirstName" => '$name'
            ]
        ];
    
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://backend.aisensy.com/campaign/t1/api/v2', $apidata);

            
        
         $notification = array(
             'message'    => 'Payment confirmed successfully',
             'alert-type' => 'success',
         );
 
         return redirect()->back()->with($notification);
    
    }
    


     // order remove

     public function orderRemove($id)
     {
         
        $data = Order::findOrFail($id);
        $data->orderDetails()->delete();

        // Find and delete all OrderItems
        $data->OrderItems()->each(function ($relatedOrderItem) {
            // Delete related CatalogueItems for each OrderItem
            $relatedOrderItem->catalogueItems()->delete();
            $relatedOrderItem->delete();
        });

        $data->OrderItems()->delete();

        // Delete related Feedback
        $data->feedback()->delete();

        // Finally, delete the Order itself
        $data->delete();


         $notification = array(
             'message'    => 'Order Remove Successfully !!!!',
             'alert-type' => 'success',
         );
 
         return redirect()->back()->with($notification);
 
     }
    
    
    // payment list
    public function paymentList()
    {
        $data = Order::with('OrderItems','book','orderDetails')->where('status','payment')->latest()->paginate(10);
        return view('admin.order.payment-list', compact('data'));
    }
    public function paymentConfirm($id)
    {
        $data = Order::findOrFail($id);
        $data->update([
        'status' => 'production'
        ]);


        // Optionally, send an email to the customer
        // Mail::to($data->book->email)->send(new SendProductionMail($data));
        // Mail::to('admin@curtainssolutions.com')->send(new SendProductionMail($data));


        $notification = array(
            'message'    => 'Send Production Team Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);

    }

    // order view

    public function orderShow($id)
    {
        $order = Order::with('OrderItems','book','orderDetails')->findOrFail($id);
        return view('admin.order.order-view', compact('order'));
    }
    public function orderShowPrint($id)
    {
        $order = Order::with('OrderItems','book','orderDetails')->findOrFail($id);
        return view('admin.order.order-view-print', compact('order'));
    }



    public function orderProductionShowPrint($id)
    {
        $order = Order::with('OrderItems', 'book', 'orderDetails')->findOrFail($id);
    
        // Generate barcode
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode($order->order_code, $generator::TYPE_CODE_128));
    
        // Generate PDF with 120mm x 80mm dimensions
        $pdf = Pdf::loadView('admin.order.order-production-print', compact('order', 'barcode'));
        $pdf->setPaper([0, 0, 340.16, 226.77]); // 120mm x 80mm in points
    
        return $pdf->stream('invoice-' . $order->order_code . '.pdf');
    }

    
    
    
    // product list
    public function productionList(Request $request)
    {
        // $data = Order::with('OrderItems','book','orderDetails')->where('status','production')->orWhere('status','installation-time')->latest()->paginate(10);
        // return view('admin.order.production-list', compact('data'));
        
        $status = $request->input('status', 'all'); // Default to 'all' if no status is provided

        $query = Order::with('OrderItems', 'book', 'orderDetails');
    
        // Apply filtering based on status
        if ($status === 'production-processing') {
            $query->where('status', 'production-processing');
        } elseif ($status === 'production-completed') {
            $query->where('production_status', 'production-completed');
        } elseif ($status === 'all') {
            $query->whereIn('status', ['production', 'installation-time','production-processing'])->orWhere('production_status','production-completed');
        }
    
        $data = $query->latest()->paginate(20);
    
        return view('admin.order.production-list', compact('data'));
    
    
    }
    
    public function productionProcessing($id)
    {
        $production = Order::findOrFail($id);
        $production->update([
        'status' => 'production-processing'
        ]);
        
        // Handle the case where the book relationship is missing
        $notification = [
            'message' => 'Production Accept !!!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    

    }
    
    public function productionConfirm($id)
    {
        $production = Order::findOrFail($id);
        $production->update([
        'status' => 'installation-time'
        ]);
        
        // Ensure the book relationship exists
        if ($production->book) {
            $data = [];
            $data['book_id'] = $production->book->book_id;
            $data['order_code'] = $production->order_code;
            $data['name'] = $production->book->name;
            $data['link'] = route('admin.order.install-time', $production->order_code);

            $email = $production->book->email;

           
            // Send the email
            // Mail::to($email)->send(new CustomerSetupInstallMail($data));
            Mail::to('admin@curtainssolutions.com')->send(new CustomerSetupInstallMail($data));
            
            $phoneNumber = $production->book->phone;
            $orderId = $production->order_code;
            $link = route('admin.order.install-time', $production->order_code);
            $name = $production->book->name;
            
            $apidata = [
            "apiKey" =>"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
            "campaignName" => "step_five",
            "destination" => $phoneNumber,
            "userName" => "Blinds & Curtains Solution Fzc",
            "templateParams" => [
                "$name",
                "$orderId",
                "$link",

            ],
            "source" => "new-landing-page form",
            "media" => [],
            "buttons" =>[],
            "carouselCards" => [],
            "location" => [],
            "paramsFallbackValue" => [
                "FirstName" => '$name'
            ]
        ];
    
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://backend.aisensy.com/campaign/t1/api/v2', $apidata);

         if ($response->successful()) {
            $notification = array(
                'message'    => 'Send successfully',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
         } else {
            $notification = array(
                'message'    => 'Send successfully',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
            
         }
            
            
            
        }

    }

    // new time setup

    public function getInstallTimes(Request $request)
    {
        $date = $request->input('date');
        $orderCode = $request->input('order_code');

        // Find the order and its items
        $order = Order::where('order_code', $orderCode)->first();
        $orderItems = $order->orderItems;

        // Get the order items and group by order_type
        $windowsItems = $orderItems->where('order_type', 'windows');
        $accessoriesItems = $orderItems->where('order_type', 'accessories');

        $totalWindowsTime = 0;
        $totalAccessoriesTime = 0;
        $baseExtraTime = 30; // 30 minutes extra for all items

        // Check the conditions:
        // 1. If only windows items are present, calculate the total time for windows
        if ($windowsItems->isNotEmpty() && $accessoriesItems->isEmpty()) {
            $totalWindowsTime = ($windowsItems->count() * 45);
        }

        // 2. If only accessories items are present, calculate the total time for accessories
        // elseif ($accessoriesItems->isNotEmpty() && $windowsItems->isEmpty()) {
        //     $totalAccessoriesTime = ($accessoriesItems->count() * 30);
        // }

        elseif ($accessoriesItems->isNotEmpty()) {
            // $totalAccessoriesTime = ($accessoriesItems->count() * 30);
            $totalAccessoriesTime = (1 * 30);
        }

        // 3. If both windows and accessories are present, calculate time only for windows
        elseif ($windowsItems->isNotEmpty() && $accessoriesItems->isNotEmpty()) {
            $totalWindowsTime = ($windowsItems->count() * 45);
        }

        // Total time required for the order
        $totalTime = $totalWindowsTime + $totalAccessoriesTime + $baseExtraTime;

        // Total time required for the order
        $totalTime = $totalWindowsTime + $totalAccessoriesTime + $baseExtraTime;

        // Define the working hours: 9 AM to 7 PM
        $startTime = Carbon::createFromTime(9, 0); // Start at 9:00 AM
        $endTime = Carbon::createFromTime(19, 0); // End at 7:00 PM

        // Retrieve already booked times for the selected date
        $bookedSlots = Order::where('install_date', $date)->pluck('install_time')->toArray();

        $timeSlots = [];

        // Loop through the time range and generate available time slots
        while ($startTime->lt($endTime)) {
            $endSlotTime = (clone $startTime)->addMinutes($totalTime); // Calculate the end time for this slot

            // Ensure the slot does not exceed the end time (7 PM)
            if ($endSlotTime->gt($endTime)) {
                break;
            }

            // Check if the current slot overlaps with any booked time slots
            $slotTaken = false;
            foreach ($bookedSlots as $bookedTime) {
                // Split the booked time into start and end times (e.g., "09:00 - 11:00")
                [$startBookedTime, $endBookedTime] = explode(' - ', $bookedTime);

                // Parse the start and end times
                $bookedStartTime = Carbon::createFromFormat('H:i', trim($startBookedTime));
                $bookedEndTime = Carbon::createFromFormat('H:i', trim($endBookedTime));

                // Check for any overlap between current and booked slots
                if (
                    $startTime->between($bookedStartTime, $bookedEndTime) ||
                    $endSlotTime->between($bookedStartTime, $bookedEndTime) ||
                    $startBookedTime == $startTime->format('H:i') ||
                    $endBookedTime == $endSlotTime->format('H:i')
                ) {
                    $slotTaken = true;
                    break;
                }
            }

            // If no overlap with booked times, add the slot
            if (!$slotTaken) {
                $timeSlots[] = [
                    'start' => $startTime->format('H:i'),
                    'end' => $endSlotTime->format('H:i')
                ];
            }

            // Move to the next slot, adding the total time for the current order + 60 minutes gap
            $startTime->addMinutes($totalTime + 60);
        }

        // Render the available time slots as HTML (using a Blade view)
        $html = view('admin.order.time-slots', compact('timeSlots'))->render();

        return response()->json([
            'html' => $html
        ]);
    }

    
    
    public function installTime($code)
    {
        $data = Order::with('book')->where('order_code', $code)->first();
        $settings = SectionTitle::first();
        if($data->install_date != null)
        {
            $notification = array(
            'message'    => 'Sorry You Are not A Customer !!!',
            'alert-type' => 'error',
            );
            return redirect()->to('/')->with($notification);
        }else{
            return view('admin.order.customerTimeForm', compact('data','settings'));
            
        }
    }
    
    public function timeShedule(Request $request, $code)
    {
        $data = Order::with('book')->where('order_code', $code)->first();
        
        $data->update([
            'install_date' => $request->install_date,
            'install_time' => $request->install_time,
            'install_note' => $request->install_note,
            'status' => 'installation',
            'production_status' => 'production-completed'  
        ]);

        // Optionally, send an email to the customer
        Mail::to($data->book->email)->send(new InstallationTimeSetupSuccessMail($data));
        // Mail::to('admin@curtainssolutions.com')->send(new InstallationTimeSetupSuccessMail($data));
        
        $phoneNumber = $data->book->phone;
        $name = $data->book->name;
        $orderId = $data->order_code;
        $install = $data->install_date.' '.' '. $data->install_time;

        $apidata = [
            "apiKey" =>"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
            "campaignName" => "step_six",
            "destination" => $phoneNumber,
            "userName" => "Blinds & Curtains Solution Fzc",
            "templateParams" => [
                "$name",
                "$orderId",
                "$install",

            ],
            "source" => "new-landing-page form",
            "media" => [],
            "buttons" =>[],
            "carouselCards" => [],
            "location" => [],
            "paramsFallbackValue" => [
                "FirstName" => '$name'
            ]
        ];
    
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://backend.aisensy.com/campaign/t1/api/v2', $apidata);
            


        $notification = array(
            'message'    => 'Time Shedule Setup Done',
            'alert-type' => 'success',
        );
        return redirect()->to('/')->with($notification);
    }
    
    // Installation list
    public function installationList(Request $request)
    {
        // $data = Order::with('OrderItems','book')->where('status','installation')->latest()->paginate(10);
        
        $status = $request->input('status', 'all'); // Default to 'all' if no status is provided

        $query = Order::with('OrderItems', 'book');
    
        // Apply filtering based on status
        if ($status === 'installation-processing') {
            $query->where('status', 'installation-processing');
        } elseif ($status === 'installation-completed') {
            $query->where('installation_status', 'installation-completed');
        } elseif ($status === 'all') {
            $query->whereIn('status', ['installation','installation-processing'])->orWhere('installation_status','installation-completed');
        }
    
        $data = $query->latest()->paginate(10);
        
        return view('admin.order.installation-list', compact('data'));
    }
    
     public function installationProcessing($id)
    {
        $production = Order::findOrFail($id);
        $production->update([
        'status' => 'installation-processing'
        ]);
        
        // Handle the case where the book relationship is missing
        $notification = [
            'message' => 'Installation Accept !!!',
            'alert-type' => 'success',
        ];
        return redirect()->back()->with($notification);
    

    }
    
    public function feedbackLinkConfirm($id)
    {
       
        $data = Order::where('order_code',$id)->first();
        
        $data['name'] = $data->book->name;
        $data['order_code'] = $data->order_code;
        $data['link'] = route('customer-feedback',$data->order_code);

        Mail::to($data->book->email)->send(new CustomerFeedBackMail($data));

        $notification = array(
            'message'    => 'Customer Feedback Review Link Send Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
            
    }

   
    public function installationConfirm($id)
    {
        $data = Order::with('book')->findOrFail($id);
        
        $total = 0;
        $orderTotal = (float) preg_replace('/[^0-9.]/', '', $data->order_total); // Ensure numeric value
        
        $paid = (float) $data->orderDetails->sum('amount'); // Get total paid amount
        
        
        if ($data->coupon) {
            $coupon = (float) preg_replace('/[^0-9.]/', '', $data->coupon); // Ensure numeric value
            $total = $orderTotal - (($orderTotal * $coupon) / 100);
        } else {
            $total = $orderTotal;
        }
        
                
        // $total = 0;
        // if ($data->coupon) {
        //     $total = $data->order_total - (($data->coupon / 100) * $data->order_total);
        // } else {
        //     $total = $data->order_total;
        // }

        //payment complted
        // if($total == $data->orderDetails->sum('amount')){
        if($total == $paid){
            
            $data->update([
                'status' => 'feedback',
                'installation_status' => 'installation-completed'
            ]);
        
           
            Mail::to($data->book->email)->send(new GoogleReviewLinkMail($data));
            Mail::to('admin@curtainssolutions.com')->send(new GoogleReviewLinkMail($data));
            
            
            $phoneNumber = $data->book->phone;
            $name = $data->book->name;
            $orderId = $data->order_code;
            $link = 'https://g.page/r/CVd284EcuEI0EBE/review';
            // $link = route('review');
            
    
            $apidata = [
                "apiKey" =>"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
                "campaignName" => "step_eight",
                "destination" => $phoneNumber,
                "userName" => "Blinds & Curtains Solution Fzc",
                "templateParams" => [
                    "$name",
                    "$orderId",
                    "$link",
                    
    
                ],
                "source" => "new-landing-page form",
                "media" => [],
                "buttons" =>[],
                "carouselCards" => [],
                "location" => [],
                "paramsFallbackValue" => [
                    "FirstName" => '$name'
                ]
            ];
        
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://backend.aisensy.com/campaign/t1/api/v2', $apidata);
    
            
        }
        //due payment complted
        else{
           
           $data->update([
                'status' => 'feedback',
                'installation_status' => 'installation-completed',
                'mail_send' => 'due',
                'mail_send_date' => now(),
                'mail_send_count' => 0,
            ]);
            
            Mail::to($data->book->email)->send(new InstallationTimeSetupSuccessMailDue($data));
            Mail::to('admin@curtainssolutions.com')->send(new InstallationTimeSetupSuccessMailDue($data));
            
            $phoneNumber = $data->book->phone;
            $name = $data->book->name;
            $orderId = $data->order_code;
            $link = route('admin.order.checkout',$data->order_code);
            $invoice = route('admin.order.invoice',$data->order_code);
    
    
            $apidata = [
                "apiKey" =>"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
                "campaignName" => "step_seven",
                "destination" => $phoneNumber,
                "userName" => "Blinds & Curtains Solution Fzc",
                "templateParams" => [
                    "$name",
                    "$orderId",
                    "$link",
                    "$invoice"
    
                ],
                "source" => "new-landing-page form",
                "media" => [],
                "buttons" =>[],
                "carouselCards" => [],
                "location" => [],
                "paramsFallbackValue" => [
                    "FirstName" => '$name'
                ]
            ];
        
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://backend.aisensy.com/campaign/t1/api/v2', $apidata);
            
        }

        
        $notification = array(
            'message'    => 'Installation Setup Completed',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);

    }
    
    public function installationFeedback($code)
    {
        $data = Order::with('feedback')->where('order_code', $code)->first();
        return view('admin.order.feedback', compact('data'));
    }
    

    public function feedbackStore(Request $request)
    {
        // First, find the order related to the feedback
        Order::where('order_code', $request->order_code)->first();

        // Then use `updateOrCreate` to either update the existing review or create a new one
        InstallationReview::updateOrCreate(
            [
                'order_code' => $request->order_code, // This will check if feedback for this order exists
            ],
            [
                'bracketOne'          => $request->bracketOne ?? 0,
                'mechanismOne'        => $request->mechanismOne ?? 0,
                'mechanismTwo'        => $request->mechanismTwo ?? 0,
                'motorizedOne'        => $request->motorizedOne ?? 0,
                'motorizedTwo'        => $request->motorizedTwo ?? 0,
                'motorizedThree'      => $request->motorizedThree ?? 0,
                'motorizedFour'       => $request->motorizedFour ?? 0,
                'accessoriesOne'      => $request->accessoriesOne ?? 0,
                'accessoriesTwo'      => $request->accessoriesTwo ?? 0,
                'finalCheckOne'       => $request->finalCheckOne ?? 0,
                'finalCheckTwo'       => $request->finalCheckTwo ?? 0,
                'finalCheckThree'     => $request->finalCheckThree ?? 0,
                'finalCheckFour'      => $request->finalCheckFour ?? 0,
                'installer_name'      => $request->installer_name,
                'installer_signature' => $request->installer_signature,
                'customerName'        => $request->customerName,
                'installationDate'    => $request->installationDate,
                'agreement'           => $request->agreement ?? 0,
            ]
        );

        $notification = array(
            'message'    => 'Review Successfully Updated!',
            'alert-type' => 'success',
        );

        return redirect()->route('admin.dashboard')->with($notification);
        
        // return redirect()->route('admin.order.installation-list')->with($notification);
    }

    //Installation Books End
    
    // Feedback list
    public function feedbackList()
    {
        $data = Order::with('OrderItems','book')->where('status','feedback')->orWhere('status','payment')->latest()->paginate(10);
        return view('admin.order.feedback-list', compact('data'));
    }
   
    public function feedbackConfirm($id)
    {
        $production = Order::findOrFail($id);
        
        $production->book->update([
        'status' => 'complete'
        ]);
        $production->update([
        'status' => 'complete'
        ]);
        $notification = array(
            'message'    => 'Completed This Order',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);

    }
    
    // Complete Order list
    public function completeList()
    {
        $data = Order::with('OrderItems','book')->where('status','complete')->latest()->paginate(10);
        return view('admin.order.complete-list', compact('data'));
    }
    
    // Cancel Order list
    // public function cancelList()
    // {
    //     $data = Book::with(['orders' => function ($query) {
    //         $query->where('status', 'pending');
    //     }])
    //     ->where('status', 'cancel')
    //     ->latest()->paginate(10);
    //     dd($data);
    //     return view('admin.book.cancel-list',compact('data'));
    // }
    
    public function cancelList()
    {
        $data = Book::with(['orders' => function ($query) {
            $query->where('status', 'pending');
        }])
        ->where('status', 'cancel')
        ->latest()->get();
    

       
    
        return view('admin.book.cancel-list', compact('data'));
    }

    public function showPaymentForm($code)
    {
        
        $order = Order::with('book', 'orderDetails')->where('order_code', $code)->first();

        if ($order->coupon) {
            // Ensure numeric values
            $orderTotal = (float) preg_replace('/[^0-9.]/', '', $order->order_total); // Remove non-numeric characters
            $coupon = (float) preg_replace('/[^0-9.]/', '', $order->coupon);
        
            // Perform calculation
            $total = (float) $orderTotal - (float)(($orderTotal * $coupon) / 100);
            $paid = (float) $order->orderDetails->sum('amount');
        
            // Compare floating-point numbers with a precision threshold
            if (abs($total - $paid) < 0.01) { 
               
                $notification = [
                    'message'    => 'Your All Payment is Complete',
                    'alert-type' => 'success',
                ];
                return redirect()->to('/')->with($notification);
            } else {
                
                return view('admin.order.payment-form', compact('order'));
            }
        } else {
            $orderTotal = (float) preg_replace('/[^0-9.]/', '', $order->order_total);
            $paid = (float) $order->orderDetails->sum('amount');
        
            if (abs($orderTotal - $paid) < 0.01) { 
                
                $notification = [
                    'message'    => 'Your All Payment is Complete',
                    'alert-type' => 'success',
                ];
                return redirect()->to('/')->with($notification);
            } else {
                
                return view('admin.order.payment-form', compact('order'));
            }
        }



        
        
        
        // if(round($order->order_total, 2) == round($order->orderDetails->sum('amount'), 2)){
        
        //     $notification = array(
        //         'message'    => 'Your All Payment is Complete',
        //         'alert-type' => 'success',
        //     );
        //     return redirect()->to('/')->with($notification);
            
        // }else{
        //      return view('admin.order.payment-form', compact('order'));
        // }
       
    }
    
   
    
    public function invoice($code)
    {
        $order = Order::with('book', 'orderDetails')->where('order_code', $code)->first();
        $setting = Setting::first();
    
        // Convert logo to base64
        $logoPath = public_path('storage/' . $setting->header_logo);
        $logo = 'data:image/png;base64,' . base64_encode(file_get_contents($logoPath));
    
        $pdf = Pdf::loadView('invoice.payment-invoice', compact('order', 'setting', 'logo'));
        // return $pdf->stream();
         return $pdf->download('invoice-' . $order->order_code . '.pdf');
        
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon' => 'required'
        ]);

        // Check if the coupon exists in the Subscribe model
        $coupon = Subscriber::where('code', $request->coupon)->where('status',1)->first();

        if (!$coupon) {
            
            return back()->with('error', 'Invalid coupon code.');
        }

        // Store the discount in the session
        session(['coupon_discount' => $coupon->discount]);


        return back()->with('success', 'Coupon applied successfully!');
    }

    public function createPaymentIntent(Request $request)
    {

        session()->forget('transaction_id');
        session()->forget('transaction_date');

        // Validate the request to ensure the amount is at least 2 AED
        $validatedData = $request->validate([
            'amount' => 'required|numeric|min:2',
            'payment_status' => 'required|',
        ]);
    
        // Convert the amount from AED to fils (1 AED = 100 fils)
        $amountInFils = $validatedData['amount'] * 100;
    
        // Ensure the minimum amount is 200 fils (2 AED)
        if ($amountInFils < 200) {
            return back()->with('error','The minimum amount must be at least 2 AED.');
        }

        $client = new Client();

        // Dynamic values
        $amount = $amountInFils;
        $currencyCode = 'AED';
        $message = 'Order Payment';
        $orderId = $request->order_id;
        $payment_status = $request->payment_status;

        // Laravel success and cancel URLs
        $successUrl = route('payment.success', [
            'order_id' => $orderId,
            'amount' => $amount / 100,
            'payment_status' => $payment_status,
        ]);

        // $successUrl = route('payment.success');

        $cancelUrl = route('payment.cancel');

        // Convert PHP array to JSON string
        $bodyData = json_encode([
            'amount' => $amount,
            'currency_code' => $currencyCode,
            'message' => $message,
            'success_url' => $successUrl,
            'cancel_url' => $cancelUrl,
            'test' => false
        ]);

        $response = $client->request('POST', 'https://api-v2.ziina.com/api/payment_intent', [
            'body' => $bodyData,
            'headers' => [
                'accept' => 'application/json',
                'authorization' => 'Bearer '.env('ZIINA_API_KEY'),
                'content-type' => 'application/json',
            ],
        ]);
        
       

        $respon = json_decode($response->getBody());
        
         


        

        session()->put('transaction_id',$respon->id);
        session()->put('transaction_date',$respon->created_at);

        return redirect($respon->redirect_url);

        // echo $response->getBody();
        
    }


    public function paymentSuccess(Request $request)
    {
        
        
        // Validate the required parameters from the success URL
        $validatedData = $request->validate([
            'order_id' => 'required|exists:orders,id', // Ensure the order exists
            'amount' => 'required|numeric|min:2', // Amount in AED (sent from Ziina)
            'payment_status' => 'required|string', // Payment status (e.g., success)
        ]);

        // Retrieve the order using the order_id
        $order = Order::find($validatedData['order_id']);

        // Check if the order exists
        if ($order) {
           
            $timestamp = session()->get('transaction_date') / 1000; // Convert to seconds
            $date = Carbon::createFromTimestamp($timestamp);

            // Update the order details in the database
            $order->update([
                'status' => 'payment', // Set status to 'payment' or any other relevant status
                'payment_status' => $validatedData['payment_status'], // Update payment status
                'mail_send' => 'complete', // Mark mail send as complete
                'mail_send_date' => now(), // Store the current date and time
                'coupon' => session()->get('coupon_discount') ? session()->get('coupon_discount') : $order->coupon, // Store the current date and time
            ]);

            OrderDetails::create([
                'order_id' => $order->id,
                'amount' => $validatedData['amount'],
                'currency_code' => 'AED',
                'payment_method' => 'ziina',
                'transaction_id' => session()->get('transaction_id'),
                'transaction_date' => $date->format('d-m-Y'),
            ]);

            session()->forget('transaction_id');
            session()->forget('transaction_date');
            session()->forget('coupon_discount');


           
            
            $phoneNumber = $order->book->phone;
            $name = $order->book->name;
            $orderId = $order->order_code;
            $link = 'https://g.page/r/CVd284EcuEI0EBE/review';
            
            
              // Send different emails based on payment status
            if ($validatedData['payment_status'] === 'half') {
                
                // Optionally, send an email to the customer
                Mail::to($order->book->email)->send(new PaymentSuccessMail($order));
                Mail::to('admin@curtainssolutions.com')->send(new PaymentSuccessMail($order));

    
                $apidata = [
                    "apiKey" =>"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
                    "campaignName" => "step_four",
                    "destination" => $phoneNumber,
                    "userName" => "Blinds & Curtains Solution Fzc",
                    "templateParams" => [
                        "$name",
                        "$orderId",
    
                    ],
                    "source" => "new-landing-page form",
                    "media" => [],
                    "buttons" =>[],
                    "carouselCards" => [],
                    "location" => [],
                    "paramsFallbackValue" => [
                        "FirstName" => '$name'
                    ]
                ];
            
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://backend.aisensy.com/campaign/t1/api/v2', $apidata);
                
            }elseif ($validatedData['payment_status'] === 'full') {
                
                Mail::to($order->book->email)->send(new GoogleReviewLinkMail($order));
                Mail::to('admin@curtainssolutions.com')->send(new GoogleReviewLinkMail($order));
                
        
                $apidata = [
                    "apiKey" =>"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
                    "campaignName" => "step_eight",
                    "destination" => $phoneNumber,
                    "userName" => "Blinds & Curtains Solution Fzc",
                    "templateParams" => [
                        "$name",
                        "$orderId",
                        "$link",
                        
        
                    ],
                    "source" => "new-landing-page form",
                    "media" => [],
                    "buttons" =>[],
                    "carouselCards" => [],
                    "location" => [],
                    "paramsFallbackValue" => [
                        "FirstName" => '$name'
                    ]
                ];
            
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://backend.aisensy.com/campaign/t1/api/v2', $apidata);
            }
            
            
            
            
            
        }

       
        // Redirect to the payment success Blade view, passing the order details
       
        return redirect()->route('order.user.success',$order->id);
    }

    public function userSuccessOrder($id)
    {
        $order = Order::findOrFail($id);
        $notification = array(
            'message'    => 'Your payment has been processed successfully.',
            'alert-type' => 'success',
        );
        return view('admin.order.payment-success', ['order' => $order])->with($notification);
    } 



    public function paymentCancel(Request $request)
    {
        session()->forget('transaction_id');
        session()->forget('transaction_date');


        // Handle canceled payment
        // return view('admin.order.payment-cancel');
        $notification = array(
            'message'    => 'Your payment was cancelled.',
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }

    public function getInstallationData()
    {
        $orders = Order::whereNotNull('install_date')
                ->whereHas('book', function ($query) {
                $query->where('city', 'Dubai'); // Filter by city in the Book model
            })
            ->get(['id', 'install_date', 'install_time', 'order_code', 'status']);

        $events = [];

        foreach ($orders as $order) {
            $events[] = [
                'id' => $order->id,
                'title' => $order->order_code . ($order->status === 'completed' ? ' (Completed)' : ''),
                'start' => $order->install_date,
                'allDay' => true,
                'backgroundColor' => $order->status === 'completed' ? '#28a745' : '#007bff', // Green for completed
            ];
        }

        return response()->json($events);
    }
    
     public function getInstallationDataAbuDhabi()
    {
        $orders = Order::whereNotNull('install_date')
                ->whereHas('book', function ($query) {
                $query->where('city', 'Abu Dhabi'); // Filter by city in the Book model
            })
            ->get(['id', 'install_date', 'install_time', 'order_code', 'status']);

        $events = [];

        foreach ($orders as $order) {
            $events[] = [
                'id' => $order->id,
                'title' => $order->order_code . ($order->status === 'completed' ? ' (Completed)' : ''),
                'start' => $order->install_date,
                'allDay' => true,
                'backgroundColor' => $order->status === 'completed' ? '#28a745' : '#007bff', // Green for completed
            ];
        }

        return response()->json($events);
    }
    
    
    public function getOrderDetails($id)
    {
        $order = Order::findOrFail($id);

        return response()->json([
            'install_date' => $order->install_date,
            'install_time' => $order->install_time,
            'install_note' => $order->install_note,
            'status' => $order->status,
        ]);
    }
    
    
    public function customerReview($ordercode)
    {
        $data = Order::with('feedback')->where('order_code', $ordercode)->first();
        return view('admin.order.customer-feedback',compact('data'));
    }

    public function customerfeedBackStore(Request $request)
    {
        // First, find the order related to the feedback
        $data = Order::with('book')->where('order_code', $request->order_code)->first();

        // Then use `updateOrCreate` to either update the existing review or create a new one
        InstallationReview::updateOrCreate(
            [
                'order_code' => $request->order_code, // This will check if feedback for this order exists
            ],
            [
                'bracketOne'          => $request->bracketOne ?? 0,
                'mechanismOne'        => $request->mechanismOne ?? 0,
                'mechanismTwo'        => $request->mechanismTwo ?? 0,
                'motorizedOne'        => $request->motorizedOne ?? 0,
                'motorizedTwo'        => $request->motorizedTwo ?? 0,
                'motorizedThree'      => $request->motorizedThree ?? 0,
                'motorizedFour'       => $request->motorizedFour ?? 0,
                'accessoriesOne'      => $request->accessoriesOne ?? 0,
                'accessoriesTwo'      => $request->accessoriesTwo ?? 0,
                'finalCheckOne'       => $request->finalCheckOne ?? 0,
                'finalCheckTwo'       => $request->finalCheckTwo ?? 0,
                'finalCheckThree'     => $request->finalCheckThree ?? 0,
                'finalCheckFour'      => $request->finalCheckFour ?? 0,
                'installer_name'      => $request->installer_name,
                'installer_signature' => $request->installer_signature,
                'customerName'        => $request->customerName,
                'installationDate'    => $request->installationDate,
                'agreement'           => $request->agreement ?? 0,
            ]
        );

        // $data->book->update([
        //     'status' => 'complete'
        // ]);
        $data->update([
            'status' => 'complete'
        ]);

        $notification = array(
            'message'    => 'Review Successfully Submitted!',
            'alert-type' => 'success',
        );

        return redirect()->route('home')->with($notification);
        // return redirect()->route('admin.order.installation-list')->with($notification);
    }


}
