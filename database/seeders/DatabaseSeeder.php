<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

                // \App\Models\Admin::factory(4)->create();
                \App\Models\Admin::factory()->create([
                        'name' => 'Test User',
                        'email' => 'test@example.com',
                        'password' => 'zxcc'
                    ]);

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => 'zxc'
        // ]);

        // $this->call([
        //     UserSeeder::class
        // ]);

        // $this->call([
        //     ClassroomSeeder::class
        // ]);
        // \App\Models\Topic::factory(3)->create();
    }
}
