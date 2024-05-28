<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $fillable = [
        'profile_picture',
        'employees_name',
        'gender',
        'phone_number',
        'address',
        'user_id' // Tambahkan user_id untuk relasi
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($employee) {
            $employee->user()->delete();
        });
    }
}
