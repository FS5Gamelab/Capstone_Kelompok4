<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'user_id',
        'customer_name',
        'phone_number',
        'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
