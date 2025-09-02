<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];


    public function sizes()
    {
        return $this->hasMany(AttributesSize::class);
    }
    public function images()
    {
        return $this->hasMany(GalleryImage::class);
    }
    

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    
    public function catalogues()
    {
       
        return $this->belongsToMany(Catalogue::class,'catalogue_id');

    }

    public function productCatalogues()
    {
        return $this->hasMany(ProductCatalouge::class, 'product_id');
    }
}
