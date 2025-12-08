<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // $table->string('name');
            // $table->string('nim');
            // $table->string('jurusan');
            // $table->string('asal_universitas');
            // $table->string('nomor_telp');
            // $table->boolean('is_kanvas_member')->default(false);
            // $table->enum('days_attending', ['day_1', 'day_2', 'both'])->nullable();
            $table->string('payment_proof')->nullable();
            $table->enum('payment_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->decimal('amount_paid', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_registrations');
    }
};
