<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use App\Mail\ReminderSecondStepSevenMail;
use App\Mail\ReminderSecondStepNineMail;
use App\Mail\ReminderSecondStepTenMail;
use App\Mail\ReminderSecondStepElevenMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ReminderSecondPaymentLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remindersecondpaymentlink:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $orders = Order::where('mail_send', 'due')
        ->where('mail_send_count', '<', 5) // Max 5 messages
        ->where(function ($query) {
            $query->where('mail_send_date', '<=', Carbon::now()->subDays(3)) // First send after 3 days
                ->orWhere(function ($query) {
                    $query->where('mail_send_count', 1)
                        ->where('mail_send_date', '<=', Carbon::now()->subDays(6)); // Second message after 6 days
                })
                ->orWhere(function ($query) {
                    $query->where('mail_send_count', 2)
                        ->where('mail_send_date', '<=', Carbon::now()->subDays(9)); // Third message after 9 days
                })
                ->orWhere(function ($query) {
                    $query->where('mail_send_count', 3)
                        ->where('mail_send_date', '<=', Carbon::now()->subDays(12)); // Fourth message after 12 days
                })
                ->orWhere(function ($query) {
                    $query->where('mail_send_count', 4)
                        ->where('mail_send_date', '<=', Carbon::now()->subDays(13)); // Fifth message after 13 days
                });
        })
        ->get();

        foreach ($orders as $order) {

            $phoneNumber = $order->book->phone;
            $name = $order->book->name;
            $orderId = $order->order_code;
            $link = route('admin.order.checkout', $order->order_code);
            $invoice = route('admin.order.invoice',$order->order_code);


            // Check if the order has not been sent yet
            if ($order->mail_send_count == 0) {


                $apidata = [
                    "apiKey" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
                    "campaignName" => "step_seven",
                    "destination" => $phoneNumber,
                    "userName" => "Blinds & Curtains Solution Fzc",
                    "templateParams" => [
                        "$name",
                        "$orderId",
                        "$link",
                        "$invoice",
                    ],
                    "source" => "new-landing-page form",
                    "media" => [],
                    "buttons" => [],
                    "carouselCards" => [],
                    "location" => [],
                    "paramsFallbackValue" => [
                        "FirstName" => "$name"
                    ]
                ];
        
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://backend.aisensy.com/campaign/t1/api/v2', $apidata);

                if ($response->successful()) {
                    // Update the order
                    $order->mail_send_count += 1;
                    $order->save();
                    $this->info('WhatsApp message sent to: ' . $order->book->phone);

                    Mail::to($order->book->email)->send(new ReminderSecondStepSevenMail($order));

                } else {
                    $this->error('Failed to send WhatsApp message for order: ' . $order->order_code);
                }

            } elseif ($order->mail_send_count == 1) {
                
                $apidata = [
                    "apiKey" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
                    "campaignName" => "step_nine",
                    "destination" => $phoneNumber,
                    "userName" => "Blinds & Curtains Solution Fzc",
                    "templateParams" => [
                        "$name",
                        "$orderId",
                        "$link",
                        "$invoice",
                    ],
                    "source" => "new-landing-page form",
                    "media" => [],
                    "buttons" => [],
                    "carouselCards" => [],
                    "location" => [],
                    "paramsFallbackValue" => [
                        "FirstName" => "$name"
                    ]
                ];
        
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://backend.aisensy.com/campaign/t1/api/v2', $apidata);

                if ($response->successful()) {
                    // Update the order
                    $order->mail_send_count += 1;
                    $order->save();
                    $this->info('WhatsApp message sent to: ' . $order->book->phone);

                    Mail::to($order->book->email)->send(new ReminderSecondStepNineMail($order));



                } else {
                    $this->error('Failed to send WhatsApp message for order: ' . $order->order_code);
                }

            }elseif ($order->mail_send_count == 2) {
                
                $apidata = [
                    "apiKey" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
                    "campaignName" => "step_ten",
                    "destination" => $phoneNumber,
                    "userName" => "Blinds & Curtains Solution Fzc",
                    "templateParams" => [
                        "$name",
                        "$orderId",
                        "$link",
                        "$invoice",
                    ],
                    "source" => "new-landing-page form",
                    "media" => [],
                    "buttons" => [],
                    "carouselCards" => [],
                    "location" => [],
                    "paramsFallbackValue" => [
                        "FirstName" => "$name"
                    ]
                ];
        
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://backend.aisensy.com/campaign/t1/api/v2', $apidata);

                if ($response->successful()) {
                    // Update the order
                    $order->mail_send_count += 1;
                    $order->save();
                    $this->info('WhatsApp message sent to: ' . $order->book->phone);

                    Mail::to($order->book->email)->send(new ReminderSecondStepTenMail($order));

                } else {
                    $this->error('Failed to send WhatsApp message for order: ' . $order->order_code);
                }

            }elseif ($order->mail_send_count == 3) {
                
                $apidata = [
                    "apiKey" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
                    "campaignName" => "step_ten",
                    "destination" => $phoneNumber,
                    "userName" => "Blinds & Curtains Solution Fzc",
                    "templateParams" => [
                        "$name",
                        "$orderId",
                        "$link",
                        "$invoice",
                    ],
                    "source" => "new-landing-page form",
                    "media" => [],
                    "buttons" => [],
                    "carouselCards" => [],
                    "location" => [],
                    "paramsFallbackValue" => [
                        "FirstName" => "$name"
                    ]
                ];
        
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://backend.aisensy.com/campaign/t1/api/v2', $apidata);

                if ($response->successful()) {
                    // Update the order
                    $order->mail_send_count += 1;
                    $order->save();
                    $this->info('WhatsApp message sent to: ' . $order->book->phone);

                    Mail::to($order->book->email)->send(new ReminderSecondStepTenMail($order));



                } else {
                    $this->error('Failed to send WhatsApp message for order: ' . $order->order_code);
                    $this->error('Failed to send WhatsApp message for order: ' . $order->order_code);
                }

            }elseif ($order->mail_send_count == 4) {
                
                $apidata = [
                    "apiKey" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
                    "apiKey" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
                    "campaignName" => "step_eleven",
                    "destination" => $phoneNumber,
                    "userName" => "Blinds & Curtains Solution Fzc",
                    "templateParams" => [
                        "$name",
                        "$orderId",
                        "$link",
                    ],
                    "source" => "new-landing-page form",
                    "media" => [],
                    "buttons" => [],
                    "carouselCards" => [],
                    "location" => [],
                    "paramsFallbackValue" => [
                        "FirstName" => "$name"
                    ]
                ];
        
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post('https://backend.aisensy.com/campaign/t1/api/v2', $apidata);

                if ($response->successful()) {
                    // Update the order
                    $order->mail_send_count += 1;
                    $order->save();
                    $this->info('WhatsApp message sent to: ' . $order->book->phone);

                    Mail::to($order->book->email)->send(new ReminderSecondStepElevenMail($order));
                    Mail::to('rajusheikh061@gmail.com')->send(new ReminderSecondStepElevenMail($order));


                } else {
                    $this->error('Failed to send WhatsApp message for order: ' . $order->order_code);
                }

            }
        }
    }
}
