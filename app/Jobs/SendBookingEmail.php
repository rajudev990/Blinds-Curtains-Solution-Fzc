<?php

namespace App\Jobs;

use App\Mail\UserBookMail;
use App\Mail\AdminBookMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendBookingEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userMail;
    protected $adminMail;
    protected $userData;
    protected $adminData;

    /**
     * Create a new job instance.
     */
    public function __construct($userMail, $userData, $adminMail, $adminData)
    {
        $this->userMail = $userMail;
        $this->userData = $userData;
        $this->adminMail = $adminMail;
        $this->adminData = $adminData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Send email to the user
        Mail::to($this->userMail)->send(new UserBookMail($this->userData));

        // Send email to the admin
        Mail::to($this->adminMail)->send(new AdminBookMail($this->adminData));
    }
}
