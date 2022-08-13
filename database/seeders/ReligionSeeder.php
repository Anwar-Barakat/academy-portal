<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $religions = [

            [
                'en' => 'Muslim',
                'ar' => 'مسلم'
            ],
            [
                'en' => 'Christian',
                'ar' => 'مسيحي'
            ],
            [
                'en' => 'Other',
                'ar' => 'غيرذلك'
            ],
        ];

        foreach ($religions as $religion) {
            if (is_null(Religion::where('name->en', $religion['en'])->where('name->ar', $religion['ar'])->first()))
                Religion::create(['name' => $religion]);
        }
    }
}
