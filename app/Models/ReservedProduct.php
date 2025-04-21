<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservedProduct extends Model
{
    /** @use HasFactory<\Database\Factories\ReservedProductFactory> */
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id'
    ];
}
