<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-800 leading-tight tracking-wide">
            {{ __('Manage Users') }}
        </h2>
    </x-slot>

    {{-- Tombol Add New User --}}
    <div class="max-w-7xl mx-auto mt-6 sm:px-6 lg:px-8 flex justify-end">
        <a href="{{ route('admin.users.create') }}"
            class="inline-flex items-center px-6 py-3 bg-indigo-700 hover:bg-indigo-800 text-white text-sm font-semibold rounded-full shadow-md transition duration-200 ease-in-out">
            Add New User
        </a>
    </div>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white shadow-md sm:rounded-2xl p-10 border border-gray-100 space-y-6 transition-all duration-300 ease-in-out">
                <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6
           bg-gray-50 border border-gray-200 rounded-2xl p-4 shadow-sm">

                    {{-- Search --}}
                    <div class="flex-1">
                        <x-search-bar action="{{ route('admin.users.index') }}" />
                    </div>

                    {{-- Sort --}}
                    <form method="GET" action="{{ route('admin.users.index') }}"
                        class="flex items-center gap-2 bg-white border border-gray-300 rounded-xl px-3 py-2 shadow-sm">

                        @if (request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <span class="text-xs text-gray-500 font-medium whitespace-nowrap">
                            Sort by
                        </span>

                        <select name="sort" onchange="this.form.submit()"
                            class="border-none focus:ring-0 text-sm font-semibold text-indigo-700 bg-transparent pr-6">
                            <option value="">Default</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Name (A–Z)
                            </option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Name (Z–A)
                            </option>
                            <option value="date_desc" {{ request('sort') == 'date_desc' ? 'selected' : '' }}>Newest
                            </option>
                            <option value="date_asc" {{ request('sort') == 'date_asc' ? 'selected' : '' }}>Oldest
                            </option>
                        </select>
                    </form>
                </div>


                {{-- Loop Data Users --}}
                @forelse ($users as $user)
                    <div
                        class="item-card flex flex-col md:flex-row justify-between items-start md:items-center bg-gray-50 hover:bg-gray-100 transition rounded-xl p-5 border border-gray-200 shadow-sm hover:-translate-y-1 hover:shadow-lg duration-300 ease-in-out">

                        {{-- Info User --}}
                        <div class="flex flex-row items-center gap-x-5">
                            <div
                                class="w-[90px] h-[90px] bg-indigo-100 rounded-xl flex items-center justify-center text-indigo-700 font-bold text-xl">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="text-indigo-950 text-xl font-bold leading-tight">
                                    {{ $user->name }}
                                </h3>
                                <p class="text-slate-500 text-sm mt-1">
                                    {{ $user->email }}
                                </p>
                                <p class="text-sm mt-1">
                                    Role: <span
                                        class="font-medium text-indigo-700">{{ ucfirst($user->getRoleNames()->first() ?? '-') }}</span>
                                </p>
                            </div>
                        </div>

                        {{-- Tanggal Pembuatan --}}
                        <div class="mt-4 md:mt-0 text-sm text-slate-500 flex flex-col items-start md:items-end">
                            <p class="font-medium text-slate-400">Created at</p>
                            <h3 class="text-indigo-950 font-semibold">
                                {{ $user->created_at->format('d M Y') }}
                            </h3>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-5 md:mt-0 flex flex-row gap-x-3">
                            <a href="{{ route('admin.users.edit', $user) }}"
                                class="inline-flex items-center px-5 py-2.5 bg-indigo-700 hover:bg-indigo-800 text-white text-sm font-semibold rounded-full shadow-sm transition duration-200 ease-in-out">
                                Edit
                            </a>
                            <form action="{{ route('admin.users.toggle', $user) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to change this user status?');">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                    class="inline-flex items-center px-5 py-2.5 
                                    {{ $user->is_active ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }} 
                                    text-white text-sm font-semibold rounded-full shadow-sm transition duration-200 ease-in-out">
                                    {{ $user->is_active ? 'Activate' : 'Deactivate' }}
                                </button>
                            </form>


                        </div>
                    </div>
                @empty
                    <p class="text-center text-slate-500 italic py-10">Belum ada data user</p>
                @endforelse

            </div>

            {{-- Pagination --}}
            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
