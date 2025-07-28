<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\DepartmentFunction;
use Illuminate\Database\Seeder;

class DepartmentFunctionSeeder extends Seeder
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

        $functions = [
            'Internal' => [
                'Mengelola administrasi dan keuangan organisasi',
                'Mengkoordinasi kegiatan internal himpunan',
                'Menjalankan fungsi kesekretariatan',
                'Mengelola sumber daya manusia organisasi',
                'Melakukan evaluasi kinerja internal',
            ],
            'PSTI' => [
                'Mengembangkan program akademik mahasiswa',
                'Menjalin komunikasi dengan pihak fakultas',
                'Menyelenggarakan kegiatan pengembangan ilmu',
                'Memfasilitasi kebutuhan akademik mahasiswa',
                'Mengkoordinasi program penelitian mahasiswa',
            ],
            'Eksternal' => [
                'Menjalin kerjasama dengan organisasi luar',
                'Mengelola hubungan dengan alumni',
                'Mengembangkan jaringan eksternal',
                'Menyelenggarakan kegiatan kemitraan',
                'Mempromosikan organisasi ke publik',
            ],
        ];

        foreach ($departments as $department) {
            $departmentFunctions = $functions[$department->division] ?? $functions['Internal'];

            foreach ($departmentFunctions as $function) {
                DepartmentFunction::create([
                    'department_id' => $department->id,
                    'title' => $function,
                ]);
            }
        }
    }
}