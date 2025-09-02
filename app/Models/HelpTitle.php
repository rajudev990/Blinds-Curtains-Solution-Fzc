<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HelpTitle extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function helps()
    {
        return $this->hasMany(Help::class,'question');
    }
}
