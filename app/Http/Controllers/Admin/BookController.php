<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\OrderDiscountMail;
use App\Models\Book;
use App\Models\BookingTime;
use App\Models\Order;
use App\Models\InstallationReview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class BookController extends Controller
{

    public function index()
    {
        $data = Book::with(['orders' => function ($query) {
            $query->where('status', 'pending')
            ->orWhere('status','discount')
            ->orWhere('status','payment')
            ->orWhere('status','production')
            ->orWhere('status','production-processing')
            ->orWhere('status','installation-time')
            ->orWhere('status','installation-processing')
            ->orWhere('status','feedback')
            ->orWhere('status','complete')
            ->orWhere('production_status','production-completed')
            ->orWhere('installation_status','installation-completed');
        }])
        ->where('status', 'pending')
        ->orWhere('status', 'delivered')
        ->orWhere('status', 'block bookking')
        ->orWhere('status', 'add bookking')
        ->orWhere('status', 'failed')
        ->orWhere('status', 'complete')
        ->orWhere('status', 'cancel')
        ->latest()->get();
    

        return view('admin.book.index',compact('data'));
    }

    public function cancel($id)
    {

        $data  = Book::findOrFail($id);
        $data->update([
            'status'=>'cancel'
        ]);

        $notification = array(
            'message'    => 'Booking Cancel Successfully !!!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }
    

    public function show($id)
    {
        $data  = Book::findOrFail($id);
        return view('admin.book.show',compact('data'));
    }
    
     // new
    public function sendDiscountAdmin($code)
    {
        // $userMail = $data->email;
        // Mail::to($userMail)->send(new UserBookConfirmMail($data));

        $order              = Order::with('book')->where('order_code', $code)->first();
        $adminMail          = 'admin@curtainssolutions.com';
        $data               = [];
        $data['book_id']    = $order->book->book_id;
        $data['order_code'] = $code;
        $data['name'] = $order->book->name;

        $order->update([
            'status' => 'discount',
        ]);

        Mail::to($adminMail)->send(new OrderDiscountMail($data));

        $notification = array(
            'message'    => 'Email Send Successfully !!!',
            'alert-type' => 'success',
        );

        return back()->with($notification);
    }

    public function pendingSearch(Request $request)
    {
        $data = Book::with('orders', 'installationReviews')
            ->where('name', 'like', '%' . $request->string . '%')
            ->orWhere('email', 'like', '%' . $request->string . '%')
            ->orWhere('phone', 'like', '%' . $request->string . '%')
            ->orWhere('status', $request->status)
            ->orWhere('booking_date', $request->date)
            ->paginate(10);

        return view('admin.book.index', compact('data'));
    }


    //Pending Books End

    public function discountList()
    {
        $data = Book::with('orders')->whereHas('orders', function ($q) {
            $q->where('status', 'discount');
        })->latest()->get();
        return view('admin.book.discountList', compact('data'));
        
    }

 

    public function destroy(string $id)
    {
        // Find the book with the given ID
        $data = Book::findOrFail($id);
        
        // Check if the status is either 'pending' or 'cancel'
        if (in_array($data->status, ['pending', 'cancel'])) {
            // Delete related order items and orders
            foreach($data->orders as $item) {
                $item->orderDetails()->delete();
                $item->feedback()->delete();
                $item->OrderItems()->delete();
            }
            $data->orders()->delete();
            $data->delete();
            
            // Set notification for successful deletion
            $notification = array(
                'message'    => 'Booking Delete Successfully !!!',
                'alert-type' => 'success',
            );
        } else {
            // Set notification for failed deletion due to status restriction
            $notification = array(
                'message'    => 'Cannot delete a booking with the current status!',
                'alert-type' => 'error',
            );
        }

        // Redirect back with the notification
        return redirect()->back()->with($notification);
    }
    

    // calendar one

    public function getAllBookTimes(Request $request)
    {
        $date = $request->date; // The date clicked on the calendar

        // Fetch all BookingTime entries with their related Book (where calendar is 1) for the given date
        $bookTimes = BookingTime::with(['books' => function($query) use ($date) {
            $query->where('booking_date', $date)
                ->where('calendar', '1') // Filter books by calendar 1
                ->orderBy('created_at', 'asc'); // Order by creation time
        }])->get();

        // Render the data in the view
        $html = view('admin.book.booking_time_details', compact('bookTimes', 'date'))->render();

        return response()->json($html);
    }

    public function getAllBookTimesAnother(Request $request)
    {

        $date = $request->date; // The date clicked on the calendar

        // Fetch all BookingTime entries with their related Book (where calendar is 1) for the given date
        $bookTimes = BookingTime::with(['books' => function($query) use ($date) {
            $query->where('booking_date', $date)
                ->where('calendar', '2') // Filter books by calendar 1
                ->orderBy('created_at', 'asc'); // Order by creation time
        }])->get();

        // Render the data in the view
        $html = view('admin.book.booking_time_details_another', compact('bookTimes', 'date'))->render();

        return response()->json($html);



    }

 
    public function markDelivered($id)
    {
        $data = Book::findOrFail($id);

        $data->update([
            'status' => 'delivered'
        ]);
        // Set notification for failed deletion due to status restriction
        $notification = array(
            'message'    => 'Delivered Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    // public function markFailed($id)
    // {
    //     $data = Book::findOrFail($id);
    //     $data->update([
    //         'status' => 'failed'
    //     ]);
    //     $notification = array(
    //         'message'    => 'Delivered Failed !!!',
    //         'alert-type' => 'error',
    //     );

    //     return redirect()->back()->with($notification);
    // }

    public function markFailed(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'book_id' => 'required|exists:books,id', // Ensure the book_id exists
            'reason' => 'required|string|max:255',
        ]);

        // Find the book by ID
        $book = Book::findOrFail($request->book_id);

        // Update the book's status and reason
        $book->status = 'failed';
        $book->reason = $request->reason; // Ensure you have this field in your books table
        $book->save();

        // Redirect with success message
        return redirect()->back()->with('message', 'The booking has been marked as failed.');
    }




    public function blockBooking(Request $request)
    {
        Book::create([
            'booking_time_id' => $request->book_time,
            'booking_date' => $request->book_date,
            'book_id' => rand(0000,1111),
            'name' => 'curtainssolutions',
            'email' => 'curtainssolutions@gmail.com',
            'phone' => '+971501212121',
            'status' => 'block bookking',
            'calendar' => $request->calendar,
            'city' => $request->city,
        ]);

        // Set notification for failed deletion due to status restriction
        $notification = array(
            'message'    => 'Block Booking Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);


    }
    public function addBooking(Request $request)
    {
        
        Book::create([
            'booking_time_id' => $request->book_time,
            'booking_date' => $request->book_date,
            'book_id' => rand(0000,1111),
            'name' => 'curtainssolutions',
            'email' => 'curtainssolutions@gmail.com',
            'phone' => '+971501212121',
            'status' => 'add bookking',
            'calendar' => $request->calendar,
            'city' => $request->city,
        ]);

        // Set notification for failed deletion due to status restriction
        $notification = array(
            'message'    => 'Ad Booking Successfully !!!',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

}
