<?php

use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();

            $faker = Factory::create();

            $user = User::create([
                'fname' => $faker->name,
                'lname' => $faker->name,
                'dob' => $faker->date,
                'doa' => $faker->date,
                'mobile' => '0238028302830',
                'email' => $faker->email,
                'password' => bcrypt('123456'),
                'address' => $faker->address,
                'married_status' => 'yes',
                'city_id' => null,
                'status' => 1,
                'verified' => 1,
                'email_verified_at' => '1915-05-30 19:28:21',
            ]);
            DB::commit();
        } catch (\Exception $th) {
            DB::rollback();
            dd($th->getMessage());
        }
    }
}
