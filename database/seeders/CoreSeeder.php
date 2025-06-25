<?php

namespace Database\Seeders;

use App\Models\Core;
use Illuminate\Database\Seeder;

class CoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cores = [
            [
                'name' => 'Ahmad Rizki Pratama',
                'photo' => 'cores/chairman.jpg',
                'position' => 'Ketua Himpunan',
            ],
            [
                'name' => 'Siti Nurhaliza Putri',
                'photo' => 'cores/vice-chairman.jpg',
                'position' => 'Wakil Ketua Himpunan',
            ],
            [
                'name' => 'Muhammad Fajar Sidiq',
                'photo' => 'cores/secretary-general.jpg',
                'position' => 'Sekretaris Jenderal',
            ],
            [
                'name' => 'Dewi Sartika Maharani',
                'photo' => 'cores/secretary.jpg',
                'position' => 'Sekretaris',
            ],
            [
                'name' => 'Budi Santoso Wijaya',
                'photo' => 'cores/treasurer.jpg',
                'position' => 'Bendahara',
            ],
        ];

        foreach ($cores as $core) {
            Core::create($core);
        }
    }
}
