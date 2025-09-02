<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetEstimateTitle extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function estimates()
    {
        return $this->hasMany(WhyKurtains::class,'why_kurtains');
    }
}
