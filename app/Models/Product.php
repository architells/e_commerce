<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Define which fields are mass assignable
    protected $fillable = [
        'product_name',
        'description',
        'price',
        'stock',
        'product_image',
        'category_id',
        'supplier_id',
        'discount',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }


    // Business Logic Methods

    /**
     * Calculate the price after discount.
     *
     * @param  float  $discountPercent
     * @return float
     */
    public function discountedPrice($discountPercent)
    {
        return $this->price * (1 - $discountPercent / 100);
    }


    /**
     * Check if the product is in stock.
     *
     * @return bool
     */
    public function isInStock()
    {
        return $this->stock > 0;
    }
}
