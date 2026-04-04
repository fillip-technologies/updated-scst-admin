<?php

namespace Database\Seeders;

use App\Models\Teacher;
use App\Models\TeacherAttend;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class DataInserSeeder extends Seeder
{
   public function run(): void
    {
        $leaveTypes = ['Sick Leave', 'Casual Leave', 'Emergency Leave', 'Paid Leave'];
        $statuses = ['present', 'absent', 'late', 'leave'];

        for ($i = 1; $i <= 20; $i++) {

            TeacherAttend::create([
                'school_id'   => 3,
                'teacher_id'  => rand(1, 10), // must exist in teachers table
                'date'        => Carbon::now()->subDays(rand(1, 30)),
                'leave_type'  => $leaveTypes[array_rand($leaveTypes)],
                'reason'      => 'Sample reason for leave ' . $i,
                'status'      => $statuses[array_rand($statuses)],
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
