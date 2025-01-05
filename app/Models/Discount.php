<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Discount extends Model
{
    use HasFactory;

    protected $primaryKey = 'discount_id';
    protected $table = 'discounts';
    protected $fillable = [
        'event_name',
        'product_id',
        'discount_amount',
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'discount_product', 'discount_id', 'product_id')->using(DiscountProduct::class);
    }

    public function getDiscountStatusAttribute()
    {
        $currentDate = Carbon::now();  // Get the current date and time

        // Check if the current time is between the start and end time (inclusive)
        if ($currentDate->between($this->start_date, $this->end_date)) {
            return 'Ongoing';
        }

        // Check if the discount has expired
        if ($currentDate->greaterThan($this->end_date)) {
            return 'Expired';
        }

        // Check if the discount is upcoming
        if ($currentDate->lessThan($this->start_date)) {
            return 'Upcoming';
        }

        return 'Unknown';
    }



    /**
     * Check if the discount is valid (ongoing).
     */
    public function isValid()
    {
        return $this->start_date <= now() && $this->end_date >= now();
    }
}
