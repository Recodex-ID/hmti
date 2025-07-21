<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersAndRolesSeeder::class,
            DepartmentSeeder::class,
            CommunitySeeder::class,
            AboutSeeder::class,
            CoreSeeder::class,
            HeroSeeder::class,
            CircularLetterSeeder::class,
            ActivityInformationSeeder::class,
            CompetitionInformationSeeder::class,
            NewsSeeder::class,
        ]);
    }
}
