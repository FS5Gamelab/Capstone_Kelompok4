<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feed_backs';
    protected $fillable = [
        'id_customer',
        'id_order',
        'feedback',
        'rating'
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class, 'id_customer');
    }

    public function order()
    {
        return $this->belongsTo(Orders::class, 'id_order');
    }
}
