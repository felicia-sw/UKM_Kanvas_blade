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
        Schema::create('dues_periods', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Kas November 2025"
            $table->decimal('amount', 15, 2); // Amount to pay for this period
            $table->date('due_date'); // When the payment is due
            $table->text('description')->nullable(); // Optional description
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dues_periods');
    }
};
