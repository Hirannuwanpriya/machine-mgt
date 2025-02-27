<?php

namespace App\Models;

use App\Enum\Brand;
use App\Enum\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Machine extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'purchase_date',
        'price',
        'category',
        'brand',
        'status',
        'sort_order'
    ];

    protected $casts = [
        'purchase_date' => 'datetime',
        'category' => Category::class,
        'brand' => Brand::class
    ];
}
