<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Department;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
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

        $agendas = [
            [
                'title' => 'Rapat Koordinasi Bulanan',
                'description' => 'Rapat koordinasi untuk membahas program kerja dan evaluasi kegiatan bulanan departemen.',
            ],
            [
                'title' => 'Workshop Pengembangan Skill',
                'description' => 'Workshop untuk meningkatkan kemampuan dan skill anggota departemen.',
            ],
            [
                'title' => 'Evaluasi Program Kerja',
                'description' => 'Evaluasi dan monitoring pelaksanaan program kerja departemen.',
            ],
            [
                'title' => 'Meeting Project Planning',
                'description' => 'Perencanaan project dan pembagian tugas untuk kegiatan mendatang.',
            ],
            [
                'title' => 'Diskusi Inovasi Program',
                'description' => 'Diskusi pengembangan program inovatif untuk kemajuan departemen.',
            ],
        ];

        foreach ($departments as $department) {
            foreach ($agendas as $agenda) {
                Agenda::create([
                    'department_id' => $department->id,
                    'title' => $agenda['title'],
                    'description' => $agenda['description'],
                ]);
            }
        }
    }
}