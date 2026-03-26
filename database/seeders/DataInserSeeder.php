<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DataInserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {

            Attendance::create([
                'student_id' => rand(1, 50), 
                'class_id' => rand(1, 12),
                'date' => Carbon::today()->subDays(rand(0, 5)),
                'status' => collect(['present', 'absent', 'late', 'excused'])->random(),
                'remarks' => 'Auto generated',
                'recorded_by' => 3,
            ]);
        }
    }
}
