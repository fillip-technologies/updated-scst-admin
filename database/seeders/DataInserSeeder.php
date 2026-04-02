<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class DataInserSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = ['Math', 'Science', 'English', 'Hindi', 'Computer', 'Physics'];
        $educations = ['B.Ed', 'M.Ed', 'B.Sc', 'M.Sc', 'B.Tech', 'M.A'];
        $skillsList = ['Teaching', 'Communication', 'Leadership', 'Time Management'];

        for ($i = 1; $i <= 50; $i++) {

            Teacher::create([
                'school_id'     => 3,
                'name'          => 'Teacher ' . $i,
                'email'         => 'teacher' . $i . '@gmail.com',
                'phone'         => '98' . rand(10000000, 99999999),
                'address'       => 'Address ' . $i,
                'image'         => 'default.png',
                'subject'       => $subjects[array_rand($subjects)],
                'joining_date'  => Carbon::now()->subDays(rand(10, 1000)),
                'education'     => $educations[array_rand($educations)],
                'skills'        => implode(',', $skillsList),
                'certificate'   => 'certificate_' . $i . '.pdf',
                'gender'        => collect(['male', 'female'])->random(),
            ]);
        }
    }
}
