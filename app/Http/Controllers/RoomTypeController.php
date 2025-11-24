<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoomType;

class RoomTypeController extends Controller
{
    public function index()
    {
        $roomTypes = RoomType::withCount('rooms')->latest()->get();
        return view('room-types', compact('roomTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:room_types,name',
            'description' => 'nullable|string|max:1000',
            'price_per_night' => 'required|numeric|min:0',
            'max_occupancy' => 'required|integer|min:1',
        ], [
            'name.required' => 'The room type name field is required.',
            'name.unique' => 'This room type name already exists. Please choose a different name.',
            'name.max' => 'The room type name may not be greater than 255 characters.',
            'description.max' => 'The description may not be greater than 1000 characters.',
            'price_per_night.required' => 'The price per night field is required.',
            'price_per_night.numeric' => 'The price per night must be a number.',
            'price_per_night.min' => 'The price per night must be at least 0.',
            'max_occupancy.required' => 'The max occupancy field is required.',
            'max_occupancy.integer' => 'The max occupancy must be an integer.',
            'max_occupancy.min' => 'The max occupancy must be at least 1.',
        ]);

        RoomType::create($validated);
        return redirect()->back()->with('success', 'Room type added successfully.');
    }

    public function update(Request $request, RoomType $roomType)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:room_types,name,' . $roomType->id,
            'description' => 'nullable|string|max:1000',
            'price_per_night' => 'required|numeric|min:0',
            'max_occupancy' => 'required|integer|min:1',
        ], [
            'name.required' => 'The room type name field is required.',
            'name.unique' => 'This room type name already exists. Please choose a different name.',
            'name.max' => 'The room type name may not be greater than 255 characters.',
            'description.max' => 'The description may not be greater than 1000 characters.',
            'price_per_night.required' => 'The price per night field is required.',
            'price_per_night.numeric' => 'The price per night must be a number.',
            'price_per_night.min' => 'The price per night must be at least 0.',
            'max_occupancy.required' => 'The max occupancy field is required.',
            'max_occupancy.integer' => 'The max occupancy must be an integer.',
            'max_occupancy.min' => 'The max occupancy must be at least 1.',
        ]);

        $roomType->update($validated);
        return redirect()->back()->with('success', 'Room type updated successfully.');
    }

    public function destroy(RoomType $roomType)
    {
        $roomType->delete();
        return redirect()->back()->with('success', 'Room type deleted successfully.');
    }
}


