<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\RoomType;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roomTypes = RoomType::all();

        if ($roomTypes->isEmpty()) {
            $this->command->warn('No room types found. Please run RoomTypeSeeder first.');
            return;
        }

        $rooms = [
            ['room_number' => '101', 'floor' => '1', 'status' => 'available', 'room_type_id' => $roomTypes->where('name', 'Standard Single')->first()?->id],
            ['room_number' => '102', 'floor' => '1', 'status' => 'available', 'room_type_id' => $roomTypes->where('name', 'Standard Single')->first()?->id],
            ['room_number' => '201', 'floor' => '2', 'status' => 'occupied', 'room_type_id' => $roomTypes->where('name', 'Standard Double')->first()?->id],
            ['room_number' => '202', 'floor' => '2', 'status' => 'available', 'room_type_id' => $roomTypes->where('name', 'Standard Double')->first()?->id],
            ['room_number' => '301', 'floor' => '3', 'status' => 'available', 'room_type_id' => $roomTypes->where('name', 'Deluxe Suite')->first()?->id],
            ['room_number' => '302', 'floor' => '3', 'status' => 'maintenance', 'room_type_id' => $roomTypes->where('name', 'Deluxe Suite')->first()?->id],
            ['room_number' => '401', 'floor' => '4', 'status' => 'available', 'room_type_id' => $roomTypes->where('name', 'Family Room')->first()?->id],
            ['room_number' => '501', 'floor' => '5', 'status' => 'occupied', 'room_type_id' => $roomTypes->where('name', 'Presidential Suite')->first()?->id],
        ];

        foreach ($rooms as $room) {
            Room::create($room);
        }
    }
}

