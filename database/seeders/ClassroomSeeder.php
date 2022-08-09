<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $grades = collect(Grade::all()->modelKeys());

        $classrooms = [
            [
                'en' => 'First Classroom',
                'ar' => 'الصف الأول',
            ],
            [
                'en' => 'Second Classroom',
                'ar' => 'الصف الثاني',
            ],
            [
                'en' => 'Third Classroom',
                'ar' => 'الصف الثالث',
            ],
            [
                'en' => 'Fourth Classroom',
                'ar' => 'الصف الرابع',
            ],
        ];

        foreach ($classrooms as $classroom) {
            if (is_null(Classroom::where('name->en', $classroom['en'])->where('name->ar', $classroom['ar'])->first()))
                Classroom::create(['name' => $classroom, 'grade_id' => $grades->random(),]);
        }
    }
}