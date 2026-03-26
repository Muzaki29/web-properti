<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Property;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        if (!$user) {
            $user = User::factory()->create([
                'name' => 'Admin Property',
                'email' => 'admin@jagadproperty.com',
            ]);
        }

        $categories = Category::all();
        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }

        $properties = [
            [
                'title' => 'Rumah Mewah 2 Lantai di Jakarta Selatan',
                'description' => 'Rumah mewah 2 lantai dengan desain modern, lokasi strategis di Jakarta Selatan. Dekat dengan sekolah, mall, dan akses tol. Rumah dalam kondisi sangat baik, siap huni.',
                'price' => 2500000000,
                'property_type' => 'rumah',
                'status' => 'dijual',
                'address' => 'Jl. Kemang Raya No. 123',
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'postal_code' => '12730',
                'bedrooms' => 4,
                'bathrooms' => 3,
                'garages' => 2,
                'land_size' => 200,
                'building_size' => 350,
                'year_built' => 2020,
                'features' => ['Kolam Renang', 'Taman', 'Security 24/7', 'Parkir Luas'],
                'contact_name' => 'Budi Santoso',
                'contact_phone' => '081234567890',
                'contact_email' => 'budi@example.com',
                'is_featured' => true,
                'category_id' => $categories->where('name', 'Rumah')->first()->id,
            ],
            [
                'title' => 'Tanah Kavling Strategis di Bandung',
                'description' => 'Tanah kavling siap bangun di lokasi strategis Bandung. Dekat dengan pusat kota, akses jalan raya mudah. Cocok untuk investasi atau membangun rumah impian.',
                'price' => 500000000,
                'property_type' => 'tanah',
                'status' => 'dijual',
                'address' => 'Jl. Soekarno Hatta No. 456',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'postal_code' => '40235',
                'land_size' => 300,
                'features' => ['Sertifikat SHM', 'Akses Jalan Raya', 'Dekat Pusat Kota'],
                'contact_name' => 'Siti Nurhaliza',
                'contact_phone' => '081987654321',
                'contact_email' => 'siti@example.com',
                'is_featured' => true,
                'category_id' => $categories->where('name', 'Tanah')->first()->id,
            ],
            [
                'title' => 'Apartemen Studio di Surabaya',
                'description' => 'Apartemen studio modern dengan fasilitas lengkap. Lokasi di tengah kota Surabaya, dekat dengan mall dan perkantoran. Cocok untuk single atau pasangan muda.',
                'price' => 350000000,
                'property_type' => 'apartemen',
                'status' => 'dijual',
                'address' => 'Jl. Tunjungan No. 789',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'postal_code' => '60275',
                'bedrooms' => 1,
                'bathrooms' => 1,
                'building_size' => 35,
                'year_built' => 2022,
                'features' => ['Swimming Pool', 'Gym', 'Security 24/7', 'Parkir Bawah Tanah'],
                'contact_name' => 'Ahmad Fauzi',
                'contact_phone' => '082112345678',
                'contact_email' => 'ahmad@example.com',
                'is_featured' => false,
                'category_id' => $categories->where('name', 'Apartemen')->first()->id,
            ],
            [
                'title' => 'Ruko 2 Lantai di Yogyakarta',
                'description' => 'Ruko 2 lantai strategis untuk usaha. Lokasi di jalan utama Yogyakarta, ramai dengan aktivitas komersial. Cocok untuk berbagai jenis usaha.',
                'price' => 1200000000,
                'property_type' => 'ruko',
                'status' => 'dijual',
                'address' => 'Jl. Malioboro No. 321',
                'city' => 'Yogyakarta',
                'province' => 'DI Yogyakarta',
                'postal_code' => '55213',
                'building_size' => 120,
                'year_built' => 2018,
                'features' => ['Jalan Utama', 'Parkir Luas', 'Listrik 3 Phase'],
                'contact_name' => 'Dewi Sartika',
                'contact_phone' => '083123456789',
                'contact_email' => 'dewi@example.com',
                'is_featured' => false,
                'category_id' => $categories->where('name', 'Ruko')->first()->id,
            ],
            [
                'title' => 'Rumah Kontrakan 3 Unit di Depok',
                'description' => 'Rumah kontrakan terdiri dari 3 unit terpisah. Setiap unit memiliki 2 kamar tidur, 1 kamar mandi, dan dapur. Lokasi strategis dekat kampus dan pusat perbelanjaan.',
                'price' => 15000000,
                'property_type' => 'rumah',
                'status' => 'disewakan',
                'address' => 'Jl. Margonda Raya No. 654',
                'city' => 'Depok',
                'province' => 'Jawa Barat',
                'postal_code' => '16424',
                'bedrooms' => 2,
                'bathrooms' => 1,
                'land_size' => 150,
                'building_size' => 80,
                'year_built' => 2015,
                'features' => ['Dekat Kampus', 'Parkir Motor', 'Air PAM'],
                'contact_name' => 'Rudi Hartono',
                'contact_phone' => '084134567890',
                'contact_email' => 'rudi@example.com',
                'is_featured' => false,
                'category_id' => $categories->where('name', 'Kontrakan')->first()->id,
            ],
        ];

        foreach ($properties as $propertyData) {
            $propertyData['user_id'] = $user->id;
            // Generate slug if not provided
            if (empty($propertyData['slug'])) {
                $propertyData['slug'] = \Illuminate\Support\Str::slug($propertyData['title']);
            }
            Property::create($propertyData);
        }
    }
}
