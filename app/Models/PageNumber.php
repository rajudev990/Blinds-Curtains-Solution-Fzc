<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageNumber extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function catalouge()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function catalouge_book()
    {
        return $this->belongsTo(CatalougeBook::class);
    }
}
