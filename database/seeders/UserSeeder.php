<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('8888')
        ]);
        User::create([
            'name' => 'rull123',
            'email' => 'adminrull@gmail.com',
            'password' => bcrypt('8888')
        ]);
        User::create([
            'name' => 'MustovaNamsa',
            'email' => 'MustovaNamsa@gmail.com',
            'password' => bcrypt('8888')
        ]);
    }
}
