<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Stock extends Model
{
    use HasFactory;

    protected $primaryKey = 'stock_id';

    protected $fillable = [
        'product_id',
        'quantity',
        'stock_unit',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function stockHistory()
    {
        return $this->hasMany(StockHistory::class, 'stock_id', 'stock_id');
    }
}
