<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\WorkProgram;
use Illuminate\Database\Seeder;

class WorkProgramSeeder extends Seeder
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

        $workPrograms = [
            'Internal' => [
                [
                    'title' => 'Pelatihan Kepemimpinan',
                    'description' => 'Program pelatihan untuk mengembangkan kemampuan kepemimpinan anggota organisasi.',
                ],
                [
                    'title' => 'Workshop Manajemen Organisasi',
                    'description' => 'Workshop untuk meningkatkan kemampuan manajemen dan administrasi organisasi.',
                ],
                [
                    'title' => 'Team Building Activity',
                    'description' => 'Kegiatan untuk mempererat hubungan dan kerjasama antar anggota.',
                ],
            ],
            'PSTI' => [
                [
                    'title' => 'Seminar Teknologi Industri',
                    'description' => 'Seminar tentang perkembangan terbaru dalam bidang teknologi industri.',
                ],
                [
                    'title' => 'Workshop Analisis Data',
                    'description' => 'Workshop praktik analisis data untuk penelitian dan tugas akademik.',
                ],
                [
                    'title' => 'Industrial Visit',
                    'description' => 'Kunjungan industri untuk memberikan wawasan praktis kepada mahasiswa.',
                ],
            ],
            'Eksternal' => [
                [
                    'title' => 'Program Magang Industri',
                    'description' => 'Program magang bekerjasama dengan berbagai perusahaan industri.',
                ],
                [
                    'title' => 'Career Development Session',
                    'description' => 'Sesi pengembangan karir dan persiapan memasuki dunia kerja.',
                ],
                [
                    'title' => 'Alumni Networking Event',
                    'description' => 'Acara networking dengan alumni untuk membangun jaringan profesional.',
                ],
            ],
        ];

        foreach ($departments as $department) {
            $programs = $workPrograms[$department->division] ?? $workPrograms['Internal'];

            foreach ($programs as $program) {
                WorkProgram::create([
                    'department_id' => $department->id,
                    'title' => $program['title'],
                    'description' => $program['description'],
                ]);
            }
        }
    }
}