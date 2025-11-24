<x-layouts.app :title="__('Room Types')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

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

        <div class="relative h-full flex-1 overflow-hidden rounded-2xl border border-slate-200/60 bg-white shadow-xl dark:border-slate-700/60 dark:bg-slate-800/50 backdrop-blur-sm">
            <div class="flex h-full flex-col p-6">

                <div class="mb-6 rounded-xl border border-slate-200/60 bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/20 p-6 shadow-lg dark:border-slate-700/60 dark:from-slate-900/80 dark:via-slate-800/60 dark:to-slate-900/40">
                    <h2 class="mb-4 text-2xl font-bold bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent dark:from-indigo-400 dark:to-blue-400">Add New Room Type</h2>

                    <form action="{{ route('room-types.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       placeholder="Enter room type name" required
                                       class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm transition-all duration-200 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:shadow-md dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-400">
                                @error('name')
                                    <p class="mt-1 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Price Per Night</label>
                                <input type="number" name="price_per_night" value="{{ old('price_per_night') }}" step="0.01" min="0"
                                       placeholder="Enter price per night" required
                                       class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm transition-all duration-200 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:shadow-md dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-400">
                                @error('price_per_night')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Max Occupancy</label>
                                <input type="number" name="max_occupancy" value="{{ old('max_occupancy') }}" min="1"
                                       placeholder="Enter max occupancy" required
                                       class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm transition-all duration-200 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:shadow-md dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-400">
                                @error('max_occupancy')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label class="mb-2 block text-sm font-semibold text-slate-700 dark:text-slate-200">Description</label>
                                <textarea name="description" rows="3" placeholder="Enter room type description"
                                          class="w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm transition-all duration-200 focus:border-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 focus:shadow-md dark:border-slate-600 dark:bg-slate-800 dark:text-slate-100 dark:focus:border-indigo-400">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="rounded-xl bg-gradient-to-r from-indigo-600 via-indigo-500 to-blue-600 px-8 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/40 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-indigo-500/50 focus:outline-none focus:ring-2 focus:ring-indigo-500/30">
                                Add Room Type
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Room Type List Table -->
                <div class="flex-1 overflow-auto">
                    <h2 class="mb-4 text-xl font-bold text-neutral-900 dark:text-neutral-100">Room Type List</h2>
                    <div class="overflow-x-auto rounded-xl border border-neutral-200 dark:border-neutral-700">
                        <table class="w-full min-w-full">
                            <thead>
                                <tr class="border-b border-slate-200 bg-gradient-to-r from-indigo-50 via-blue-50 to-slate-50 dark:border-slate-700 dark:from-slate-800/80 dark:via-indigo-900/20 dark:to-slate-800/60">
                                    <th class="px-4 py-3 text-left text-sm font-bold text-slate-700 dark:text-slate-200">#</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Name</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Description</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Price Per Night</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Max Occupancy</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Rooms</th>
                                    <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                                @forelse($roomTypes as $roomType)
                                    <tr class="transition-all duration-200 hover:bg-gradient-to-r hover:from-indigo-50 hover:via-blue-50 hover:to-transparent dark:hover:from-indigo-900/30 dark:hover:via-blue-900/20 dark:hover:to-transparent">
                                        <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-900 dark:text-neutral-100">{{ $roomType->name }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">
                                            {{ Str::limit($roomType->description, 50) ?? 'N/A' }}
                                        </td>
                                        <td class="px-4 py-3 text-sm font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent">
                                            ₱{{ number_format($roomType->price_per_night, 2) }}
                                        </td>
                                        <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $roomType->max_occupancy }}</td>
                                        <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">
                                            <span class="inline-flex items-center rounded-full bg-gradient-to-r from-indigo-500 to-blue-600 px-3 py-1 text-xs font-bold text-white shadow-md">
                                                {{ $roomType->rooms_count }} {{ Str::plural('room', $roomType->rooms_count) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-sm">
                                            <button onclick="editRoomType({{ $roomType->id }}, '{{ addslashes($roomType->name) }}', '{{ addslashes($roomType->description ?? '') }}', {{ $roomType->price_per_night }}, {{ $roomType->max_occupancy }})"
                                                    class="rounded-lg bg-indigo-100 px-3 py-1.5 text-xs font-semibold text-indigo-700 transition-all duration-200 hover:bg-indigo-200 hover:shadow-md dark:bg-indigo-900/30 dark:text-indigo-300 dark:hover:bg-indigo-900/50">
                                                Edit
                                            </button>
                                            <span class="mx-2 text-slate-300">|</span>
                                            <form action="{{ route('room-types.destroy', $roomType) }}" method="POST" class="inline"
                                                  onsubmit="return confirm('Are you sure? This will unassign all rooms from this room type.')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-lg bg-rose-100 px-3 py-1.5 text-xs font-semibold text-rose-700 transition-all duration-200 hover:bg-rose-200 hover:shadow-md dark:bg-rose-900/30 dark:text-rose-300 dark:hover:bg-rose-900/50">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-8 text-center text-sm text-neutral-500 dark:text-neutral-400">
                                            No room types found. Add your first room type above!
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

    <!-- Edit Room Type Modal -->
    <div id="editRoomTypeModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/70 backdrop-blur-md">
        <div class="w-full max-w-2xl rounded-2xl border border-slate-200/60 bg-white p-8 shadow-2xl dark:border-slate-700/60 dark:bg-slate-800/95 backdrop-blur-xl">
            <h2 class="mb-4 text-lg font-semibold text-neutral-900 dark:text-neutral-100">Edit Room Type</h2>

            <form id="editRoomTypeForm" method="POST">
                @csrf
                @method('PUT')

                <div class="grid gap-4 md:grid-cols-2">
                    <div>
                        <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Name</label>
                        <input type="text" id="edit_name" name="name" required
                               class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Price Per Night</label>
                        <input type="number" id="edit_price_per_night" name="price_per_night" step="0.01" min="0" required
                               class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                    </div>

                    <div>
                        <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Max Occupancy</label>
                        <input type="number" id="edit_max_occupancy" name="max_occupancy" min="1" required
                               class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100">
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-2 block text-sm font-medium text-neutral-700 dark:text-neutral-300">Description</label>
                        <textarea id="edit_description" name="description" rows="3"
                                  class="w-full rounded-lg border border-neutral-300 bg-white px-4 py-2 text-sm focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-neutral-600 dark:bg-neutral-800 dark:text-neutral-100"></textarea>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="closeEditRoomTypeModal()"
                            class="rounded-lg border border-neutral-300 px-4 py-2 text-sm font-medium text-neutral-700 transition-colors hover:bg-neutral-100 dark:border-neutral-600 dark:text-neutral-300 dark:hover:bg-neutral-700">
                        Cancel
                    </button>
                    <button type="submit"
                            class="rounded-xl bg-gradient-to-r from-indigo-600 via-indigo-500 to-blue-600 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-indigo-500/40 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-indigo-500/50">
                        Update Room Type
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function editRoomType(id, name, description, pricePerNight, maxOccupancy) {
            document.getElementById('editRoomTypeModal').classList.remove('hidden');
            document.getElementById('editRoomTypeModal').classList.add('flex');
            document.getElementById('editRoomTypeForm').action = `/room-types/${id}`;
            document.getElementById('edit_name').value = name;
            document.getElementById('edit_description').value = description || '';
            document.getElementById('edit_price_per_night').value = pricePerNight;
            document.getElementById('edit_max_occupancy').value = maxOccupancy;
        }

        function closeEditRoomTypeModal() {
            document.getElementById('editRoomTypeModal').classList.add('hidden');
            document.getElementById('editRoomTypeModal').classList.remove('flex');
        }
    </script>
</x-layouts.app>


