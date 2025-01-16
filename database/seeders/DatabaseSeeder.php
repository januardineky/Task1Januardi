<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Major;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Major::create([
            'major_name' => 'Rekayasa Perangkat Lunak',
            'description' => 'RPL'
        ]);
        
        User::create([
            'name' => 'Januardi',
            'email' => 'test@gmail.com',
            'username' => 'jan',
            'password' => bcrypt('12345')
        ]);

        User::create([
            'name' => 'Neky',
            'email' => 'test123@gmail.com',
            'username' => 'neky',
            'password' => bcrypt('12345')
        ]);
    }
}
