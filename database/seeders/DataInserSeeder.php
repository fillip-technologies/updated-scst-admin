<?php

namespace Database\Seeders;

use App\Models\MainNotice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;


class DataInserSeeder extends Seeder
{
   public function run(): void
    {
        $badges = ['New', 'Important', 'Urgent', 'Update'];
        $types = ['Exam', 'Holiday', 'Event', 'General'];

        for ($i = 1; $i <= 10; $i++) {

            MainNotice::create([
                'title'         => 'Notice Title ' . $i,
                'date'          => Carbon::now()->subDays(rand(1, 100)),
                'notice_badge'  => $badges[array_rand($badges)],
                'notice_type'   => $types[array_rand($types)],
                'description'   => 'This is a sample description for notice ' . $i,
            ]);
        }
    }
}
