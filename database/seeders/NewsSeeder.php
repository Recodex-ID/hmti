<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::first();

        $newsArticles = [
            [
                'title' => 'University Launches New AI Research Center',
                'excerpt' => 'The university announces the establishment of a cutting-edge artificial intelligence research center to advance AI education and research',
                'content' => 'The university has officially launched its new Artificial Intelligence Research Center, marking a significant milestone in its commitment to advancing technology education and research. The center will focus on developing innovative AI solutions for healthcare, education, and sustainable development. With state-of-the-art equipment and collaboration with leading tech companies, the center aims to produce groundbreaking research and train the next generation of AI specialists. The facility includes dedicated labs for machine learning, computer vision, natural language processing, and robotics research.',
                'category' => 'Technology',
                'tags' => ['AI', 'Research', 'Technology', 'Innovation'],
                'is_featured' => true,
                'is_published' => true,
                'published_at' => '2024-01-15 09:00:00',
                'views_count' => 1250,
                'author_id' => $admin?->id,
            ],
            [
                'title' => 'Student Startup Wins International Competition',
                'excerpt' => 'A team of university students secures first place in global entrepreneurship competition with their innovative fintech solution',
                'content' => 'A remarkable achievement for our university as a team of computer science students has won first place in the prestigious International Student Entrepreneurship Competition held in Singapore. Their fintech startup, "PaySecure," developed an innovative blockchain-based payment security system that addresses fraud prevention in digital transactions. The competition featured over 200 teams from 50 countries, making this victory particularly significant. The winning team receives $50,000 in seed funding and mentorship from leading venture capitalists to further develop their solution.',
                'category' => 'Achievement',
                'tags' => ['Students', 'Startup', 'Competition', 'Fintech', 'Blockchain'],
                'is_featured' => true,
                'is_published' => true,
                'published_at' => '2024-02-20 14:30:00',
                'views_count' => 890,
                'author_id' => $admin?->id,
            ],
            [
                'title' => 'New Campus Sustainability Initiative Launched',
                'excerpt' => 'University implements comprehensive sustainability program to reduce carbon footprint and promote environmental awareness',
                'content' => 'The university has launched an ambitious sustainability initiative aimed at achieving carbon neutrality by 2030. The comprehensive program includes installation of solar panels across campus buildings, implementation of smart energy management systems, introduction of electric shuttle services, and establishment of campus-wide recycling programs. Students and faculty are actively participating in various environmental projects including urban gardening, waste reduction campaigns, and renewable energy research. The initiative aligns with global sustainability goals and demonstrates the university\'s commitment to environmental responsibility.',
                'category' => 'Environment',
                'tags' => ['Sustainability', 'Environment', 'Green Campus', 'Climate Action'],
                'is_featured' => false,
                'is_published' => true,
                'published_at' => '2024-03-10 11:15:00',
                'views_count' => 654,
                'author_id' => $admin?->id,
            ],
            [
                'title' => 'International Partnership Expands Study Abroad Opportunities',
                'excerpt' => 'New agreements with universities in Europe and Asia provide students with enhanced global education experiences',
                'content' => 'The university has signed strategic partnership agreements with ten prestigious universities across Europe and Asia, significantly expanding study abroad opportunities for students. These partnerships include exchange programs, joint degree offerings, research collaborations, and cultural immersion experiences. Students can now participate in semester-long programs in countries including Germany, Netherlands, Japan, South Korea, and Singapore. The agreements also facilitate faculty exchanges and collaborative research projects, enhancing the international dimension of education and research at our institution.',
                'category' => 'International',
                'tags' => ['Partnership', 'Study Abroad', 'International', 'Exchange'],
                'is_featured' => false,
                'is_published' => true,
                'published_at' => '2024-04-05 16:45:00',
                'views_count' => 432,
                'author_id' => $admin?->id,
            ],
            [
                'title' => 'Faculty Research Published in Nature Journal',
                'excerpt' => 'Groundbreaking research on quantum computing applications published in prestigious scientific journal',
                'content' => 'Dr. Maya Sari from the Physics Department has achieved a significant academic milestone with the publication of her quantum computing research in Nature Physics, one of the world\'s most prestigious scientific journals. Her research on quantum error correction algorithms has potential applications in developing more stable quantum computing systems. The study, conducted in collaboration with international research teams, represents three years of intensive research and experimentation. This publication elevates the university\'s research profile and establishes Dr. Sari as a leading expert in quantum computing.',
                'category' => 'Research',
                'tags' => ['Research', 'Quantum Computing', 'Publication', 'Physics'],
                'is_featured' => true,
                'is_published' => true,
                'published_at' => '2024-05-12 10:00:00',
                'views_count' => 778,
                'author_id' => $admin?->id,
            ],
            [
                'title' => 'Alumni Success Story: Tech Entrepreneur Returns as Guest Lecturer',
                'excerpt' => 'Successful alumnus who founded billion-dollar tech company shares insights with current students',
                'content' => 'The university welcomed back distinguished alumnus James Wong, founder and CEO of TechNova Solutions, a billion-dollar cloud computing company. During his visit, Wong delivered inspiring lectures to computer science and business students, sharing his entrepreneurial journey from student to successful tech leader. He discussed the challenges of building a startup, the importance of innovation, and how his university education laid the foundation for his success. Wong also announced the establishment of a scholarship fund to support promising entrepreneurs among current students.',
                'category' => 'Alumni',
                'tags' => ['Alumni', 'Success Story', 'Entrepreneur', 'Guest Lecture'],
                'is_featured' => false,
                'is_published' => true,
                'published_at' => '2024-06-18 13:20:00',
                'views_count' => 923,
                'author_id' => $admin?->id,
            ],
            [
                'title' => 'University Ranks Top 10 in National Technology Education Survey',
                'excerpt' => 'Latest national ranking places university among top institutions for technology education and innovation',
                'content' => 'The university has achieved a remarkable ranking of 8th place in the National Technology Education Excellence Survey 2024, conducted by the Ministry of Education and leading industry partners. The ranking evaluates institutions based on curriculum quality, research output, industry partnerships, graduate employment rates, and innovation metrics. This achievement reflects the university\'s commitment to providing world-class technology education and maintaining strong connections with industry leaders. The recognition is expected to attract more talented students and enhance collaboration opportunities with technology companies.',
                'category' => 'Achievement',
                'tags' => ['Ranking', 'Technology Education', 'Excellence', 'Recognition'],
                'is_featured' => true,
                'is_published' => true,
                'published_at' => '2024-07-25 08:30:00',
                'views_count' => 1156,
                'author_id' => $admin?->id,
            ],
            [
                'title' => 'Campus Innovation Hub Opens for Student Entrepreneurs',
                'excerpt' => 'New innovation hub provides workspace, mentorship, and resources for student startups and entrepreneurial projects',
                'content' => 'The university has opened its state-of-the-art Innovation Hub, a 5000-square-meter facility designed to support student entrepreneurs and foster innovation. The hub features co-working spaces, prototype labs, 3D printing facilities, meeting rooms, and mentorship programs. Students can access resources including business development support, legal advice, funding opportunities, and connections with industry partners. The facility has already attracted over 50 student startup teams working on projects ranging from mobile apps to sustainable technology solutions.',
                'category' => 'Innovation',
                'tags' => ['Innovation Hub', 'Entrepreneurship', 'Startup', 'Student Support'],
                'is_featured' => false,
                'is_published' => true,
                'published_at' => '2024-08-30 15:00:00',
                'views_count' => 567,
                'author_id' => $admin?->id,
            ],
        ];

        foreach ($newsArticles as $article) {
            News::create($article);
        }
    }
}
