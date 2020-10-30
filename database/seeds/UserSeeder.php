<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'name' => 'Juan Dela Cruz',
            'email' => 'juandelacruz@gmail.com',
            'password' => Hash::make('password'),
            'api_token' => Str::random(60),
        ]);
    }
}
