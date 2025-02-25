<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'name' => 'Admin User',
                'api_token' => Str::random(80),
                'password' => bcrypt('password'),
                'permissions' => [
                    "platform.index" => true,
                    "platform.systems.roles" => true,
                    "platform.systems.users" => true,
                    "platform.systems.attachment" => true,
                ],
            ]
        );
    }
}
