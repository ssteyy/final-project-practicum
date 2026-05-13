<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user first
        $admin = User::firstOrCreate(
            ['email' => 'admin@freelancehub.com'],
            [
                'name' => 'Admin',
                'role' => 'admin',
                'password' => Hash::make('admin123'),
                'email_verified_at' => now(),
            ]
        );

        // Create support service for admin
        Service::firstOrCreate(
            ['freelancer_id' => $admin->id, 'title' => 'Customer Support'],
            [
                'description' => 'Customer support and assistance services.',
                'price' => 0.00,
                'category' => 'Support',
                'status' => 'published',
                'image_url' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&auto=format&fit=crop&q=60'
            ]
        );

        // Create freelancer user (ID will be 2 or auto-increment)
        $freelancer = User::firstOrCreate(
            ['email' => 'freelancer@freelancehub.com'],
            [
                'name' => 'John Developer',
                'role' => 'freelancer',
                'password' => Hash::make('freelancer123'),
                'email_verified_at' => now(),
            ]
        );

        // Create 5 mock services in different categories
        Service::create([
            'freelancer_id' => $freelancer->id,
            'title' => 'Web Development',
            'description' => 'Professional website development using modern technologies like React, Vue.js, and Laravel.',
            'price' => 500.00,
            'category' => 'Web Development',
            'status' => 'published',
            'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&auto=format&fit=crop&q=60'
        ]);

        Service::create([
            'freelancer_id' => $freelancer->id,
            'title' => 'Mobile App Design',
            'description' => 'Beautiful and user-friendly mobile application designs for iOS and Android platforms.',
            'price' => 300.00,
            'category' => 'Design',
            'status' => 'published',
            'image_url' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=800&auto=format&fit=crop&q=60'
        ]);

        Service::create([
            'freelancer_id' => $freelancer->id,
            'title' => 'Content Writing',
            'description' => 'Engaging and SEO-optimized content writing for blogs, websites, and marketing materials.',
            'price' => 100.00,
            'category' => 'Writing',
            'status' => 'published',
            'image_url' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=800&auto=format&fit=crop&q=60'
        ]);

        Service::create([
            'freelancer_id' => $freelancer->id,
            'title' => 'Digital Marketing',
            'description' => 'Comprehensive digital marketing strategies including SEO, social media, and email marketing.',
            'price' => 400.00,
            'category' => 'Marketing',
            'status' => 'published',
            'image_url' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&auto=format&fit=crop&q=60'
        ]);

        Service::create([
            'freelancer_id' => $freelancer->id,
            'title' => 'Video Editing',
            'description' => 'Professional video editing and post-production services for YouTube, social media, and commercials.',
            'price' => 250.00,
            'category' => 'Video Editing',
            'status' => 'published',
            'image_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&auto=format&fit=crop&q=60'
        ]);
    }
}
