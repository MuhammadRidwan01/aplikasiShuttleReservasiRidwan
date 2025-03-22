<?php

namespace App\Livewire;

use App\Models\Reservation;
use App\Models\ShuttleSchedule;
use Illuminate\Support\Facades\Cookie;
use Livewire\Component;

class EditBooking extends Component
{
    public $reservation;
    public $guest_name, $room_number, $shuttle_schedule_id, $hotel, $passenger_count, $phone_number;

    public function mount()
    {
        $bookingCode = Cookie::get('booking_code');

        $this->reservation = Reservation::where('booking_code', $bookingCode)->first();

        if (!$this->reservation) {
            abort(404);
        }

        // Pre-fill form
        $this->guest_name = $this->reservation->guest_name;
        $this->room_number = $this->reservation->room_number;
        $this->shuttle_schedule_id = $this->reservation->shuttle_schedule_id;
        $this->hotel = $this->reservation->hotel;
        $this->passenger_count = $this->reservation->passenger_count;
        $this->phone_number = $this->reservation->phone_number;
    }

    public function update()
    {
        $this->validate([
            'guest_name' => 'required',
            'room_number' => 'required',
            'shuttle_schedule_id' => 'required|exists:shuttle_schedules,id',
            'hotel' => 'required',
            'passenger_count' => 'required|integer|min:1|max:10',
            'phone_number' => 'required',
        ]);

        $this->reservation->update([
            'guest_name' => $this->guest_name,
            'room_number' => $this->room_number,
            'shuttle_schedule_id' => $this->shuttle_schedule_id,
            'hotel' => $this->hotel,
            'passenger_count' => $this->passenger_count,
            'phone_number' => $this->phone_number,
        ]);

        session()->flash('success', 'Booking berhasil diperbarui!');
    }

    public function cancel()
    {
        $this->reservation->delete();
        Cookie::queue(Cookie::forget('booking_code'));

        session()->flash('success', 'Booking berhasil dibatalkan!');
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.edit-booking', [
            'schedules' => ShuttleSchedule::all(),
        ]);
    }
}

