<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call(PassportClientSeeder::class);
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'telephone' => '123456789', 
            'password' => Hash::make('password'), 
        ]);
    }
}
