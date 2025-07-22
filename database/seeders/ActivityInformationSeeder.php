<?php

namespace Database\Seeders;

use App\Models\ActivityInformation;
use App\Models\User;
use Illuminate\Database\Seeder;

class ActivityInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::first();

        $activities = [
            [
                'title' => 'Annual Tech Conference 2024',
                'description' => 'Join us for the biggest technology conference of the year featuring industry leaders and innovative solutions',
                'content' => 'The Annual Tech Conference 2024 brings together technology professionals, students, and industry experts to explore the latest trends in artificial intelligence, blockchain, cloud computing, and cybersecurity. The event features keynote speakers from major tech companies, interactive workshops, networking sessions, and product demonstrations. Participants will gain valuable insights into emerging technologies and career opportunities in the tech industry.',
                'location' => 'Jakarta Convention Center, Indonesia',
                'start_date' => '2024-08-15 08:00:00',
                'end_date' => '2024-08-17 17:00:00',
                'organizer' => 'Indonesian Tech Association',
                'registration_fee' => 150000.00,
                'registration_deadline' => '2024-08-01 23:59:59',
                'requirements' => 'Valid ID, Registration confirmation, Professional attire recommended',
                'contact_person' => 'Sarah Johnson',
                'contact_phone' => '+62-21-1234-5678',
                'contact_email' => 'sarah.johnson@techconf.id',
                'is_active' => true,
                'created_by' => $admin?->id,
            ],
            [
                'title' => 'Digital Marketing Workshop Series',
                'description' => 'Comprehensive workshop series covering modern digital marketing strategies and tools',
                'content' => 'This intensive workshop series covers essential digital marketing topics including SEO optimization, social media marketing, content strategy, email marketing, and analytics. Participants will learn hands-on techniques using real-world case studies and industry-standard tools. The series includes practical assignments and certification upon completion.',
                'location' => 'University Auditorium, Bandung',
                'start_date' => '2024-07-20 09:00:00',
                'end_date' => '2024-07-20 16:00:00',
                'organizer' => 'Digital Marketing Institute',
                'registration_fee' => 75000.00,
                'registration_deadline' => '2024-07-15 17:00:00',
                'requirements' => 'Laptop, Basic computer skills, Notebook for taking notes',
                'contact_person' => 'Michael Chen',
                'contact_phone' => '+62-22-9876-5432',
                'contact_email' => 'michael.chen@dmi.ac.id',
                'is_active' => true,
                'created_by' => $admin?->id,
            ],
            [
                'title' => 'Startup Pitch Competition',
                'description' => 'Annual startup pitch competition for young entrepreneurs to showcase their innovative business ideas',
                'content' => 'The Startup Pitch Competition provides a platform for aspiring entrepreneurs to present their business ideas to a panel of experienced investors and industry experts. Participants will have the opportunity to receive feedback, mentorship, and potential funding. The competition includes multiple rounds: initial application screening, semi-final presentations, and final pitch presentations.',
                'location' => 'Innovation Hub, Surabaya',
                'start_date' => '2024-09-10 10:00:00',
                'end_date' => '2024-09-10 18:00:00',
                'organizer' => 'Indonesia Startup Foundation',
                'registration_fee' => null,
                'registration_deadline' => '2024-08-25 23:59:59',
                'requirements' => 'Business plan presentation, Team of 2-4 members, Prototype demonstration (if applicable)',
                'contact_person' => 'Amanda Putri',
                'contact_phone' => '+62-31-5555-7777',
                'contact_email' => 'amanda.putri@startupfound.id',
                'is_active' => true,
                'created_by' => $admin?->id,
            ],
            [
                'title' => 'Environmental Sustainability Summit',
                'description' => 'International summit focusing on environmental sustainability and climate change solutions',
                'content' => 'The Environmental Sustainability Summit brings together environmental scientists, policy makers, business leaders, and activists to discuss pressing environmental challenges and sustainable solutions. Topics include renewable energy, waste management, sustainable agriculture, and climate change mitigation strategies. The summit features panel discussions, research presentations, and collaborative workshops.',
                'location' => 'Bali International Convention Centre',
                'start_date' => '2024-10-05 08:30:00',
                'end_date' => '2024-10-07 17:30:00',
                'organizer' => 'Green Future Alliance',
                'registration_fee' => 200000.00,
                'registration_deadline' => '2024-09-20 18:00:00',
                'requirements' => 'Environmental background preferred, Research papers for presenters, Travel arrangements',
                'contact_person' => 'Dr. Indira Sari',
                'contact_phone' => '+62-361-4444-8888',
                'contact_email' => 'indira.sari@greenfuture.org',
                'is_active' => true,
                'created_by' => $admin?->id,
            ],
            [
                'title' => 'Coding Bootcamp for Beginners',
                'description' => 'Intensive coding bootcamp designed for complete beginners to learn programming fundamentals',
                'content' => 'This comprehensive coding bootcamp is designed for individuals with no prior programming experience. The curriculum covers programming fundamentals, web development basics, database concepts, and project-based learning. Participants will build real-world applications and receive career guidance. The bootcamp includes mentorship, code reviews, and job placement assistance.',
                'location' => 'Tech Learning Center, Yogyakarta',
                'start_date' => '2024-11-01 09:00:00',
                'end_date' => '2024-11-30 17:00:00',
                'organizer' => 'Code Academy Indonesia',
                'registration_fee' => 500000.00,
                'registration_deadline' => '2024-10-15 23:59:59',
                'requirements' => 'Personal laptop, Basic English proficiency, Commitment to full attendance',
                'contact_person' => 'Rizki Pratama',
                'contact_phone' => '+62-274-3333-9999',
                'contact_email' => 'rizki.pratama@codeacademy.id',
                'is_active' => true,
                'created_by' => $admin?->id,
            ],
        ];

        foreach ($activities as $activity) {
            ActivityInformation::create($activity);
        }
    }
}
