<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoomType;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomTypes = [
            [
                'name' => 'Standard Single',
                'description' => 'Comfortable single room with basic amenities, perfect for solo travelers.',
                'price_per_night' => 89.99,
                'max_occupancy' => 1,
            ],
            [
                'name' => 'Standard Double',
                'description' => 'Spacious double room with two beds, ideal for couples or friends.',
                'price_per_night' => 129.99,
                'max_occupancy' => 2,
            ],
            [
                'name' => 'Deluxe Suite',
                'description' => 'Luxurious suite with separate living area and premium amenities.',
                'price_per_night' => 249.99,
                'max_occupancy' => 3,
            ],
            [
                'name' => 'Family Room',
                'description' => 'Large family-friendly room with multiple beds and extra space.',
                'price_per_night' => 199.99,
                'max_occupancy' => 4,
            ],
            [
                'name' => 'Presidential Suite',
                'description' => 'Ultra-luxurious suite with premium features and stunning views.',
                'price_per_night' => 499.99,
                'max_occupancy' => 4,
            ],
        ];

        foreach ($roomTypes as $roomType) {
            RoomType::create($roomType);
        }
    }
}

