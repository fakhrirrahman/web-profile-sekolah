<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->updateOrCreate([
            'email' => env('ADMIN_EMAIL', 'admin@goldensierra.test'),
        ], [
            'name' => env('ADMIN_NAME', 'Admin Golden Sierra'),
            'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
            'email_verified_at' => now(),
        ]);
    }
}
