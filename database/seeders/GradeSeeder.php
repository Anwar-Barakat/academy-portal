<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = [
            [
                'en' => 'Primary Stage',
                'ar' => 'المرحلة الأبتدائية',
            ],
            [
                'en' => 'Secondary Stage',
                'ar' => 'المرحلة الثانوية',
            ],
            [
                'en' => 'First Year',
                'ar' => 'سنة أولى جامعة',
            ],
        ];

        foreach ($grades as $grade) {
            if (is_null(Grade::where('name->en', $grade['en'])->where('name->ar', $grade['ar'])->first()))
                Grade::create(['name' => $grade]);
        }
    }
}