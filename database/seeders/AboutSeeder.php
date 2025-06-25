<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        About::create([
            'definition' => 'HMTI Univesitas Telkom adalah sebuah organisasi yang beranggotakan dan mewadahi seluruh mahasiswa Prodi Teknik Industri dan Manajemen Rekayasa Fakultas Rekayasa Industri Universitas Telkom.',

            'position_role' => 'HMTI Univesitas Telkom bersifat independen dan lembaga non-struktural. Fungsi HMTI di Telkom University adalah lembaga eksekutif dan organisasi yang bertugas untuk menampung aspirasi dari seluruh mahasiswa Teknik Industri dan Manajemen Rekayasa. Serta mengkoordinasikan dan merealisasikan segala kegiatan mahasiswa Teknik Industri. Selain itu, HMTI juga berperan untuk menciptakan kader-kader Teknik Industri yang pedulii dan berperan aktif dalam memajukkan Fakultas, Program Studi, dan Himpunan.',

            'vision' => 'Terwujudnya entitas HMTI Universitas Telkom yang memiliki siikap solutif, kredibel, dan dapat bersinergi dengan improvisasi dalam wadah yang ada di HMTI Universitas Telkom.',

            'mission' => [
                'Mengembangkan sumber daya entiitas HMTI Universitas Telkom dengan mengaplikasikan keilmuan teknik industri dan fungsi mahasiswa dalam kegiatan yang ada di HMTI',
                'Mengembangkan koordinasi antar entitas guna memaksimalkan fasilitas yang telah ada di HMTI',
                'Berkontribusi aktif sebagai jembatan untuk entitas HMTI Universitas Telkom dengan memperhatikan nilai-nilai yang ada di HMTI',
            ],

            'structural' => 'about/organizational-structure.png',
            'ad_art' => 'about/ad-art/hmti-ad-art-2024.pdf',
        ]);
    }
}
