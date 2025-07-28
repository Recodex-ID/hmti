<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Member;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = Department::all();

        if ($departments->isEmpty()) {
            return;
        }

        $names = [
            'Andi Pratama',
            'Sari Wijaya',
            'Budi Santoso',
            'Dina Kartika',
            'Eko Saputra',
            'Fitri Handayani',
            'Gilang Ramadhan',
            'Hani Salsabila',
            'Indra Gunawan',
            'Joko Widodo',
            'Karina Putri',
            'Lukman Hakim',
            'Maya Sari',
            'Nanda Pratama',
            'Oki Setiawan',
            'Putri Maharani',
            'Qori Rahman',
            'Rina Safitri',
            'Sandi Wijaya',
            'Tari Melati',
        ];

        foreach ($departments as $department) {
            // Create 1 head member
            Member::create([
                'department_id' => $department->id,
                'name' => $names[array_rand($names)],
                'position' => 'head',
                'start_year' => 2023,
                'end_year' => null,
            ]);

            // Create 3-5 staff members
            $staffCount = rand(3, 5);
            for ($i = 0; $i < $staffCount; $i++) {
                Member::create([
                    'department_id' => $department->id,
                    'name' => $names[array_rand($names)],
                    'position' => 'staff',
                    'start_year' => rand(2022, 2024),
                    'end_year' => rand(0, 10) > 8 ? 2024 : null, // 20% chance of having end_year
                ]);
            }
        }
    }
}