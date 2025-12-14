<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('reservation_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->constrained('reservations')->onDelete('cascade');
            $table->string('room')->nullable();
            $table->date('date');
            $table->time('time_start');
            $table->time('time_end');
            $table->unsignedInteger('guests');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->text('special_request')->nullable();
            $table->string('status')->default('booked');
            $table->timestamps();

            $table->index(['room', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservation_bookings');
    }
};
