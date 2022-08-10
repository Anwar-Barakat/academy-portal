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
                'en' => 'First Year',
                'ar' => 'السنة الأولى',
            ],
            [
                'en' => 'Second Year',
                'ar' => 'السنة الثانية',
            ],
            [
                'en' => 'Third Year',
                'ar' => 'السنة الثالثة',
            ],
            [
                'en' => 'Fourth Year',
                'ar' => 'السنة الرابعة',
            ],
            [
                'en' => 'Fifth Year',
                'ar' => 'السنة الخامسة',
            ],
        ];

        foreach ($grades as $grade) {
            if (is_null(Grade::where('name->en', $grade['en'])->where('name->ar', $grade['ar'])->first()))
                Grade::create(['name' => $grade]);
        }
    }
}