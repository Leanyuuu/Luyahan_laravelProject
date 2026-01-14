<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $roomTypes = RoomType::all();
        $rooms = $this->buildRoomQuery($request)->get();

        $totalRooms = Room::count();
        $availableRooms = Room::where('status', 'available')->count();
        $totalRoomTypes = RoomType::count();
        $trashCount = Room::onlyTrashed()->count();

        return view('dashboard', [
            'rooms' => $rooms,
            'roomTypes' => $roomTypes,
            'totalRooms' => $totalRooms,
            'availableRooms' => $availableRooms,
            'totalRoomTypes' => $totalRoomTypes,
            'search' => $request->input('search'),
            'statusFilter' => $request->input('status'),
            'roomTypeFilter' => $request->input('room_type_id'),
            'trashCount' => $trashCount,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_number' => 'required|string|max:255|unique:rooms,room_number',
            'floor' => 'required|string|max:50',
            'status' => 'required|in:available,occupied,maintenance',
            'room_type_id' => 'nullable|exists:room_types,id',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'room_number.required' => 'The room number field is required.',
            'room_number.unique' => 'This room number already exists. Please choose a different room number.',
            'room_number.max' => 'The room number may not be greater than 255 characters.',
            'floor.required' => 'The floor field is required.',
            'floor.max' => 'The floor may not be greater than 50 characters.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid.',
            'room_type_id.exists' => 'The selected room type does not exist.',
            'photo.image' => 'The file must be an image.',
            'photo.mimes' => 'Only JPG and PNG formats are allowed.',
            'photo.max' => 'Maximum photo size is 2MB.',
        ]);

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')->store('rooms', 'public');
        }

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
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'room_number.required' => 'The room number field is required.',
            'room_number.unique' => 'This room number already exists. Please choose a different room number.',
            'room_number.max' => 'The room number may not be greater than 255 characters.',
            'floor.required' => 'The floor field is required.',
            'floor.max' => 'The floor may not be greater than 50 characters.',
            'status.required' => 'The status field is required.',
            'status.in' => 'The selected status is invalid.',
            'room_type_id.exists' => 'The selected room type does not exist.',
            'photo.image' => 'The file must be an image.',
            'photo.mimes' => 'Only JPG and PNG formats are allowed.',
            'photo.max' => 'Maximum photo size is 2MB.',
        ]);

        if ($request->hasFile('photo')) {
            if ($room->photo_path) {
                Storage::disk('public')->delete($room->photo_path);
            }

            $validated['photo_path'] = $request->file('photo')->store('rooms', 'public');
        }

        $room->update($validated);

        return redirect()->back()->with('success', 'Room updated successfully.');
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->back()->with('success', 'Room moved to trash.');
    }

    public function trash(Request $request)
    {
        $rooms = $this->buildRoomQuery($request, true)->get();

        return view('rooms.trash', [
            'rooms' => $rooms,
            'roomTypes' => RoomType::all(),
            'search' => $request->input('search'),
            'statusFilter' => $request->input('status'),
            'roomTypeFilter' => $request->input('room_type_id'),
        ]);
    }

    public function restore(int $id)
    {
        $room = Room::onlyTrashed()->findOrFail($id);
        $room->restore();

        return redirect()->route('rooms.trash')->with('success', 'Room restored successfully.');
    }

    public function forceDelete(int $id)
    {
        $room = Room::onlyTrashed()->findOrFail($id);

        if ($room->photo_path) {
            Storage::disk('public')->delete($room->photo_path);
        }

        $room->forceDelete();

        return redirect()->route('rooms.trash')->with('success', 'Room permanently deleted.');
    }

    public function exportPdf(Request $request)
    {
        $rooms = $this->buildRoomQuery($request)->get();

        try {
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('rooms.pdf', [
                'rooms' => $rooms,
                'generatedAt' => now(),
            ])->setPaper('a4', 'portrait');

            $filename = 'rooms_' . now()->format('Ymd_His') . '.pdf';

            return $pdf->download($filename);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to generate PDF: ' . $e->getMessage());
        }
    }

    protected function buildRoomQuery(Request $request, bool $onlyTrashed = false): Builder
    {
        $query = Room::with('roomType')->latest();

        if ($onlyTrashed) {
            $query->onlyTrashed();
        }

        if ($search = $request->input('search')) {
            $query->where(function (Builder $builder) use ($search) {
                $builder->where('room_number', 'like', '%' . $search . '%')
                    ->orWhere('floor', 'like', '%' . $search . '%')
                    ->orWhereHas('roomType', function (Builder $typeQuery) use ($search) {
                        $typeQuery->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        if ($roomTypeId = $request->input('room_type_id')) {
            $query->where('room_type_id', $roomTypeId);
        }

        return $query;
    }
}

