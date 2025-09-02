<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Mail\SendPaymentLinkMail;
use App\Models\Book;
use App\Models\BookPay;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserMailController extends Controller
{
    public function sendPaymentLink($code)
    {

        $data = Order::with('book')->where('order_code', $code)->first();
        
        $data->update([
            'mail_send' =>'send',
            'mail_send_date' => now(),
            
        ]);
        
        
        $email = $data->book->email;

        // $data               = [];
        // $data['link']      = route('admin.order.checkout', $code);
        // $data['book_id']    = $order->book->book_id;
        // $data['order_code'] = $code;
        // $data['name'] = $order->book->name;
        
      

        Mail::to($email)->send(new SendPaymentLinkMail($data));

         // Prepare AiSensy API payload
        //  $phoneNumber = $order->book->phone; 
        //  $name =   $order->book->name;
        //  $link =   $data['link'];
        //  $orderCode = $code;

        //  if($order->order_total === $order->paid){
        //     $notification = array(
        //         'message'    => 'Your All Payment is Complete',
        //         'alert-type' => 'success',
        //     );
        //     return redirect()->back()->with($notification);
        //  }
         
         
        //  $book = [
        //      "apiKey" => env('AISENSY_API_TOKEN'),
        //      "campaignName" => "Customer Book Confirmation",
        //      "destination" => $phoneNumber,
        //      "userName" => "Blinds & Curtains Solution Fzc",
        //      "templateParams" => [
        //          "$name",   // Will replace {{1}} in the template
        //          "$link"           // Will replace {{2}} in the template
        //      ],
        //      "source" => "new-landing-page form",
        //      "media" => [],
        //      "buttons" => [],
        //      "carouselCards" => [],
        //      "location" => [],
        //      "paramsFallbackValue" => [
        //          "FirstName" => '$name'
        //      ]
        //  ];
     
        //  $response = Http::withHeaders([
        //      'Content-Type' => 'application/json',
        //  ])->post('https://backend.aisensy.com/campaign/t1/api/v2', $book);
     
        //  if ($response->successful()) {
        //     $notification = array(
        //         'message'    => 'Email sent successfully',
        //         'alert-type' => 'success',
        //     );
        //  } else {
        //      \Log::error('Email sent successfully', [
        //          'status' => $response->status(),
        //          'response' => $response->body(),
        //      ]);
     
        //      $notification = array(
        //          'message' => 'Email sent successfully',
        //          'alert-type' => 'error'
        //      );
        //  }

         $phoneNumber = $data->book->phone;
        $name = $data->book->name;
        $orderId = $data->order_code;
        $link = route('admin.order.checkout',$data->order_code);
        $invoice = route('admin.order.invoice',$data->order_code);


        $apidata = [
            "apiKey" =>"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
            "campaignName" => "step_two",
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
                'message'    => 'Email sent successfully',
                'alert-type' => 'success',
            );
         } else {
            $notification = array(
                'message'    => 'Email sent successfully',
                'alert-type' => 'success',
            );
            
         }
        
        return redirect()->back()->with($notification);

    }

    public function checkout($code)
    {
        $order = Order::with('book')->where('order_code', $code)->first();
        
        if(round($order->order_total, 2) == round($order->paid, 2)){
        
            $notification = array(
                'message'    => 'Your All Payment is Complete',
                'alert-type' => 'success',
            );
            return redirect()->to('/')->with($notification);
            
        }else{
             return view('admin.book.checkout', compact('order'));
        }
       
    }
}
