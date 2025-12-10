<form method="GET" {{ $attributes->merge(['class' => 'mb-4']) }}>
    <div class="flex items-center gap-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari data..."
            class="w-full md:w-100 px-3 py-2 border border-gray-300 rounded-lg 
                   bg-gray-50 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 
                   transition text-sm">

        <button type="submit"
            class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg 
                   hover:bg-indigo-700 active:scale-95 transition">
            Cari
        </button>
    </div>
</form>
