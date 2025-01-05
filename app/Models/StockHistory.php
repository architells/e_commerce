<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockHistory extends Model
{
    use HasFactory;

    protected $table = 'stocks_history';
    protected $primaryKey = 'stock_history_id';

    protected $fillable = [
        'stock_id',
        'quantity_change',
        'action',
    ];

    public function stock()
    {
        return $this->belongsTo(Stock::class, 'stock_id', 'stock_id');
    }
}
