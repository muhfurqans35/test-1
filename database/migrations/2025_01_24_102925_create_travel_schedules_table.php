<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('travel_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('destination');
            $table->date('departure_date');
            $table->time('departure_time');
            $table->integer('quota');
            $table->decimal('ticket_price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('travel_schedules');
    }
};
