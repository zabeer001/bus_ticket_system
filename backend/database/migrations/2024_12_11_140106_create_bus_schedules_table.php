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
        Schema::create('bus_schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bus_id')->constrained('buses')->onDelete('cascade'); // Reference to the buses table
            $table->string('start_from'); // Starting location
            $table->date('date'); // Date of the schedule
            $table->time('time'); // Time of the schedule
            $table->integer('total_tickets'); // Total tickets available for this schedule
            $table->integer('ticket_sold')->default(0); // Tickets sold so far
            $table->integer('remaining_tickets'); // Remaining tickets
            $table->decimal('price', 8, 2); // 8 digits in total, 2 after the decimal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_schedules');
    }
};
