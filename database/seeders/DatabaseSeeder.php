<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'address' => 'mandalay',
            'phone' => '09123123123',
            'role' => 'admin',
            'gender' => 'male',
            'password' => Hash::make('asdffdsa'),

        ]);
        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'address' => 'Yangon',
            'phone' => '09789654123',
            'role' => 'user',
            'gender' => 'female',
            'password' => Hash::make('asdffdsa'),

        ]);
    }
}
