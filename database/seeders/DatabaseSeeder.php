<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create admin user if not exists
        $user = User::firstOrCreate(
            ['email' => 'admin@jagadproperty.com'],
            [
                'name' => 'Admin Property',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]
        );
        
        // Update existing admin to have admin role
        if ($user->role !== 'admin') {
            $user->update(['role' => 'admin']);
        }

        // Seed categories
        $this->call([
            CategorySeeder::class,
            PropertySeeder::class,
        ]);
    }
}
