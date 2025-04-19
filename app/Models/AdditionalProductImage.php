<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalProductImage extends Model
{
    /** @use HasFactory<\Database\Factories\AdditionalProductImageFactory> */
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image'
    ];
}
