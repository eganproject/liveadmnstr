<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = "tokos";
    protected $fillable = [
        "name",
        "description"
    ];
}
