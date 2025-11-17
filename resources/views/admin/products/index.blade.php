<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-800 leading-tight tracking-wide">
            {{ __('Manage Products') }}
        </h2>
    </x-slot>

    {{-- Tombol Add New di bawah header --}}
    <div class="max-w-7xl mx-auto mt-6 sm:px-6 lg:px-8 flex justify-end">
        <a href="{{ route('admin.products.create') }}"
            class="inline-flex items-center px-6 py-3 bg-indigo-700 hover:bg-indigo-800 text-white text-sm font-semibold rounded-full shadow-md transition duration-200 ease-in-out">
            Add New
        </a>
    </div>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white shadow-md sm:rounded-2xl p-10 border border-gray-100 space-y-6 transition-all duration-300 ease-in-out">

                {{-- Loop Data Products --}}
                @forelse ($products as $product)
                    <div
                        class="item-card flex flex-col md:flex-row justify-between items-start md:items-center bg-gray-50 hover:bg-gray-100 transition rounded-xl p-5 border border-gray-200 shadow-sm hover:-translate-y-1 hover:shadow-lg duration-300 ease-in-out">

                        {{-- Gambar dan Informasi Produk --}}
                        <div class="flex flex-row items-center gap-x-5">
                            <img src="{{ Storage::url($product->thumbnail) }}" alt="{{ $product->name }}"
                                class="rounded-xl object-cover w-[90px] h-[90px] shadow-md border border-gray-200 transition-transform duration-300 hover:scale-105">
                            <div>
                                <h3 class="text-indigo-950 text-xl font-bold leading-tight">
                                    {{ $product->name }}
                                </h3>
                                @if ($product->description)
                                    <p class="text-slate-500 text-sm mt-1">
                                        {{ Str::limit($product->description, 60) }}
                                    </p>
                                @endif
                            </div>
                        </div>

                        {{-- Tanggal Pembuatan --}}
                        <div class="mt-4 md:mt-0 text-sm text-slate-500 flex flex-col items-start md:items-end">
                            <p class="font-medium text-slate-400">Created at</p>
                            <h3 class="text-indigo-950 font-semibold">
                                {{ $product->created_at->format('d M Y') }}
                            </h3>
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="mt-5 md:mt-0 flex flex-row gap-x-3">
                            <a href="{{ route('admin.products.edit', $product) }}"
                                class="inline-flex items-center px-5 py-2.5 bg-indigo-700 hover:bg-indigo-800 text-white text-sm font-semibold rounded-full shadow-sm transition duration-200 ease-in-out">
                                Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="inline-flex items-center px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded-full shadow-sm transition duration-200 ease-in-out">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-slate-500 italic py-10">Belum ada data terbaru</p>
                @endforelse

            </div>
        </div>
    </div>
</x-app-layout>
