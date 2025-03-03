<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory;

    // Allow mass assignment for these fields
    protected $fillable = [
        'product_id',
        'user_id',
        'type',
        'quantity',
        'date',
        'status',
        'notes',
    ];

    /**
     * Get the product associated with the stock transaction.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get the user associated with the stock transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the formatted date for the stock transaction.
     *
     * @return string
     */
    public function getFormattedDateAttribute()
    {
        return \Carbon\Carbon::parse($this->date)->format('d-m-Y');
    }

    /**
     * Get the formatted status for the stock transaction.
     *
     * @return string
     */
    public function getFormattedStatusAttribute()
    {
        switch ($this->status) {
            case 'pending':
                return 'Pending';
            case 'received':
                return 'Received';
            case 'dispatched':
                return 'Dispatched';
            default:
                return ucfirst($this->status);
        }
    }

    public static function getStockSummary()
    {
        return self::selectRaw('product_id, 
                SUM(CASE WHEN type = "masuk" THEN quantity ELSE 0 END) as total_in,
                SUM(CASE WHEN type = "keluar" THEN quantity ELSE 0 END) as total_out')
            ->groupBy('product_id')
            ->with('product')
            ->get();
    }
}

