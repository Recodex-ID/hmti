<?php

namespace Database\Seeders;

use App\Models\Partnership;
use Illuminate\Database\Seeder;

class PartnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $partnerships = [
            [
                'type' => 'benchmark',
                'title' => 'Benchmark Partnership Program',
                'description' => 'Program kemitraan untuk benchmark dan studi banding dengan organisasi mahasiswa lain.',
                'content' => [
                    'Studi banding dengan himpunan mahasiswa universitas lain',
                    'Pertukaran best practices dalam pengelolaan organisasi',
                    'Kolaborasi dalam pengembangan program kerja',
                    'Sharing knowledge dan pengalaman organisasi',
                ],
                'contact_info' => [
                    'email' => 'benchmark@hmti.com',
                    'phone' => '081234567890',
                    'person' => 'Koordinator Benchmark',
                ],
                'is_active' => true,
            ],
            [
                'type' => 'media_partner',
                'title' => 'Media Partner Collaboration',
                'description' => 'Kemitraan dengan berbagai media untuk publikasi dan promosi kegiatan HMTI.',
                'content' => [
                    'Kerjasama publikasi kegiatan dan acara',
                    'Media coverage untuk event besar',
                    'Content creation dan digital marketing',
                    'Social media collaboration',
                ],
                'contact_info' => [
                    'email' => 'media@hmti.com',
                    'phone' => '081234567891',
                    'person' => 'Media Relations Manager',
                ],
                'is_active' => true,
            ],
            [
                'type' => 'mc_moderator',
                'title' => 'MC & Moderator Services',
                'description' => 'Layanan MC dan moderator profesional untuk berbagai acara dan event.',
                'content' => [
                    'Penyediaan MC profesional untuk acara formal',
                    'Moderator untuk seminar dan workshop',
                    'Host untuk acara entertainment',
                    'Training MC dan moderator untuk anggota',
                ],
                'contact_info' => [
                    'email' => 'mc@hmti.com',
                    'phone' => '081234567892',
                    'person' => 'MC Coordinator',
                ],
                'is_active' => true,
            ],
        ];

        foreach ($partnerships as $partnership) {
            Partnership::create($partnership);
        }
    }
}