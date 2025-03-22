<div class="max-w-xl mx-auto p-6 rounded-xl shadow-lg space-y-6 glass text-gray-800">
    <h2 class="text-2xl font-bold text-white drop-shadow">Edit Booking <br><p class="text-xl font-bold text-white">{{ $reservation->booking_code }}</p></h2>



    @if (session()->has('success'))
        <div class="text-green-100 bg-green-600/70 border border-green-200 p-3 rounded-md shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <form wire:submit.prevent="update" class="space-y-5">
        <div class="space-y-1">
            <label class="block text-sm font-medium text-white">Nama Tamu</label>
            <input wire:model="guest_name" type="text" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200 focus:outline-none p-2 bg-white/70" required>
        </div>

        <div class="space-y-1">
            <label class="block text-sm font-medium text-white">Nomor Kamar</label>
            <input wire:model="room_number" type="text" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200 focus:outline-none p-2 bg-white/70" required>
        </div>

        <div class="space-y-1">
            <label class="block text-sm font-medium text-white">Hotel</label>
            <select wire:model="hotel" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200 focus:outline-none p-2 bg-white/70">
                <option value="">Pilih hotel</option>
                <option value="ibis_styles">ibis Styles</option>
                <option value="ibis_budget">ibis Budget</option>
            </select>
        </div>

        <div class="space-y-1">
            <label class="block text-sm font-medium text-white">Jumlah Penumpang</label>
            <input wire:model="passenger_count" type="number" min="1" max="10" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200 focus:outline-none p-2 bg-white/70" required>
        </div>

        <div class="space-y-1">
            <label class="block text-sm font-medium text-white">Nomor HP</label>
            <input wire:model="phone_number" type="text" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200 focus:outline-none p-2 bg-white/70" required>
        </div>

        <div class="space-y-1">
            <label class="block text-sm font-medium text-white">Jadwal Shuttle</label>
            <select wire:model="shuttle_schedule_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-green-200 focus:outline-none p-2 bg-white/70">
                <option value="">Pilih jadwal</option>
                @foreach($schedules as $schedule)
                    <option value="{{ $schedule->id }}">
                        {{ $schedule->type }} - {{ $schedule->time }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
            <a href="{{ route('booking') }}" class="text-center bg-gray-600 hover:bg-gray-700 text-white font-semibold px-5 py-2.5 rounded-lg transition duration-200 shadow-md">
                Kembali ke Daftar Booking
            </a>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-5 py-2.5 rounded-lg transition duration-200 shadow-md">
                Update Booking
            </button>
            <button type="button" wire:click="cancel"
                onclick="return confirm('Yakin ingin membatalkan booking ini?')"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-5 py-2.5 rounded-lg transition duration-200 shadow-md">
                Batalkan Booking
            </button>
        </div>
    </form>
</div>
