<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedbacks extends Model
{
    use HasFactory;
    protected $table = 'feedbacks';
    protected $fillable = [
        'id_customer',
        'id_user',
        'id_order',
        'feedback',
        'rating'
    ];

    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Orders::class);
    }
}
