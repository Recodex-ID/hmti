<?php

namespace Database\Seeders;

use App\Models\Department;
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
            Department::create($departmentData);
        }
    }
}
