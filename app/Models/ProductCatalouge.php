<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCatalouge extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function catalogue()
    {
        return $this->belongsTo(Catalogue::class);
    }

    public function catalogueBooks() {
        return $this->hasMany(CatalougeBook::class, 'catalouge_id');
    }
}
