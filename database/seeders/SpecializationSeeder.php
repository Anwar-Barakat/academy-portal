<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specializations = [

            [
                'en' => 'Computer Sciences',
                'ar' => 'علوم الحاسوب'
            ],
            [
                'en' => 'English',
                'ar' => 'اللغة الأنكليزية'
            ],
            [
                'en' => 'Computer Vision',
                'ar' => 'الأبصار الحاسوبي'
            ],
            [
                'en'    => 'Artificial Intelligence',
                'ar'    => 'الذكاء الأصطناعي'
            ]
        ];

        foreach ($specializations as $specialization) {
            if (is_null(Specialization::where('name->en', $specialization['en'])->where('name->ar', $specialization['ar'])->first()))
                Specialization::create(['name' => $specialization]);
        }
    }
}
