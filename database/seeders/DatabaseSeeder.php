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
            'title' => 'Modern Web Development',
            'description' => 'Build responsive and high-performance websites using Laravel, React, and Tailwind CSS.',
            'price' => 575.00,
            'original_price' => 500.00,
            'platform_fee' => 75.00,
            'category' => 'Web Development',
            'status' => 'published',
            'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&auto=format&fit=crop&q=60'
        ]);

        Service::create([
            'freelancer_id' => $freelancer->id,
            'title' => 'UI/UX Mobile App Design',
            'description' => 'Create stunning mobile app interfaces and user experiences for iOS and Android.',
            'price' => 345.00,
            'original_price' => 300.00,
            'platform_fee' => 45.00,
            'category' => 'Design',
            'status' => 'published',
            'image_url' => 'https://images.unsplash.com/photo-1512941937669-90a1b58e7e9c?w=800&auto=format&fit=crop&q=60'
        ]);

        Service::create([
            'freelancer_id' => $freelancer->id,
            'title' => 'SEO-Optimized Content Writing',
            'description' => 'High-quality blog posts, website content, and marketing copy that ranks well.',
            'price' => 115.00,
            'original_price' => 100.00,
            'platform_fee' => 15.00,
            'category' => 'Writing',
            'status' => 'published',
            'image_url' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?w=800&auto=format&fit=crop&q=60'
        ]);

        Service::create([
            'freelancer_id' => $freelancer->id,
            'title' => 'Full Digital Marketing Package',
            'description' => 'Complete digital marketing including SEO, social media management, and email campaigns.',
            'price' => 460.00,
            'original_price' => 400.00,
            'platform_fee' => 60.00,
            'category' => 'Marketing',
            'status' => 'published',
            'image_url' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?w=800&auto=format&fit=crop&q=60'
        ]);

        Service::create([
            'freelancer_id' => $freelancer->id,
            'title' => 'Professional Video Editing',
            'description' => 'Expert video editing, color grading, and motion graphics for YouTube and commercials.',
            'price' => 287.50,
            'original_price' => 250.00,
            'platform_fee' => 37.50,
            'category' => 'Video Editing',
            'status' => 'published',
            'image_url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&auto=format&fit=crop&q=60'
        ]);

        // Remove default/test order between user 1 and user 2
        \App\Models\Order::where(function ($q) {
            $q->where('client_id', 1)->where('freelancer_id', 2);
        })->orWhere(function ($q) {
            $q->where('client_id', 2)->where('freelancer_id', 1);
        })->delete();
    }
}
