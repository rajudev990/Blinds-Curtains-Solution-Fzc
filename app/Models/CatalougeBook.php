<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalougeBook extends Model
{
    use HasFactory;
    
    protected $guarded = [];
    
    public function catalouge(){
        return $this->belongsTo(Catalogue::class);
    }

    public function page_numbers(){
        return $this->hasMany(PageNumber::class);
    }


    public function catalogueItems() {
        return $this->hasMany(CatalogueItem::class, 'catalogue_book_id');
    }
}
