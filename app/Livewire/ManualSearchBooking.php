<?php

namespace App\Livewire;

use App\Models\Reservation;
use Livewire\Component;

class ManualSearchBooking extends Component
{
    public $input_code;
    public $result;

    public function search()
    {
        $this->validate([
            'input_code' => 'required',
        ]);

        $this->result = Reservation::where('booking_code', $this->input_code)->first();
    }

    public function render()
    {
        return view('livewire.manual-search-booking');
    }
}

