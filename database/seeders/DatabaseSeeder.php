<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        User::factory()->create([
            'name'=>'Admin',
            'email'=>'admin@example.com',
            'password'=>Hash::make('password'),
            'role'=>'admin'
        ]);

        $f1 = User::factory()->create([
            'name'=>'John Freelancer',
            'email'=>'john@freelance.com',
            'password'=>Hash::make('password'),
            'role'=>'freelancer'
        ]);

        $f2 = User::factory()->create([
            'name'=>'Sara Designer',
            'email'=>'sara@freelance.com',
            'password'=>Hash::make('password'),
            'role'=>'freelancer'
        ]);

        User::factory()->create([
            'name'=>'ACME Client',
            'email'=>'client@acme.com',
            'password'=>Hash::make('password'),
            'role'=>'client'
        ]);

        Service::create([
            'user_id'=>$f1->id,
            'title'=>'Website Development',
            'description'=>'I build modern responsive websites using Laravel and Tailwind/Bootstrap.',
            'price'=>200.00,
            'category'=>'Development',
            'status'=>'published'
        ]);

        Service::create([
            'user_id'=>$f2->id,
            'title'=>'Logo Design',
            'description'=>'Professional logo with 3 concepts and vector files.',
            'price'=>50.00,
            'category'=>'Design',
            'status'=>'published'
        ]);
    }
}