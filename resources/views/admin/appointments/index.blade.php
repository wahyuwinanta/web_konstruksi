<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-indigo-800 leading-tight tracking-wide">
            {{ __('Manage Appointments') }}
        </h2>
    </x-slot>

    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white shadow-md sm:rounded-2xl p-10 border border-gray-100 space-y-6 transition-all duration-300 ease-in-out">

                {{-- Loop Data Appointment --}}
                @forelse ($appointments as $appointment)
                    <div
                        class="item-card flex flex-col md:flex-row justify-between items-start md:items-center bg-gray-50 hover:bg-gray-100 transition rounded-xl p-5 border border-gray-200 shadow-sm hover:-translate-y-1 hover:shadow-lg duration-300 ease-in-out">

                        {{-- Profil / Nama --}}
                        <div class="flex flex-row items-center gap-x-5">
                            <img src="{{ Storage::url($appointment->product->thumbnail) }}" alt="{{ $appointment->name }}"
                                class="rounded-xl object-cover w-[90px] h-[90px] shadow-md border border-gray-200 transition-transform duration-300 hover:scale-105">
                            <div>
                                <h3 class="text-indigo-950 text-xl font-bold leading-tight">
                                    {{ $appointment->name }}
                                </h3>
                                <p class="text-slate-500 text-sm mt-1">
                                    {{ $appointment->product->name ?? 'No product info' }}
                                </p>
                            </div>
                        </div>

                        {{-- Budget --}}
                        <div class="mt-4 md:mt-0 text-sm text-slate-500 flex flex-col items-start md:items-center">
                            <p class="font-medium text-slate-400">Budget</p>
                            <h3 class="text-indigo-950 font-semibold text-base">
                                Rp {{ number_format($appointment->budget, 0, ',', '.') }}
                            </h3>
                        </div>

                        {{-- Date --}}
                        <div class="mt-4 md:mt-0 text-sm text-slate-500 flex flex-col items-start md:items-end">
                            <p class="font-medium text-slate-400">Meeting Date</p>
                            <h3 class="text-indigo-950 font-semibold text-base">
                                {{ $appointment->meeting_at->format('d M Y') }}
                            </h3>
                        </div>

                        {{-- Tombol Details --}}
                        <div class="mt-5 md:mt-0 flex justify-start md:justify-end">
                            <a href="{{ route('admin.appointments.show', $appointment) }}"
                                class="inline-flex items-center px-5 py-2.5 bg-indigo-700 hover:bg-indigo-800 text-white text-sm font-semibold rounded-full shadow-sm transition duration-200 ease-in-out">
                                Details
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-slate-500 italic py-10">Belum ada data terbaru</p>
                @endforelse

                {{-- Pagination --}}
                @if ($appointments->hasPages())
                    <div class="mt-8 flex justify-center">
                        {{ $appointments->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
