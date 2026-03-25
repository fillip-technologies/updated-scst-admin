<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataInserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = ['Male', 'Female'];
        $parentRelations = ['Father', 'Mother', 'Guardian'];

        $students = [];

        for ($i = 1; $i <= 50; $i++) {
            $gender = $genders[array_rand($genders)];
            $parentRelation = $parentRelations[array_rand($parentRelations)];

            $students[] = [
                'name' => "Student $i",
                'roll_number' => (string) $i,
                'class_id' => rand(1, 12), // Assigning randomly to class 1 to 12
                'dob' => now()->subYears(rand(6, 16))->format('Y-m-d'),
                'gender' => $gender,
                'email' => "student$i@example.com",
                'phone' => '9000000'.str_pad($i, 3, '0', STR_PAD_LEFT),
                'parent_name' => "Parent $i",
                'parent_email' => "parent$i@example.com",
                'parent_phone' => '9100000'.str_pad($i, 3, '0', STR_PAD_LEFT),
                'parent_relation' => $parentRelation,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('students')->insert($students);
    }
}
