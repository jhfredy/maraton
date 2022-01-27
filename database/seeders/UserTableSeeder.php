<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'name' => 'John',
            'email' => 'root@app.com',
            'password' => \Hash::make('12345'),
            'email_verified_at' => now(),
        ]);
    }
}
