<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Rumah',
                'description' => 'Rumah tinggal dengan berbagai tipe dan ukuran',
                'icon' => '🏠',
                'is_active' => true,
            ],
            [
                'name' => 'Tanah',
                'description' => 'Tanah kavling siap bangun atau investasi',
                'icon' => '🌾',
                'is_active' => true,
            ],
            [
                'name' => 'Apartemen',
                'description' => 'Unit apartemen di berbagai lokasi strategis',
                'icon' => '🏢',
                'is_active' => true,
            ],
            [
                'name' => 'Ruko',
                'description' => 'Rumah toko untuk usaha dan bisnis',
                'icon' => '🏪',
                'is_active' => true,
            ],
            [
                'name' => 'Villa',
                'description' => 'Villa mewah untuk liburan atau investasi',
                'icon' => '🏖️',
                'is_active' => true,
            ],
            [
                'name' => 'Kontrakan',
                'description' => 'Rumah kontrakan untuk disewakan',
                'icon' => '🏘️',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($categoryData['name'])],
                $categoryData
            );
        }
    }
}
