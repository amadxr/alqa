<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'email' => 'hola@alqagaleria.com',
                'role' => 2,
                'password' => Hash::make('warimon')
            ]
        ]);
    }
}
