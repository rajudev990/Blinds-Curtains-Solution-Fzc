<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
    public function feedback()
    {
        return $this->hasOne(InstallationReview::class, 'order_code', 'order_code');
    }

    public function OrderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class,'order_id');
    }
}
