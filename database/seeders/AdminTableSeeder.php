<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'role' => 1,
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'phone' => '8181818181',
            'isActive' => 1,
        ]);
    }
}
