<x-layouts.app :title="__('Trash')">
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

        <div class="flex items-center justify-between rounded-2xl border border-slate-200/60 bg-white p-4 shadow-lg dark:border-slate-700/60 dark:bg-slate-800/50">
            <h1 class="text-xl font-bold text-slate-800 dark:text-slate-100">Trash</h1>
            <a href="{{ route('dashboard') }}" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-700">Back to Rooms</a>
        </div>

        <div class="rounded-2xl border border-slate-200/60 bg-white p-4 shadow-lg dark:border-slate-700/60 dark:bg-slate-800/50">
            <form action="{{ route('rooms.trash') }}" method="GET" class="flex flex-col gap-3 md:flex-row md:items-center">
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

                <div class="flex items-center gap-2">
                    <button type="submit" class="rounded-xl bg-gradient-to-r from-indigo-600 via-indigo-500 to-blue-600 px-6 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/40 transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-indigo-500/50">Apply</button>
                    <a href="{{ route('rooms.trash') }}" class="rounded-xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 dark:border-slate-600 dark:text-slate-200 dark:hover:bg-slate-700">Clear</a>
                </div>
            </form>
        </div>

        <div class="overflow-hidden rounded-2xl border border-slate-200/60 bg-white shadow-xl dark:border-slate-700/60 dark:bg-slate-800/50">
            <table class="w-full min-w-full">
                <thead>
                    <tr class="border-b border-slate-200 bg-gradient-to-r from-rose-50 via-amber-50 to-rose-50 dark:border-slate-700 dark:from-rose-900/30 dark:via-amber-900/20 dark:to-rose-900/30">
                        <th class="px-4 py-3 text-left text-sm font-bold text-slate-700 dark:text-slate-200">#</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Room Number</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Floor</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Room Type</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Deleted At</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-neutral-700 dark:text-neutral-300">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200 dark:divide-neutral-700">
                    @forelse($rooms as $room)
                        <tr class="transition-all duration-200 hover:bg-gradient-to-r hover:from-rose-50 hover:via-amber-50 hover:to-transparent dark:hover:from-rose-900/30 dark:hover:via-amber-900/20 dark:hover:to-transparent">
                            <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $loop->iteration }}</td>
                            <td class="px-4 py-3 text-sm text-neutral-900 dark:text-neutral-100">{{ $room->room_number }}</td>
                            <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $room->floor }}</td>
                            <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ ucfirst($room->status) }}</td>
                            <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ $room->roomType?->name ?? 'N/A' }}</td>
                            <td class="px-4 py-3 text-sm text-neutral-600 dark:text-neutral-400">{{ optional($room->deleted_at)->format('M d, Y h:i A') }}</td>
                            <td class="px-4 py-3 text-sm">
                                <form action="{{ route('rooms.restore', $room->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="rounded-lg bg-emerald-100 px-3 py-1.5 text-xs font-semibold text-emerald-700 transition-all duration-200 hover:bg-emerald-200 hover:shadow-md dark:bg-emerald-900/30 dark:text-emerald-200 dark:hover:bg-emerald-900/50">
                                        Restore
                                    </button>
                                </form>

                                <form action="{{ route('rooms.force-delete', $room->id) }}" method="POST" class="inline" onsubmit="return confirm('Permanently delete this room? This cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-2 rounded-lg bg-rose-100 px-3 py-1.5 text-xs font-semibold text-rose-700 transition-all duration-200 hover:bg-rose-200 hover:shadow-md dark:bg-rose-900/30 dark:text-rose-200 dark:hover:bg-rose-900/50">
                                        Delete Forever
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-sm text-neutral-500 dark:text-neutral-400">
                                Trash is empty.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>

