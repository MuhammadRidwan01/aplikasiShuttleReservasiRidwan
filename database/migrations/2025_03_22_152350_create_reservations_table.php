<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        $table->string('guest_name');
        $table->string('room_number');
        $table->unsignedInteger('passenger_count');
        $table->foreignId('shuttle_schedule_id')->constrained()->onDelete('cascade');
        $table->string('phone_number')->nullable();
        $table->string('booking_code');
        $table->enum('hotel', ['ibis_styles', 'ibis_budget']);
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
