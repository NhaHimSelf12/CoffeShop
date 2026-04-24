<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TeamMember;

class TeamMembersSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing records before re-seeding
        TeamMember::truncate();

        TeamMember::create([
            'name' => 'Alex Rivendell',
            'role' => 'Founder & CEO',
            'bio' => 'Crafting the vision since 2020. Passionate about great coffee and greater teams.',
            'image' => null,
            'socials' => json_encode(['linkedin' => '#', 'twitter' => '#']),
        ]);

        TeamMember::create([
            'name' => 'Sophia Chen',
            'role' => 'Head Barista',
            'bio' => 'Master of the golden crema. Sophia brings art and precision to every single cup.',
            'image' => null,
            'socials' => json_encode(['instagram' => '#', 'facebook' => '#']),
        ]);

        TeamMember::create([
            'name' => 'Marcus Thorne',
            'role' => 'Store Manager',
            'bio' => 'Ensuring seamless daily operations and a welcoming atmosphere for everyone.',
            'image' => null,
            'socials' => json_encode(['linkedin' => '#']),
        ]);

        TeamMember::create([
            'name' => 'Elena Vance',
            'role' => 'Customer Relations',
            'bio' => 'Your smile is our priority. Elena makes every guest feel right at home.',
            'image' => null,
            'socials' => json_encode(['instagram' => '#', 'twitter' => '#']),
        ]);

        TeamMember::create([
            'name' => 'Oliver Bennett',
            'role' => 'Operations Manager',
            'bio' => 'The engine that keeps us running. Oliver ensures every detail is perfect behind the scenes.',
            'image' => null,
            'socials' => json_encode(['linkedin' => '#']),
        ]);
    }
}
