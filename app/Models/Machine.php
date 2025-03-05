<?php

namespace App\Models;

use App\Enum\Brand;
use App\Enum\Category;
use Carbon\Carbon;
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
        'timer_date',
        'hours',
        'status',
        'sort_order'
    ];

    protected $casts = [
        'purchase_date' => 'datetime',
        'timer_date' => 'datetime',
        'price' => 'decimal:2',
        'category' => Category::class,
        'brand' => Brand::class
    ];
}
