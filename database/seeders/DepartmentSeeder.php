<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\DepartmentFunction;
use App\Models\WorkProgram;
use App\Models\Agenda;
use App\Models\Member;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'title' => 'Departemen Human Resource',
                'description' => 'Departemen yang menangani sumber daya manusia, rekrutmen, dan pengembangan karyawan.',
                'division' => 'Internal',
                'logo' => null,
            ],
            [
                'title' => 'Departemen Kaderisasi',
                'description' => 'Departemen yang mengelola keuangan, akuntansi, dan pelaporan keuangan perusahaan.',
                'division' => 'Internal',
                'logo' => null,
            ],
            [
                'title' => 'Departemen Kemahasiswaan',
                'description' => 'Departemen yang menangani infrastruktur IT, pengembangan sistem, dan dukungan teknis.',
                'division' => 'Internal',
                'logo' => null,
            ],
            [
                'title' => 'Departemen Akademik',
                'description' => 'Program studi yang fokus pada pengembangan perangkat lunak dan sistem informasi.',
                'division' => 'PSTI',
                'logo' => null,
            ],
            [
                'title' => 'Departemen Generasi Bisnis',
                'description' => 'Program studi yang menggabungkan teknologi informasi dengan manajemen bisnis.',
                'division' => 'PSTI',
                'logo' => null,
            ],
            [
                'title' => 'Departemen Riset & Kompetisi',
                'description' => 'Program studi yang fokus pada hardware komputer dan sistem embedded.',
                'division' => 'PSTI',
                'logo' => null,
            ],
            [
                'title' => 'Departemen Komunikasi & Informasi',
                'description' => 'Departemen eksternal yang menangani hubungan dengan vendor dan supplier.',
                'division' => 'Eksternal',
                'logo' => null,
            ],
            [
                'title' => 'Biro Dedikasi Masyarakat',
                'description' => 'Departemen eksternal yang mengelola hubungan dengan klien dan stakeholder.',
                'division' => 'Eksternal',
                'logo' => null,
            ],
            [
                'title' => 'Biro Public Relation',
                'description' => 'Departemen eksternal yang fokus pada pengembangan kemitraan strategis.',
                'division' => 'Eksternal',
                'logo' => null,
            ],
        ];

        foreach ($departments as $departmentData) {
            $department = Department::create($departmentData);
            
            // Create sample functions for each department
            $functions = [
                'Koordinasi Tim',
                'Perencanaan Program',
                'Evaluasi Kinerja'
            ];
            
            foreach ($functions as $functionTitle) {
                DepartmentFunction::create([
                    'department_id' => $department->id,
                    'title' => $functionTitle
                ]);
            }
            
            // Create sample work programs
            $workPrograms = [
                [
                    'title' => 'Program Pengembangan ' . $department->title,
                    'description' => 'Program pengembangan dan peningkatan kualitas ' . strtolower($department->title)
                ],
                [
                    'title' => 'Program Pelatihan ' . $department->title,
                    'description' => 'Program pelatihan dan capacity building untuk anggota ' . strtolower($department->title)
                ]
            ];
            
            foreach ($workPrograms as $programData) {
                WorkProgram::create([
                    'department_id' => $department->id,
                    'title' => $programData['title'],
                    'description' => $programData['description']
                ]);
            }
            
            // Create sample agendas
            $agendas = [
                [
                    'title' => 'Rapat Koordinasi ' . $department->title,
                    'description' => 'Rapat koordinasi rutin untuk evaluasi dan perencanaan program'
                ],
                [
                    'title' => 'Workshop ' . $department->title,
                    'description' => 'Workshop peningkatan kapasitas anggota departemen'
                ]
            ];
            
            foreach ($agendas as $agendaData) {
                Agenda::create([
                    'department_id' => $department->id,
                    'title' => $agendaData['title'],
                    'description' => $agendaData['description']
                ]);
            }
            
            // Create sample members
            $members = [
                [
                    'name' => 'Kepala ' . $department->title,
                    'position' => 'head',
                    'start_year' => 2024,
                    'end_year' => null
                ],
                [
                    'name' => 'Staff ' . $department->title . ' 1',
                    'position' => 'staff',
                    'start_year' => 2024,
                    'end_year' => null
                ],
                [
                    'name' => 'Staff ' . $department->title . ' 2',
                    'position' => 'staff',
                    'start_year' => 2023,
                    'end_year' => 2024
                ]
            ];
            
            foreach ($members as $memberData) {
                Member::create([
                    'department_id' => $department->id,
                    'name' => $memberData['name'],
                    'position' => $memberData['position'],
                    'photo' => null,
                    'start_year' => $memberData['start_year'],
                    'end_year' => $memberData['end_year']
                ]);
            }
        }
    }
}
