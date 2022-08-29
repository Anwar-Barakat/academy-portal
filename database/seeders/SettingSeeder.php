<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
            [
                'key'    => 'current_season',
                'value'  => '2022-2023',
            ],
            [
                'key'    => 'title',
                'value'  => 'AN School',
            ],
            [
                'key'    => 'name',
                'value'  => 'AN Internation School',
            ],
            [
                'key'    => 'end_first_term',
                'value'  => '2023-03-17',
            ],
            [
                'key'    => 'end_second_term',
                'value'  => '2023-08-03',
            ],
            [
                'key'    => 'phone',
                'value'  => '0912312312',
            ],
            [
                'key'    => 'address',
                'value'  => 'Damascus',
            ],
            [
                'key'    => 'email',
                'value'  => 'info@an.com',
            ],
            [
                'key'    => 'logo',
                'value'  => '',
            ],
        ];

        foreach ($settings as $setting) {
            if (is_null(Setting::where('key', $setting['key'])->first()))
                Setting::create($setting);
        }
    }
}