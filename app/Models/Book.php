<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts   = [
        'booking_date' => 'datetime',
    ];
    public function bookingTime()
    {
        return $this->belongsTo(BookingTime::class,'booking_time_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function bookPay()
    {
        return $this->hasOne(BookPay::class);
    }

    public function installationReviews()
    {
        return $this->hasMany(InstallationReview::class, 'bookId');
    }
}
