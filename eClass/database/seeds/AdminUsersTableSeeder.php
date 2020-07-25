<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'email' => 'admin@mediacity.co.in',
            'password' => bcrypt('123456'),
            'verified' => 1,
            'role' => 'admin'
        ]);
    }
}
