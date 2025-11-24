<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\RoomType;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('roomType')->latest()->get();
        $roomTypes = RoomType::all();
        $totalRooms = Room::count();
        $availableRooms = Room::where('status', 'available')->count();

        return view('dashboard', compact('rooms', 'roomTypes', 'totalRooms', 'availableRooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|max:255|unique:rooms,room_number',
            'floor' => 'required|string|max:50',
            'status' => 'required|in:available,occupied,maintenance',
            'room_type_id' => 'nullable|exists:room_types,id',
        ], [
            'room_number.required' => 'The room number field is required.',
            'room_number.unique' => 'This room number already exists. Please choose a different room number.',
            'room_number.max' => 'The room number may not be greater than 255 characters.',
            'floor.required' => 'The floor field is required.',
            'floor.max' => 'The floor may not be greater than 50 characters.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid.',
            'room_type_id.exists' => 'The selected room type does not exist.',
        ]);

        Room::create($validated);

        return redirect()->back()->with('success', 'Room added successfully.');
    }

    public function update(Request $request, Room $room)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|max:255|unique:rooms,room_number,' . $room->id,
            'floor' => 'required|string|max:50',
            'status' => 'required|in:available,occupied,maintenance',
            'room_type_id' => 'nullable|exists:room_types,id',
        ], [
            'room_number.required' => 'The room number field is required.',
            'room_number.unique' => 'This room number already exists. Please choose a different room number.',
            'room_number.max' => 'The room number may not be greater than 255 characters.',
            'floor.required' => 'The floor field is required.',
            'floor.max' => 'The floor may not be greater than 50 characters.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid.',
            'room_type_id.exists' => 'The selected room type does not exist.',
        ]);

        $room->update($validated);

        return redirect()->back()->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->back()->with('success', 'Room deleted successfully.');
    }
}


