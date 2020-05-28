<?php

use Illuminate\Database\Seeder;

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
            'name' => 'Johana y Antonio',
            'email' => 'hola@alqagaleria.com',
            'password' => Hash::make('warimon')
        ]);
    }
}
