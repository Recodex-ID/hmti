<?php

namespace Database\Seeders;

use App\Models\CompetitionInformation;
use App\Models\User;
use Illuminate\Database\Seeder;

class CompetitionInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::first();

        $competitions = [
            [
                'title' => 'International Programming Contest 2024',
                'description' => 'Premier programming competition for university students worldwide',
                'content' => 'The International Programming Contest 2024 is a prestigious competition that brings together the brightest programming minds from universities around the globe. Participants will solve complex algorithmic problems using their preferred programming languages. The contest features multiple rounds including online qualifiers, regional competitions, and the world finals. Teams of three students compete to solve challenging problems within strict time limits.',
                'category' => 'Programming',
                'level' => 'International',
                'start_date' => '2024-09-15 09:00:00',
                'end_date' => '2024-09-15 17:00:00',
                'organizer' => 'International Collegiate Programming Contest Foundation',
                'registration_fee' => null,
                'registration_deadline' => '2024-08-30 23:59:59',
                'rules_regulations' => 'Teams must consist of exactly 3 current university students. Each team is allowed one computer and printed reference materials. No electronic devices or internet access permitted during contest. Programming languages: C, C++, Java, Python, Kotlin. Contest duration: 5 hours with 8-12 problems to solve.',
                'prizes' => '1st Place: $10,000 + Gold Medals, 2nd Place: $5,000 + Silver Medals, 3rd Place: $2,500 + Bronze Medals, Top 12 teams receive prizes',
                'requirements' => 'University enrollment verification, Team registration with 3 members, Programming experience, University endorsement letter',
                'contact_person' => 'Prof. William Chen',
                'contact_phone' => '+1-555-0123',
                'contact_email' => 'william.chen@icpc.global',
                'website_url' => 'https://icpc.global',
                'is_active' => true,
                'created_by' => $admin?->id,
            ],
            [
                'title' => 'National Cybersecurity Challenge',
                'description' => 'Capture The Flag competition focusing on cybersecurity skills and knowledge',
                'content' => 'The National Cybersecurity Challenge is a comprehensive Capture The Flag (CTF) competition designed to test participants knowledge and skills in various cybersecurity domains. The competition covers areas including web security, cryptography, reverse engineering, forensics, network security, and penetration testing. Participants can compete individually or in teams to solve security challenges and capture flags.',
                'category' => 'Cybersecurity',
                'level' => 'National',
                'start_date' => '2024-10-20 08:00:00',
                'end_date' => '2024-10-22 20:00:00',
                'organizer' => 'National Cybersecurity Institute',
                'registration_fee' => 50000.00,
                'registration_deadline' => '2024-10-10 18:00:00',
                'rules_regulations' => 'Individual or team participation (max 4 members per team). Virtual competition platform accessible 24/7 during event. No sharing of solutions between teams. Use of automated tools is permitted. All activities must comply with legal and ethical guidelines.',
                'prizes' => '1st Place: $5,000 + Certification, 2nd Place: $3,000 + Certification, 3rd Place: $1,500 + Certification, Top 10 receive recognition certificates',
                'requirements' => 'Basic cybersecurity knowledge, Computer with stable internet connection, Valid identification, Signed ethics agreement',
                'contact_person' => 'Dr. Sandra Martinez',
                'contact_phone' => '+62-21-8888-9999',
                'contact_email' => 'sandra.martinez@cybersec.id',
                'website_url' => 'https://cyberchallenge.cybersec.id',
                'is_active' => true,
                'created_by' => $admin?->id,
            ],
            [
                'title' => 'AI Innovation Challenge',
                'description' => 'Artificial Intelligence competition focusing on innovative solutions to real-world problems',
                'content' => 'The AI Innovation Challenge invites participants to develop innovative artificial intelligence solutions addressing real-world problems in healthcare, education, environment, or social issues. Teams will present their AI models, demonstrate practical applications, and showcase the potential impact of their solutions. The competition emphasizes creativity, technical excellence, and social responsibility.',
                'category' => 'Artificial Intelligence',
                'level' => 'National',
                'start_date' => '2024-11-10 09:00:00',
                'end_date' => '2024-11-12 16:00:00',
                'organizer' => 'AI Research Consortium Indonesia',
                'registration_fee' => 100000.00,
                'registration_deadline' => '2024-10-25 23:59:59',
                'rules_regulations' => 'Teams of 2-5 members allowed. Solution must use AI/ML technologies. Original work only - no plagiarism. Open source datasets encouraged. Final presentation must include live demonstration. Source code must be submitted for evaluation.',
                'prizes' => '1st Place: $8,000 + Mentorship Program, 2nd Place: $5,000 + Research Grant, 3rd Place: $3,000 + Publication Opportunity, Innovation Award: $2,000',
                'requirements' => 'AI/ML technical background, Team formation with diverse skills, Working prototype, Technical documentation, Presentation materials',
                'contact_person' => 'Dr. Bambang Setiawan',
                'contact_phone' => '+62-22-7777-3333',
                'contact_email' => 'bambang.setiawan@airc.id',
                'website_url' => 'https://ai-challenge.airc.id',
                'is_active' => true,
                'created_by' => $admin?->id,
            ],
            [
                'title' => 'Mobile App Development Contest',
                'description' => 'Competition for innovative mobile applications addressing local community needs',
                'content' => 'The Mobile App Development Contest challenges participants to create innovative mobile applications that address specific needs in Indonesian communities. The competition focuses on apps that can improve daily life, enhance local services, support small businesses, or solve social problems. Participants must develop functional mobile apps for Android or iOS platforms.',
                'category' => 'Mobile Development',
                'level' => 'Local',
                'start_date' => '2024-08-25 10:00:00',
                'end_date' => '2024-08-25 18:00:00',
                'organizer' => 'Jakarta Mobile Developers Community',
                'registration_fee' => 25000.00,
                'registration_deadline' => '2024-08-15 22:00:00',
                'rules_regulations' => 'Individual or team participation (max 3 members). App must be functional and installable. Original concept and code required. Use of third-party libraries allowed with proper attribution. Presentation must include app demonstration.',
                'prizes' => '1st Place: Rp 3,000,000 + Smartphone, 2nd Place: Rp 2,000,000 + Tablet, 3rd Place: Rp 1,000,000 + Smartwatch, Best UI/UX: Rp 500,000',
                'requirements' => 'Mobile development experience, Android Studio or Xcode setup, Functional mobile app prototype, Presentation skills',
                'contact_person' => 'Andi Susanto',
                'contact_phone' => '+62-21-5555-1111',
                'contact_email' => 'andi.susanto@jmdcom.id',
                'website_url' => 'https://mobilecontest.jmdcom.id',
                'is_active' => true,
                'created_by' => $admin?->id,
            ],
            [
                'title' => 'Data Science Competition',
                'description' => 'Analytics competition focusing on extracting insights from complex datasets',
                'content' => 'The Data Science Competition challenges participants to analyze complex datasets and extract meaningful insights that can drive business decisions or solve real-world problems. Participants will work with large datasets, apply statistical methods, machine learning algorithms, and data visualization techniques to present their findings. The competition emphasizes both technical skills and storytelling with data.',
                'category' => 'Data Science',
                'level' => 'National',
                'start_date' => '2024-12-01 08:00:00',
                'end_date' => '2024-12-03 17:00:00',
                'organizer' => 'Indonesian Data Science Society',
                'registration_fee' => 75000.00,
                'registration_deadline' => '2024-11-15 20:00:00',
                'rules_regulations' => 'Teams of 1-4 members. Use provided datasets only. Any programming language/tool allowed. Solutions must be reproducible. Final submission includes code, analysis, and presentation. External data sources prohibited.',
                'prizes' => '1st Place: Rp 15,000,000 + Conference Tickets, 2nd Place: Rp 10,000,000 + Online Courses, 3rd Place: Rp 7,500,000 + Books, Best Visualization: Rp 2,500,000',
                'requirements' => 'Statistics/Data Science background, Programming skills (Python/R preferred), Data analysis tools, Presentation preparation',
                'contact_person' => 'Dila Kartika',
                'contact_phone' => '+62-31-2222-4444',
                'contact_email' => 'dila.kartika@idss.org',
                'website_url' => 'https://datasci-comp.idss.org',
                'is_active' => true,
                'created_by' => $admin?->id,
            ],
        ];

        foreach ($competitions as $competition) {
            CompetitionInformation::create($competition);
        }
    }
}
