<!-- PENTING: Satu elemen div pembungkus di luar sebagai root element -->
<div x-data="{ activeTab: 'book' }" class="max-w-3xl mx-auto">
    <!-- App Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-white mb-2 drop-shadow-lg">Ibis Shuttle Booking</h1>
        <p class="text-white/80 drop-shadow">Layanan shuttle Jakarta Airport to Soekarno Hatta</p>
        <div class="mt-3 inline-block glass-light px-3 py-1 rounded-full text-green-800 text-sm">
            <span class="animate-pulse mr-1">●</span> Alpha Test 1.0
        </div>
    </div>

    <!-- Tabs -->
    <div class="glass mb-6 rounded-xl overflow-hidden">
        <div class="flex text-white">
            <button @click="activeTab = 'book'" :class="{ 'bg-green-600/50': activeTab === 'book' }"
                class="flex-1 py-3 text-center font-medium transition">
                Buat Booking
            </button>
            <button @click="activeTab = 'check'" :class="{ 'bg-green-600/50': activeTab === 'check' }"
                class="flex-1 py-3 text-center font-medium transition">
                Booking Anda
            </button>
        </div>
    </div>

    <!-- Content Container -->
    <div class="glass rounded-2xl p-1">
        <div class="glass-light rounded-xl p-6 shadow-lg">
            <!-- Success Alert -->
            @if (session()->has('success'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                    class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-md flex justify-between items-center">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button @click="show = false" class="text-green-700 hover:text-green-900">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @endif
            <!-- Success Alert -->
            @if (session()->has('deleted'))
                <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)"
                    class="mb-6 bg-red-100 border-l-4 border-red-500 text-green-700 p-4 rounded shadow-md flex justify-between items-center">
                    <div class="flex items-center">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        <span>{{ session('deleted') }}</span>
                    </div>
                    <button @click="show = false" class="text-green-700 hover:text-green-900">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Booking Form -->
            <div x-show="activeTab === 'book'">
                <h2 class="text-xl font-semibold mb-6 text-green-800">Formulir Reservasi Shuttle</h2>

                <form wire:submit.prevent="submit" class="space-y-4">
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-green-800">Nama Tamu</label>
                        <input type="text" wire:model.defer="guest_name" placeholder="Masukkan nama lengkap"
                            class="w-full border border-gray-200 bg-white/80 p-3 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition outline-none" />
                        @error('guest_name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-green-800">Nomor Kamar</label>
                            <input type="text" wire:model.defer="room_number" placeholder="Contoh: 101"
                                class="w-full border border-gray-200 bg-white/80 p-3 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition outline-none" />
                            @error('room_number')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-green-800">Jumlah Penumpang</label>
                            <input type="number" wire:model.defer="passenger_count" placeholder="Jumlah orang"
                                class="w-full border border-gray-200 bg-white/80 p-3 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition outline-none" />
                            @error('passenger_count')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-green-800">Hotel</label>
                        <select wire:model.defer="hotel"
                            class="w-full border border-gray-200 bg-white/80 p-3 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition outline-none">
                            <option value="">-- Pilih Hotel --</option>
                            <option value="ibis_styles">Ibis Styles</option>
                            <option value="ibis_budget">Ibis Budget</option>
                        </select>
                        @error('hotel')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-green-800">Jadwal Shuttle</label>
                        <select wire:model.defer="shuttle_schedule_id"
                            class="w-full border border-gray-200 bg-white/80 p-3 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition outline-none">
                            <option value="">-- Pilih Jadwal Shuttle --</option>
                            @foreach ($schedules as $type => $items)
                                <optgroup label="{{ ucfirst(str_replace('_', ' ', $type)) }}">
                                    @foreach ($items as $id => $time)
                                        <option value="{{ $id }}">
                                            {{ \Carbon\Carbon::parse($time)->format('H:i') }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        @error('shuttle_schedule_id')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-green-800">No HP (Opsional)</label>
                        <input type="text" wire:model.defer="phone_number" placeholder="Contoh: 08123456789"
                            class="w-full border border-gray-200 bg-white/80 p-3 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition outline-none" />
                        @error('phone_number')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg transition shadow-lg flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Submit Reservasi
                        </button>
                    </div>
                </form>
            </div>

            <!-- Check Booking -->
            <div x-show="activeTab === 'check'" x-cloak>
                <h2 class="text-xl font-semibold mb-6 text-green-800">Cek Booking Anda</h2>

                @if ($reservation)
                    <div class="glass p-6 rounded-lg space-y-6">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border-b border-green-200/50 pb-2">
                            <div>
                                <span class="text-sm text-green-700">Kode Booking</span>
                                <p class="text-xl font-bold text-green-900">{{ $reservation->booking_code }}</p>
                            </div>
                            <div class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium mt-2 sm:mt-0">
                                Aktif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <span class="text-sm text-green-700">Nama Tamu</span>
                                <p class="font-semibold text-green-900">{{ $reservation->guest_name }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-green-700">Hotel</span>
                                <p class="font-semibold text-green-900">
                                    {{ ucfirst(str_replace('_', ' ', $reservation->hotel)) }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-green-700">Nomor Kamar</span>
                                <p class="font-semibold text-green-900">{{ $reservation->room_number }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-green-700">Jumlah Penumpang</span>
                                <p class="font-semibold text-green-900">{{ $reservation->passenger_count }} orang</p>
                            </div>
                            <div class="sm:col-span-2">
                                <span class="text-sm text-green-700">Jadwal Shuttle</span>
                                <p class="font-semibold text-green-900">
                                    {{ optional($reservation->shuttleSchedule)->type }} -
                                    {{ \Carbon\Carbon::parse(optional($reservation->shuttleSchedule)->time)->format('H:i') }}
                                </p>
                            </div>
                        </div>

                        <div class="pt-4">
                            <span class="text-sm text-green-700">QR Code Booking</span>
                            <div class="flex items-center justify-center sm:justify-start mt-2">
                                {!! QrCode::size(150)->generate($reservation->booking_code) !!}
                            </div>
                        </div>

                        <div class="pt-4 flex flex-col sm:flex-row gap-3 sm:space-x-3">
                            <a href="{{ route('edit-booking') }}"
                                class="w-full sm:flex-1 bg-white border border-green-500 hover:bg-green-50 text-green-700 font-medium py-2 px-4 rounded-lg transition shadow flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit Booking
                            </a>
                            <button x-data=""
                                x-on:click.prevent="$dispatch('open-modal', 'cancel-confirmation')"
                                class="w-full sm:flex-1 bg-red-50 hover:bg-red-100 text-red-600 font-medium py-2 px-4 rounded-lg transition shadow flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Batalkan
                            </button>
                        </div>
                    </div>                @else
                    <div class="glass p-8 rounded-lg text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-red-500 font-medium mb-2">Tidak ditemukan data booking berdasarkan kode
                            booking di cookie Anda.</div>
                        <p class="text-gray-600 mb-4">Silakan buat booking baru atau periksa kembali kode booking Anda.
                        </p>
                        <button @click="activeTab = 'book'"
                            class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-lg transition shadow">
                            Buat Booking Baru
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="glass rounded-2xl p-1 max-w-5xl mx-auto mt-3">
        <div class="glass-light rounded-xl p-6 shadow-lg space-y-8">
            <h2 class="text-2xl font-bold text-green-800 text-center">🚌 Jadwal Keberangkatan Bus</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach ($schedules as $type => $items)
                    <div class="bg-white/80 border border-green-100 rounded-xl shadow-sm p-4 backdrop-blur-md">
                        <h3 class="text-lg font-semibold text-green-700 mb-4 border-b border-green-200 pb-2">
                            {{ strtoupper(str_replace('_', ' ', $type)) }}
                        </h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach ($items as $id => $time)
                                <div
                                    class="bg-green-50 border border-green-200 text-green-800 text-sm rounded-lg px-3 py-2 flex items-center gap-2 shadow-sm hover:bg-green-100 transition">
                                    ⏰ {{ \Carbon\Carbon::parse($time)->format('H:i') }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Info Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">
        <div class="glass rounded-xl p-5 text-white">
            <div class="flex items-center mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="font-medium">Pick up Time: </h3>
            </div>
            <table>
                <tr>
                    <td>lorem 1</td>
                    <td>Arival</td>
                    <td>+- 15 - 20 min.</td>
                </tr>
                <tr>
                    <td>lorem 2</td>
                    <td>Arival</td>
                    <td>+- 15 - 20 min.</td>
                </tr>
                <tr>
                    <td>lorem 3</td>
                    <td>Arival</td>
                    <td>+- 15 - 20 min.</td>
                </tr>
            </table>
        </div>

        <div class="glass rounded-xl p-5 text-white">
            <div class="flex items-center mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <h3 class="font-medium">Booking Shuttle</h3>
            </div>
            <p class="text-white/80 text-sm">Reservasi bisa dilakukan minimal 30 menit sebelum keberangkatan</p>
        </div>

        <div class="glass rounded-xl p-5 text-white">
            <div class="flex items-center mb-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
                <h3 class="font-medium">Bantuan</h3>
            </div>
            <p class="text-white/80 text-sm">Hubungi resepsionis hotel untuk informasi dan bantuan lebih lanjut</p>
        </div>
    </div>

    <!-- Modal for cancellation -->
    <div x-data="{ isOpen: false }" x-show="isOpen"
        @open-modal.window="if ($event.detail === 'cancel-confirmation') isOpen = true"
        @keydown.escape.window="isOpen = false" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50" x-cloak>
        <div @click.away="isOpen = false" x-show="isOpen" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90" class="glass-light max-w-md w-full p-6 rounded-xl shadow-xl">
            <div class="text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-red-500 mb-4" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>

                <h3 class="text-xl font-bold text-gray-900 mb-2">Batalkan Booking?</h3>
                <p class="text-gray-600 mb-6">Apakah Anda yakin ingin membatalkan booking ini? Tindakan ini tidak dapat
                    dibatalkan.</p>

                <div class="flex space-x-3">
                    <button @click="isOpen = false"
                        class="flex-1 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-medium py-2 px-4 rounded-lg">
                        Batal
                    </button>
                    <button @click="isOpen = false" wire:click="cancelBooking"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-4 rounded-lg">
                        Ya, Batalkan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
