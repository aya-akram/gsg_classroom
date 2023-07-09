<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;

class ClassroomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        \App\Models\Classroom::factory()->create([
            'name' => Str::random(10),
            'code' => Str::random(10),
            'section' => Str::random(10),
            'subject' => Str::random(10),
            'room' => Str::random(10),
            'cover_image_path' => Str::random(10),
            'theme' => Str::random(10),
            'user_id' => 1, // Assuming a user with id 1 exists
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        \App\Models\Classroom::factory()->create([
            'name' => Str::random(10),
            'code' => Str::random(10),
            'section' => Str::random(10),
            'subject' => Str::random(10),
            'room' => Str::random(10),
            'cover_image_path' => Str::random(10),
            'theme' => Str::random(10),
            'user_id' => 2, // Assuming a user with id 1 exists
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \App\Models\Classroom::factory()->create([
            'name' => Str::random(10),
            'code' => Str::random(10),
            'section' => Str::random(10),
            'subject' => Str::random(10),
            'room' => Str::random(10),
            'cover_image_path' => Str::random(10),
            'theme' => Str::random(10),
            'user_id' => 3, // Assuming a user with id 1 exists
            'status' => 'active',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
