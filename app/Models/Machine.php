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
        'hours',
        'status',
        'sort_order'
    ];

    protected $casts = [
        'purchase_date' => 'datetime',
        'price' => 'decimal:2',
        'category' => Category::class,
        'brand' => Brand::class
    ];

    public function getPurchaseDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function getPriceAttribute($value)
    {
        return '$ ' .number_format($value, 2);
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = number_format($value, 2, '.', '');
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y H:i:s');
    }

}4
