<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatalogueItem extends Model
{
    use HasFactory;

    protected $guarded = [];


    // CatalogueItem.php
    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class, 'catalogue_id');
    }

    public function catalogueBook()
    {
        return $this->belongsTo(CatalougeBook::class, 'catalogue_book_id');
    }

    public function pageNumber()
    {
        return $this->belongsTo(PageNumber::class, 'page_number_id');
    }

    // protected $casts = [
    //     'catalogue_data' => 'array',
    // ];
}
