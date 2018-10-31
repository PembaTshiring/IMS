<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'ims@nevolutiontech.com',
            'password' => bcrypt('password'),
            'remember_token' => str_random(20),
            'created_at' => date("Y-m-d H:i:s")
        ]);
    }
}
