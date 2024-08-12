<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Определите, какие атрибуты могут быть массово назначены
    protected $fillable = ['name', 'description', 'price', 'quantity'];
}
