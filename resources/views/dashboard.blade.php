<x-layouts.app :title="__('Dashboard')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <!-- Success Message -->
        @if(session('success'))
            <div class="rounded-xl bg-gradient-to-r from-emerald-500 to-teal-600 p-4 text-white shadow-lg shadow-emerald-500/20">
                <div class="flex items-center gap-2">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <!-- Stats Cards -->
        <div class="grid auto-rows-min gap-6 md:grid-cols-2 lg:grid-cols-4">
            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-indigo-600 via-indigo-500 to-blue-600 p-6 shadow-xl shadow-indigo-500/30 transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl hover:shadow-indigo-500/40">
                <div class="absolute inset-0 bg-gradient-to-br from-white/15 via-transparent to-transparent"></div>
                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10 blur-2xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-indigo-100/90 uppercase tracking-wide">Total Rooms</p>
                        <h3 class="mt-3 text-5xl font-extrabold text-white drop-shadow-lg">{{ $totalRooms }}</h3>
                    </div>
                    <div class="rounded-2xl bg-white/25 p-4 backdrop-blur-md shadow-lg">
                        <svg class="h-9 w-9 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-600 p-6 shadow-xl shadow-emerald-500/30 transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl hover:shadow-emerald-500/40">
                <div class="absolute inset-0 bg-gradient-to-br from-white/15 via-transparent to-transparent"></div>
                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10 blur-2xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-emerald-100/90 uppercase tracking-wide">Available Rooms</p>
                        <h3 class="mt-3 text-5xl font-extrabold text-white drop-shadow-lg">{{ $availableRooms }}</h3>
                    </div>
                    <div class="rounded-2xl bg-white/25 p-4 backdrop-blur-md shadow-lg">
                        <svg class="h-9 w-9 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-amber-500 via-orange-500 to-rose-600 p-6 shadow-xl shadow-amber-500/30 transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl hover:shadow-amber-500/40">
                <div class="absolute inset-0 bg-gradient-to-br from-white/15 via-transparent to-transparent"></div>
                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10 blur-2xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-amber-100/90 uppercase tracking-wide">Occupancy Rate</p>
                        <h3 class="mt-3 text-5xl font-extrabold text-white drop-shadow-lg">
                            {{ $totalRooms > 0 ? round((($totalRooms - $availableRooms) / $totalRooms) * 100) : 0 }}%
                        </h3>
                    </div>
                    <div class="rounded-2xl bg-white/25 p-4 backdrop-blur-md shadow-lg">
                        <svg class="h-9 w-9 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
            </div>

            <div class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-600 via-pink-500 to-rose-600 p-6 shadow-xl shadow-purple-500/30 transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl hover:shadow-purple-500/40">
                <div class="absolute inset-0 bg-gradient-to-br from-white/15 via-transparent to-transparent"></div>
                <div class="absolute -right-10 -top-10 h-32 w-32 rounded-full bg-white/10 blur-2xl"></div>
                <div class="relative flex items-center justify-between">
                    <div>
                        <p class="text-sm font-semibold text-purple-100/90 uppercase tracking-wide">Room Types</p>
                        <h3 class="mt-3 text-5xl font-extrabold text-white drop-shadow-lg">{{ $totalRoomTypes }}</h3>
                    </div>
                    <div class="rounded-2xl bg-white/25 p-4 backdrop-blur-md shadow-lg">
                        <svg class="h-9 w-9 text-white drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filters & Actions -->
        <div class="flex flex-col gap-3 rounded-2xl border border-slate-200/60 bg-white p-4 shadow-lg dark:border-slate-700/60 dark:bg-slate-800/50 md:flex-row md:items-center md:justify-between">
            <form action="{{ route('dashboard') }}" method="GET" class="flex flex-1 flex-col gap-3 md:flex-row md:items-center">
                <div class="flex-1">
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-600 dark:text-slate-300">Search</label>
                    <input type="search" name="search" value="{{ $search }}" placeholder="Search by room number, floor, or type" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm transition-all duration-200 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100">
                </div>

                <div class="md:w-52">
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-600 dark:text-slate-300">Status</label>
                    <select name="status" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm transition-all duration-200 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100">
                        <option value="">All</option>
                        <option value="available" {{ $statusFilter === 'available' ? 'selected' : '' }}>Available</option>
                        <option value="occupied" {{ $statusFilter === 'occupied' ? 'selected' : '' }}>Occupied</option>
                        <option value="maintenance" {{ $statusFilter === 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                    </select>
                </div>

                <div class="md:w-64">
                    <label class="mb-2 block text-xs font-semibold uppercase tracking-wide text-slate-600 dark:text-slate-300">Room Type</label>
                    <select name="room_type_id" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm transition-all duration-200 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100">
                        <option value="">All</option>
                        @foreach($roomTypes as $roomType)
                            <option value="{{ $roomType->id }}" {{ (string) $roomTypeFilter === (string) $roomType->id ? 'selected' : '' }}>
                                {{ $roomType->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-wrap items-center gap-2">
                    <button type="submit" class="rounded-xl bg-gradient-to-r from-indigo-600 via-indigo-500 to-blue-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/40 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-indigo-500/50">Apply</button>
                    <a href="{{ route('dashboard') }}" class="rounded-xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-700">Clear</a>
                </div>
            </form>

            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ route('rooms.export.pdf', request()->query()) }}" class="flex items-center gap-2 rounded-xl bg-emerald-600 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-emerald-500/30 transition hover:scale-105 hover:shadow-xl">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Export PDF
                </a>
                <a href="{{ route('rooms.trash') }}" class="flex items-center gap-2 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-semibold text-rose-700 shadow-sm transition hover:shadow-md dark:border-rose-800/60 dark:bg-rose-900/20 dark:text-rose-200">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Trash ({{ $trashCount }})
                </a>
            </div>
        </div>

        <!-- Room Management Section -->
        <div class="relative h-full flex-1 overflow-hidden rounded-2xl border border-slate-200/60 bg-white shadow-xl dark:border-slate-700/60 dark:bg-slate-800/50 backdrop-blur-sm">
            <div class="flex h-full flex-col p-6">
                <!-- Add New Room Form -->
                <div class="mb-6 rounded-xl border border-slate-200/60 bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/20 p-6 shadow-lg dark:border-slate-700/60 dark:from-slate-900/80 dark:via-slate-800/60 dark:to-slate-900/40">
                    <h2 class="mb-4 text-2xl font-bold bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent dark:from-indigo-400 dark:to-blue-400">Add New Room</h2>

                    <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data" class="grid gap-4 md:grid-cols-2">
                        @csrf

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Room Number</label>
                            <input type="text" name="room_number" value="{{ old('room_number') }}" placeholder="Enter room number" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm transition-all duration-200 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:shadow-md dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-400">
                            @error('room_number')
                                <p class="mt-1 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Floor</label>
                            <input type="text" name="floor" value="{{ old('floor') }}" placeholder="Enter floor number" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm transition-all duration-200 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:shadow-md dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-400">
                            @error('floor')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Status</label>
                            <select name="status" required class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm transition-all duration-200 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:shadow-md dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-400">
                                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="occupied" {{ old('status') == 'occupied' ? 'selected' : '' }}>Occupied</option>
                                <option value="maintenance" {{ old('status') == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Room Type</label>
                            <select name="room_type_id" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm transition-all duration-200 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:shadow-md dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-400">
                                <option value="">Select a room type (optional)</option>
                                @foreach($roomTypes as $roomType)
                                    <option value="{{ $roomType->id }}" {{ old('room_type_id') == $roomType->id ? 'selected' : '' }}>
                                        {{ $roomType->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('room_type_id')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Photo (JPG/PNG, max 2MB)</label>
                            <input type="file" name="photo" accept=".jpg,.jpeg,.png" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm transition-all duration-200 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:shadow-md dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-400">
                            @error('photo')
                                <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2 flex justify-end">
                            <button type="submit" class="rounded-xl bg-gradient-to-r from-indigo-600 via-indigo-500 to-blue-600 px-8 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/40 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-indigo-500/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/30">
                                Add Room
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Room List Table -->
                <div class="flex-1 overflow-auto">
                    <h2 class="mb-4 text-xl font-bold text-neutral-900 dark:text-neutral-100">Room List</h2>
                    <div class="overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
                        <table class="w-full min-w-full">
                            <thead>
                                <tr class="border-b border-slate-200 bg-gradient-to-r from-indigo-50 via-blue-50 to-slate-50 dark:border-slate-700 dark:from-slate-800/80 dark:via-indigo-900/20 dark:to-slate-800/60">
                                    <th class="px-4 py-3 text-left text-sm font-bold text-slate-700 dark:text-slate-200">#</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Photo</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Room Number</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Floor</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Status</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Room Type</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                                @forelse($rooms as $room)
                                    <tr class="transition-all duration-200 hover:bg-gradient-to-r hover:from-indigo-50 hover:via-blue-50 hover:to-transparent dark:hover:from-indigo-900/30 dark:hover:via-blue-900/20 dark:hover:to-transparent">
                                        <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3">
                                            @if($room->photo_url)
                                                <img src="{{ $room->photo_url }}" alt="Room {{ $room->room_number }} photo" class="h-10 w-10 rounded-full object-cover shadow-sm ring-2 ring-indigo-100 dark:ring-indigo-900/40">
                                            @else
                                                <div class="flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-indigo-500 to-blue-600 text-sm font-bold uppercase text-white shadow-sm">
                                                    {{ $room->initials }}
                                                </div>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm text-neutral-900 dark:text-neutral-100">{{ $room->room_number }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $room->floor }}</td>
                                        <td class="px-4 py-3 text-sm">
                                            @if($room->status == 'available')
                                                <span class="inline-flex items-center rounded-full bg-gradient-to-r from-emerald-500 to-teal-600 px-3 py-1 text-xs font-bold text-white shadow-md">
                                                    Available
                                                </span>
                                            @elseif($room->status == 'occupied')
                                                <span class="inline-flex items-center rounded-full bg-gradient-to-r from-rose-500 to-red-600 px-3 py-1 text-xs font-bold text-white shadow-md">
                                                    Occupied
                                                </span>
                                            @else
                                                <span class="inline-flex items-center rounded-full bg-gradient-to-r from-amber-500 to-orange-600 px-3 py-1 text-xs font-bold text-white shadow-md">
                                                    Maintenance
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">
                                            {{ $room->roomType ? $room->roomType->name : 'N/A' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <button onclick="editRoom({{ $room->id }}, '{{ $room->room_number }}', '{{ $room->floor }}', '{{ $room->status }}', {{ $room->room_type_id ? $room->room_type_id : 'null' }})"
                                                    class="rounded-lg bg-indigo-100 px-3 py-1.5 text-xs font-semibold text-indigo-700 transition-all duration-200 hover:bg-indigo-200 hover:shadow-md dark:bg-indigo-900/30 dark:text-indigo-300 dark:hover:bg-indigo-900/50">
                                                Edit
                                            </button>
                                            <span class="mx-2 text-slate-300">|</span>
                                            <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this room?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-lg bg-rose-100 px-3 py-1.5 text-xs font-semibold text-rose-700 transition-all duration-200 hover:bg-rose-200 hover:shadow-md dark:bg-rose-900/30 dark:text-rose-300 dark:hover:bg-rose-900/50">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-8 text-center text-sm text-neutral-500 dark:text-neutral-400">
                                            No rooms found. Add your first room above!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Room Modal -->
    <div id="editRoomModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/70 backdrop-blur-md">
        <div class="w-full max-w-2xl rounded-2xl border border-slate-200/60 bg-white p-8 shadow-2xl dark:border-slate-700/60 dark:bg-slate-800/95 backdrop-blur-xl">
            <h2 class="mb-4 text-lg font-semibold text-neutral-900 dark:text-neutral-100">Edit Room</h2>

            <form id="editRoomForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Room Number</label>
                        <input type="text" id="edit_room_number" name="room_number" required
                               class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm transition-all duration-200 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:shadow-md dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-400">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Floor</label>
                        <input type="text" id="edit_floor" name="floor" required
                               class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm transition-all duration-200 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:shadow-md dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-400">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Status</label>
                        <select id="edit_status" name="status" required
                                class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm transition-all duration-200 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:shadow-md dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-400">
                            <option value="available">Available</option>
                            <option value="occupied">Occupied</option>
                            <option value="maintenance">Maintenance</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Room Type</label>
                        <select id="edit_room_type_id" name="room_type_id"
                                class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                            <option value="">Select a room type (optional)</option>
                            @foreach($roomTypes as $roomType)
                                <option value="{{ $roomType->id }}">{{ $roomType->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Update Photo (optional)</label>
                        <input type="file" name="photo" accept=".jpg,.jpeg,.png" class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm transition-all duration-200 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:shadow-md dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-400">
                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">Leave empty to keep current photo.</p>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeEditRoomModal()"
                            class="rounded-lg border border-neutral-300 px-4 py-2 text-sm font-medium text-neutral-700 transition-colors hover:bg-neutral-100 dark:border-neutral-600 dark:text-neutral-300 dark:hover:bg-neutral-700">
                        Cancel
                    </button>
                    <button type="submit"
                            class="rounded-xl bg-gradient-to-r from-indigo-600 via-indigo-500 to-blue-600 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-indigo-500/40 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-indigo-500/50">
                        Update Room
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editRoom(id, roomNumber, floor, status, roomTypeId) {
            document.getElementById('editRoomModal').classList.remove('hidden');
            document.getElementById('editRoomModal').classList.add('flex');
            document.getElementById('editRoomForm').action = `/rooms/${id}`;
            document.getElementById('edit_room_number').value = roomNumber;
            document.getElementById('edit_floor').value = floor;
            document.getElementById('edit_status').value = status;
            document.getElementById('edit_room_type_id').value = roomTypeId || '';
        }

        function closeEditRoomModal() {
            document.getElementById('editRoomModal').classList.add('hidden');
            document.getElementById('editRoomModal').classList.remove('flex');
        }
    </script>
</x-layouts.app>
