<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstallationReview extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function book()
    {
        return $this->belongsTo(Book::class, 'bookId');
    }
    
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_code');
    }
}
