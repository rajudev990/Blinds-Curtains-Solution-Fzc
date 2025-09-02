<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhyKurtains extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    
    public function estimate_title()
    {
        return $this->belongsTo(GetEstimateTitle::class,'why_kurtains');
    }
}
