<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employees extends Model
{
    use HasFactory, SoftDeletes;

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

        static::restoring(function ($employee) {
            if ($employee->user()->withTrashed()->exists()) {
                $employee->user()->restore();
            }
        });

        static::forceDeleted(function ($employee) {
            $employee->user()->forceDelete();
        });
    }
}
