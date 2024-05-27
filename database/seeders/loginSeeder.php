<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class loginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            $UserData = [
            [
                'name'=>'admin laundry',
                'email'=>'admin@gmail.com',
                'role'=>'Super-admin',
                'password'=>bcrypt(87654321)
            ],
            [
                'name'=>'rangga',
                'email'=>'karyawan@gmail.com',
                'role'=>'Karyawan',
                'password'=>bcrypt(87654321)
            ],
            [
                'name'=>'lesti',
                'email'=>'pelanggan@gmail.com',
                'role'=>'Pelanggan',
                'password'=>bcrypt(87654321)
            ],
        ];
        foreach($UserData as $key => $val) {
            User::create($val);
        } 

    }
}
