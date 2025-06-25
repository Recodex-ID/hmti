<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Database\Seeder;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $communities = [
            // Community Type
            [
                'title' => 'Incoustic',
                'description' => 'Komunitas pengembang perangkat lunak yang berfokus pada sharing knowledge, best practices, dan kolaborasi dalam pengembangan aplikasi modern. Terbuka untuk semua level dari pemula hingga expert.',
                'category' => 'Community',
                'logo' => null,
            ],
            [
                'title' => 'Industrial Competition Community',
                'description' => 'Komunitas pecinta data science yang mengeksplorasi machine learning, artificial intelligence, dan analytics. Melakukan research bersama dan mengadakan workshop reguler.',
                'category' => 'Community',
                'logo' => null,
            ],
            [
                'title' => 'Koma Creative',
                'description' => 'Komunitas desainer yang fokus pada user interface dan user experience design. Berbagi portfolio, kritik konstruktif, dan trend terbaru dalam dunia design.',
                'category' => 'Community',
                'logo' => null,
            ],
            [
                'title' => 'Maroon Army',
                'description' => 'Komunitas yang peduli dengan keamanan siber, ethical hacking, dan pentesting. Melakukan research tentang vulnerability dan cara mengatasinya.',
                'category' => 'Community',
                'logo' => null,
            ],
            [
                'title' => 'Community Motor Telkom University',
                'description' => 'Komunitas developer mobile untuk Android dan iOS. Berbagi tips, tutorial, dan collaborate dalam pengembangan aplikasi mobile yang user-friendly.',
                'category' => 'Community',
                'logo' => null,
            ],
            [
                'title' => 'Community of Tentor',
                'description' => 'Komunitas yang mendukung dan berkontribusi pada proyek-proyek open source. Mengadakan hackathon dan coding session bersama.',
                'category' => 'Community',
                'logo' => null,
            ],
            [
                'title' => 'Society',
                'description' => 'Komunitas yang mendukung dan berkontribusi pada proyek-proyek open source. Mengadakan hackathon dan coding session bersama.',
                'category' => 'Community',
                'logo' => null,
            ],

            // Committee Type
            [
                'title' => 'Invention',
                'description' => 'Komite akademik yang bertanggung jawab atas kurikulum, standar akademik, dan evaluasi program studi. Memastikan kualitas pendidikan sesuai dengan standar nasional dan internasional.',
                'category' => 'Committee',
                'logo' => null,
            ],
            [
                'title' => 'SEHATI',
                'description' => 'Komite yang menangani urusan kemahasiswaan, kegiatan ekstrakurikuler, dan kesejahteraan mahasiswa. Menjembatani komunikasi antara mahasiswa dan institusi.',
                'category' => 'Committee',
                'logo' => null,
            ],
            [
                'title' => 'LEGION',
                'description' => 'Komite yang mengkoordinasikan kegiatan penelitian dan inovasi. Memfasilitasi kolaborasi penelitian antar fakultas dan mendukung publikasi ilmiah.',
                'category' => 'Committee',
                'logo' => null,
            ],
            [
                'title' => 'Increase',
                'description' => 'Komite penjaminan mutu yang memastikan standar kualitas dalam semua aspek operasional. Melakukan audit internal dan evaluasi berkelanjutan.',
                'category' => 'Committee',
                'logo' => null,
            ],
            [
                'title' => 'Inaugurasi',
                'description' => 'Komite etik yang mengawasi dan memastikan semua kegiatan dilaksanakan sesuai dengan kode etik dan standar moral yang berlaku.',
                'category' => 'Committee',
                'logo' => null,
            ],
            [
                'title' => 'ORATIONS',
                'description' => 'Komite teknologi yang bertanggung jawab atas infrastruktur IT, pengembangan sistem informasi, dan implementasi teknologi baru dalam organisasi.',
                'category' => 'Committee',
                'logo' => null,
            ],
            [
                'title' => 'INFADE',
                'description' => 'Komite yang merencanakan dan mengorganisir berbagai acara institusional, seminar, konferensi, dan kegiatan besar lainnya.',
                'category' => 'Committee',
                'logo' => null,
            ],
        ];

        foreach ($communities as $community) {
            Community::create($community);
        }
    }
}
