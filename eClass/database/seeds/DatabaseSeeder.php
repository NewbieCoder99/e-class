<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AllcitiesTableSeeder::class);
        $this->call(AllcountryTableSeeder::class);
        $this->call(AllstatesTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(AboutsTableSeeder::class);
        $this->call(CareersTableSeeder::class);
    }
}
