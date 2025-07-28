<?php

namespace Database\Seeders;

use App\Models\Mpm;
use Illuminate\Database\Seeder;

class MpmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mpmData = [
            [
                'type' => 'komisi-a',
                'title' => 'Komisi A - Kebijakan Akademik',
                'description' => 'Komisi yang menangani kebijakan dan peraturan akademik mahasiswa.',
                'content' => [
                    'Mengkaji kebijakan akademik universitas',
                    'Membahas peraturan akademik mahasiswa',
                    'Mengevaluasi sistem pembelajaran',
                    'Memberikan rekomendasi perbaikan akademik',
                ],
                'is_active' => true,
            ],
            [
                'type' => 'komisi-b',
                'title' => 'Komisi B - Kesejahteraan Mahasiswa',
                'description' => 'Komisi yang fokus pada kesejahteraan dan fasilitas mahasiswa.',
                'content' => [
                    'Menangani isu kesejahteraan mahasiswa',
                    'Membahas fasilitas kampus',
                    'Mengkaji program beasiswa',
                    'Mengevaluasi layanan kemahasiswaan',
                ],
                'is_active' => true,
            ],
            [
                'type' => 'komisi-c',
                'title' => 'Komisi C - Pengembangan Organisasi',
                'description' => 'Komisi yang menangani pengembangan dan pemberdayaan organisasi kemahasiswaan.',
                'content' => [
                    'Mengembangkan kapasitas organisasi',
                    'Membahas struktur organisasi',
                    'Mengevaluasi kinerja organisasi',
                    'Memberikan rekomendasi pengembangan',
                ],
                'is_active' => true,
            ],
            [
                'type' => 'burt',
                'title' => 'BURT - Badan Urusan Rumah Tangga',
                'description' => 'Badan yang menangani urusan internal dan administrasi MPM.',
                'content' => [
                    'Mengelola administrasi MPM',
                    'Mengkoordinasi rapat dan kegiatan',
                    'Menangani urusan keuangan',
                    'Melakukan evaluasi internal',
                ],
                'is_active' => true,
            ],
        ];

        foreach ($mpmData as $data) {
            Mpm::create($data);
        }
    }
}