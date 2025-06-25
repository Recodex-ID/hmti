<?php

namespace Database\Seeders;

use App\Models\Hero;
use Illuminate\Database\Seeder;

class HeroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $heroes = [
            [
                'title' => 'Selamat Datang di Politeknik Siber dan Teknologi Informasi',
                'subtitle' => 'Membangun masa depan digital Indonesia melalui pendidikan vokasi berkualitas tinggi, inovasi teknologi, dan pengembangan sumber daya manusia yang kompeten di bidang keamanan siber dan teknologi informasi.',
                'image' => 'heroes/hero-main-campus.jpg',
            ],
            [
                'title' => 'Menjadi Pionir Teknologi Masa Depan',
                'subtitle' => 'Bergabunglah dengan komunitas pembelajar yang dinamis dan raih kesempatan untuk mengembangkan keterampilan teknologi terdepan dalam lingkungan akademik yang mendukung inovasi dan kreativitas.',
                'image' => 'heroes/hero-technology-lab.jpg',
            ],
            [
                'title' => 'Pendidikan Berkualitas untuk Karir yang Cemerlang',
                'subtitle' => 'Dapatkan pengalaman pembelajaran praktis dengan kurikulum yang dirancang sesuai kebutuhan industri, didukung oleh fasilitas modern dan dosen berpengalaman untuk mempersiapkan masa depan yang sukses.',
                'image' => 'heroes/hero-classroom.jpg',
            ],
        ];

        foreach ($heroes as $hero) {
            Hero::create($hero);
        }
    }
}
