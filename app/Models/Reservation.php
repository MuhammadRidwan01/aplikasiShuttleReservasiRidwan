<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'guest_name',
        'room_number',
        'passenger_count',
        'shuttle_schedule_id',
        'phone_number',
        'hotel',
        'booking_code'
    ];

    protected static function booted()
    {
        static::creating(function ($reservation) {
            if (!$reservation->booking_code) {
                $reservation->booking_code = 'BOOK-' . strtoupper($reservation->hotel) . '-' . strtoupper(substr(uuid_create(), 0, 8));
            }
        });
    }
    public function shuttleSchedule()
{
    return $this->belongsTo(ShuttleSchedule::class);
}

}
