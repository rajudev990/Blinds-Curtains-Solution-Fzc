<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;



Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote Raju')->cron('* * * * *');



Schedule::command('reminderpaymentlink:cron')->cron('* * * * *');
Schedule::command('remindersecondpaymentlink:cron')->cron('* * * * *');