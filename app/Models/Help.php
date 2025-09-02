<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function help_title()
    {
        return $this->belongsTo(HelpTitle::class,'question');
    }
}
