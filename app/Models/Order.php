<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Specify the primary key column
    protected $primaryKey = 'order_id';

    // If your primary key is not auto-incrementing, set $incrementing to false (remove this line if it's auto-incrementing)
    public $incrementing = true;

    // If your primary key is not an integer, specify its type
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'total_amount',
        'payment_status',
        'shipping_status',
    ];

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Define the relationship with the OrderItem model
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id'); 
    }
}
