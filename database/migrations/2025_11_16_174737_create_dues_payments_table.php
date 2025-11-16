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
        Schema::create('dues_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Member making payment
            $table->foreignId('dues_period_id')->constrained('dues_periods')->onDelete('cascade'); // Which period this payment is for
            $table->enum('payment_status', ['pending', 'verified'])->default('pending'); // Payment status
            $table->string('payment_proof')->nullable(); // Path to uploaded payment proof file
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null'); // Admin who verified
            $table->timestamp('verified_at')->nullable(); // When it was verified
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dues_payments');
    }
};
