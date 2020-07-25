<?php

use App\User;
use App\Instructor;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstructorUsersTableSeeder extends Seeder
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
            $faker = Faker::create();

            for ($i = 0; $i < 5; $i++) {
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

                $instructor = Instructor::create([
                    'user_id' => $user->id,
                    'fname' => $user->fname,
                    'lname' => $user->lname,
                    'email' => $user->email,
                    'dob' => $user->dob,
                    'email' => $user->email,
                    "mobile" => $user->mobile,
                    'gender' => 'male',
                    'detail' => $faker->sentence,
                    'status' => 1
                ]);
            }
            DB::commit();
        } catch (\Exception $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}
