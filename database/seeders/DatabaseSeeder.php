<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();



        DB::table('scholarship_documents')->insert([
            [
                'scheme_name' => 'Bihar Pre Matric SC Scholarship',
                'document_name' => 'Caste Certificate'
            ],
            [
                'scheme_name' => 'Bihar Pre Matric SC Scholarship',
                'document_name' => 'Income Certificate'
            ],
            [
                'scheme_name' => 'Bihar Pre Matric SC Scholarship',
                'document_name' => 'Aadhaar Card'
            ],
            [
                'scheme_name' => 'Bihar Post Matric ST Scholarship',
                'document_name' => 'Caste Certificate'
            ],
            [
                'scheme_name' => 'Bihar Post Matric ST Scholarship',
                'document_name' => 'Previous Marksheet'
            ]
        ]);

          DB::table('complaints')->insert([
            [
                'complaint_id' => 'CMP-ABC123',
                'student_name' => 'Ravi Kumar',
                'mobile' => '9998887776',
                'school_name' => 'Govt High School Patna',
                'issue_category' => 'Scholarship Delay',
                'description' => 'Scholarship amount not received.',
                'status' => 'open',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
