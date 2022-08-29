<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $this->call([
            GradeSeeder::class,
            ClassroomSeeder::class,
            BloodSeeder::class,
            NationalitySeeder::class,
            ReligionSeeder::class,
            SpecializationSeeder::class,
            SettingSeeder::class,
        ]);
    }
}