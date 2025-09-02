<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function catalogueBooks()
    {
        return $this->hasMany(CatalougeBook::class);
    }


    public function products()
    {
        return $this->belongsToMany(ProductCatalouge::class);
    }


    public function productCatalouges()
    {
        return $this->hasMany(ProductCatalouge::class, 'catalouge_id');
    }
}
