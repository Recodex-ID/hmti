<?php

namespace Database\Seeders;

use App\Models\CircularLetter;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CircularLetterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::first();

        $circularLetters = [
            [
                'title' => 'Annual Academic Calendar 2024-2025',
                'description' => 'Official announcement of the academic calendar for the upcoming academic year 2024-2025',
                'content' => 'This circular letter contains the complete academic calendar for the 2024-2025 academic year. It includes important dates such as semester start and end dates, examination periods, holidays, and other significant academic events. All students and faculty members are required to adhere to this schedule.',
                'number' => 'CL/HMTI/2024/001',
                'letter_date' => '2024-01-15',
                'is_active' => true,
                'created_by' => $admin?->id,
            ],
            [
                'title' => 'New Laboratory Safety Protocols',
                'description' => 'Updated safety protocols for all laboratory activities',
                'content' => 'In compliance with the latest safety standards, all laboratories must implement new safety protocols effective immediately. This includes mandatory safety training for all personnel, updated emergency procedures, and enhanced safety equipment requirements. Failure to comply may result in laboratory access restrictions.',
                'number' => 'CL/HMTI/2024/002',
                'letter_date' => '2024-02-20',
                'is_active' => true,
                'created_by' => $admin?->id,
            ],
            [
                'title' => 'Research Grant Application Guidelines',
                'description' => 'Guidelines for submitting research grant applications for 2024',
                'content' => 'The research committee announces the opening of research grant applications for the year 2024. This circular contains comprehensive guidelines including eligibility criteria, application procedures, required documents, evaluation process, and submission deadlines. All interested faculty members and students are encouraged to apply.',
                'number' => 'CL/HMTI/2024/003',
                'letter_date' => '2024-03-10',
                'is_active' => true,
                'created_by' => $admin?->id,
            ],
            [
                'title' => 'Digital Transformation Initiative',
                'description' => 'Implementation of digital systems across all departments',
                'content' => 'As part of our digital transformation initiative, all departments will transition to digital systems for administrative processes. This includes online registration, digital document management, virtual meeting platforms, and enhanced e-learning capabilities. Training sessions will be provided to ensure smooth transition.',
                'number' => 'CL/HMTI/2024/004',
                'letter_date' => '2024-04-05',
                'is_active' => true,
                'created_by' => $admin?->id,
            ],
            [
                'title' => 'COVID-19 Health Protocol Updates',
                'description' => 'Updated health protocols in response to current COVID-19 situation',
                'content' => 'Following the latest government guidelines and health authority recommendations, we are updating our COVID-19 health protocols. These updates include modified social distancing measures, updated sanitization procedures, adjusted classroom capacities, and flexible attendance policies for affected individuals.',
                'number' => 'CL/HMTI/2024/005',
                'letter_date' => '2024-05-12',
                'is_active' => false,
                'created_by' => $admin?->id,
            ],
        ];

        foreach ($circularLetters as $letter) {
            CircularLetter::create($letter);
        }
    }
}
