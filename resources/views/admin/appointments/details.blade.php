<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Details Booking') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-2xl p-10 flex flex-col gap-y-8">

                <!-- Bagian Produk -->
                <div class="flex flex-row items-center gap-x-6 border-b border-gray-100 pb-6">
                    <img src="{{ Storage::url($appointment->product->thumbnail) }}" alt="Thumbnail"
                        class="rounded-2xl object-cover w-[140px] h-[100px] shadow-sm">
                    <div>
                        <p class="text-slate-500 text-sm mb-1">Product Interest</p>
                        <h3 class="text-indigo-950 text-2xl font-bold">{{ $appointment->product->name }}</h3>
                    </div>
                </div>

                <!-- Detail Informasi -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="flex flex-col gap-y-4">
                        <div>
                            <p class="text-slate-500 text-sm">Name</p>
                            <h3 class="text-indigo-950 text-lg font-semibold">
                                {{ $appointment->name }}
                            </h3>
                        </div>
                        <div>
                            <p class="text-slate-500 text-sm">Email</p>
                            <h3 class="text-indigo-950 text-lg font-semibold">
                                {{ $appointment->email }}
                            </h3>
                        </div>
                        <div>
                            <p class="text-slate-500 text-sm">Phone</p>
                            <h3 class="text-indigo-950 text-lg font-semibold">
                                {{ $appointment->phone_number }}
                            </h3>
                        </div>
                    </div>

                    <div class="flex flex-col gap-y-4">
                        <div>
                            <p class="text-slate-500 text-sm">Brief</p>
                            <h3 class="text-indigo-950 text-lg font-semibold">
                                {{ $appointment->brief }}
                            </h3>
                        </div>
                        <div>
                            <p class="text-slate-500 text-sm">Budget</p>
                            <h3 class="text-indigo-950 text-lg font-semibold">
                                Rp {{ number_format($appointment->budget, 0, ',', '.') }}
                            </h3>
                        </div>
                        <div>
                            <p class="text-slate-500 text-sm">Meeting Date At</p>
                            <h3 class="text-indigo-950 text-lg font-semibold">
                                {{ $appointment->meeting_at->format('M d, Y') }}
                            </h3>
                        </div>
                    </div>
                </div>

                <!-- Tombol Aksi -->
                <div class="pt-4 border-t border-gray-100 flex justify-center">
                    <a href="#"
                        class="font-bold py-4 px-8 bg-indigo-700 text-white rounded-full shadow hover:bg-indigo-800 hover:scale-105 transition-all duration-200 ease-in-out">
                        Follow Up Customer
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
