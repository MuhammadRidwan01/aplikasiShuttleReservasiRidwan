<?php

namespace App\Livewire;

use App\Models\Reservation;
use App\Models\ShuttleSchedule;
use Illuminate\Support\Facades\Cookie;
use Livewire\Attributes\On;
use Livewire\Component;
use Stringable;

class BookingForm extends Component
{
    public $guest_name, $room_number, $shuttle_schedule_id, $hotel, $passenger_count, $phone_number;
    public $bookingCode, $reservation;

    public function mount()
    {
        $this->bookingCode = Cookie::get('booking_code');
        if ($this->bookingCode) {
            // Cari berdasarkan kode booking
            $this->reservation = Reservation::where('booking_code', $this->bookingCode)->with('shuttleSchedule')->first();
        }
    }
    public function cancelBooking(){
        $this->reservation->delete();
        $this->reset();
        session()->flash('deleted', 'Reservasi berhasil di hapus! ' . $this->bookingCode);
    }
    public function submit()
    {
        $this->validate([
            'guest_name' => 'required|string|max:255',
            'room_number' => 'required|string|max:50',
            'shuttle_schedule_id' => 'required|exists:shuttle_schedules,id',
            'hotel' => 'required|in:ibis_styles,ibis_budget',
            'passenger_count' => 'required|integer|min:1|max:10',
            'phone_number' => 'nullable|string|max:20',
        ]);

        // Cek total penumpang di jadwal yang dipilih
        $currentTotal = Reservation::where('shuttle_schedule_id', $this->shuttle_schedule_id)->sum('passenger_count');
        $maxPassengers = 30;

        if ($currentTotal + $this->passenger_count > $maxPassengers) {
            $this->addError('passenger_count', 'Jumlah penumpang melebihi kapasitas jadwal.');
            return;
        }

        $reservation = Reservation::create([
            'guest_name' => $this->guest_name,
            'room_number' => $this->room_number,
            'shuttle_schedule_id' => $this->shuttle_schedule_id,
            'hotel' => $this->hotel,
            'passenger_count' => $this->passenger_count,
            'phone_number' => $this->phone_number,
        ]);
        $this->bookingCode = $reservation->booking_code;
        $this->reservation = $reservation;
        Cookie::queue('booking_code', $this->bookingCode, 60 * 24); // Simpan 1 hari

        session()->flash('success', 'Reservasi berhasil! Kode Booking: ' . $this->bookingCode);
        $this->reset(['guest_name', 'room_number', 'shuttle_schedule_id', 'hotel', 'passenger_count', 'phone_number']);

    }

    public function render()
    {
        return view('livewire.booking-form', [
            'schedules' => ShuttleSchedule::all()
                ->groupBy('type')
                ->map(function ($group) {
                    return collect($group)->mapWithKeys(function ($item) {
                        return [$item['id'] => $item['time']];
                    });
                })->toArray()
        ]);

    }
}

