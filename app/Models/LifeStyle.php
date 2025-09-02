<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifeStyle extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function list_style_title()
    {
        return $this->belongsTo(LifeStyleTitle::class,'title_id');
    }
}
