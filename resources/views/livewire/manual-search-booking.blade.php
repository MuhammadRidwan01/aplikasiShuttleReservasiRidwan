<div class="max-w-lg mx-auto p-6 rounded-xl shadow-lg glass text-white space-y-6">
    <h2 class="text-xl font-bold drop-shadow mb-4">Cari Booking Manual</h2>

    <form wire:submit.prevent="search" class="space-y-4">
        <input type="text" wire:model="input_code"
            class="w-full p-2 rounded-lg bg-white/70 border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-300 text-gray-800 placeholder-gray-500"
            placeholder="Masukkan Kode Booking">

        <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition duration-200 w-full sm:w-auto">
            Cari Booking
        </button>
    </form>

    @if($result)
        <div class="mt-6 space-y-2 border-t border-white/30 pt-4 text-sm sm:text-base">
            <p><strong>Nama Tamu:</strong> {{ $result->guest_name }}</p>
            <p><strong>No Kamar:</strong> {{ $result->room_number }}</p>
            <p><strong>Hotel:</strong> {{ ucfirst(str_replace('_', ' ', $result->hotel)) }}</p>
            <p><strong>Jumlah Penumpang:</strong> {{ $result->passenger_count }}</p>
            <p><strong>No HP:</strong> {{ $result->phone_number }}</p>
            <p><strong>Jadwal:</strong> {{ $result->shuttleSchedule->type }} - {{ $result->shuttleSchedule->time }}</p>

            <div class="mt-4">
                {!! QrCode::size(150)->generate($result->booking_code) !!}
            </div>
        </div>
    @elseif($input_code)
        <div class="mt-4 text-red-100 bg-red-600/70 p-3 rounded-md shadow-sm">
            Booking tidak ditemukan.
        </div>
    @endif
</div>
