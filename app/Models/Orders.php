<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'order_number', 
        'order_date', 
        'delivery_date', 
        'customer_id', 
        'category_id', 
        'phone_number',
        'address', 
        'quantity_kg', 
        'total_price', 
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }

    public static function generateOrderNumber()
    {
        $noOr = uniqid();
        $limitNo_or = substr($noOr, 0, 7);
        return 'OR-' . strtoupper($limitNo_or);
    }
}
