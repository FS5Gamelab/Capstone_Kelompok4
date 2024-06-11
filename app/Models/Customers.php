<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customers extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'customers';
    protected $fillable = [
        'user_id',
        'customer_name',
        'phone_number',
        'address'
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Orders::class, 'customer_id', 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($customer) {
            $customer->user()->delete();
        });

        static::restoring(function ($customer) {
            if ($customer->user()->withTrashed()->exists()) {
                $customer->user()->restore();
            }
        });

        static::forceDeleted(function ($customer) {
            $customer->user()->forceDelete();
        });
    }
}
