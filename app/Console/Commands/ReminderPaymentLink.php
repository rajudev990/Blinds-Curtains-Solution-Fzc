<?php

namespace App\Console\Commands;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ReminderPaymentLink extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminderpaymentlink:cron';

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

        $orders = Order::where('mail_send', 'send')
            ->where('mail_send_count', '<', 2)
            ->get();
        
        foreach ($orders as $order) {
            $mailSendDate = Carbon::parse($order->mail_send_date)->toDateString(); // Convert DB date to Y-m-d
        
            if ($order->mail_send_count == 0 && $mailSendDate == Carbon::now()->subDays(3)->toDateString()) {
                // Send WhatsApp message
                $this->sendWhatsAppMessage($order);
        
                // Update `mail_send_count` and set the next `mail_send_date` to 3 days later
                $order->mail_send_count = 1;
                // $order->mail_send_date = Carbon::now(); 
        
                // Save the updated order
                $order->save();
        
                info('Updated order for first message: ' . $order->order_code);
                info('mail_send_date after saving: ' . $order->mail_send_date);
            } elseif ($order->mail_send_count == 1 && $mailSendDate == Carbon::now()->subDays(6)->toDateString()) {
                // Send WhatsApp message for the second time
                $this->sendWhatsAppMessage($order);
        
                // Update `mail_send_count` to 2 and disable future messages
                $order->mail_send_count = 2;
                // $order->mail_send = 'sent'; 
        
                // Save the updated order
                $order->save();
        
                info('Updated order for second message: ' . $order->order_code);
                info('mail_send_date after saving: ' . $order->mail_send_date);
            }
        }
    }


    public function sendWhatsAppMessage($order)
    {
        $phoneNumber = $order->book->phone;
        $name = $order->book->name;
        $orderId = $order->order_code;
        $link = route('admin.order.checkout', $order->order_code);

        $apidata = [
            "apiKey" => "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpZCI6IjY2ZjQ0ZTk1ZmVlOWRiMGI3ODYxNGVjNCIsIm5hbWUiOiJCbGluZHMgJiBDdXJ0YWlucyBTb2x1dGlvbiBGemMiLCJhcHBOYW1lIjoiQWlTZW5zeSIsImNsaWVudElkIjoiNjZmNDRlOTVmZWU5ZGIwYjc4NjE0ZWJlIiwiYWN0aXZlUGxhbiI6IkJBU0lDX01PTlRITFkiLCJpYXQiOjE3MjcyODY5MzN9.ZKvB-vCMo0QNI1HCE1mBxVIir1CpI3J0aHhZXjzhVOc",
            "campaignName" => "step_three",
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
        } else {
            $this->error('Failed to send WhatsApp message for order: ' . $order->order_code);
        }
    }
}
