<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up()
{
    Schema::create('events', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->string('poster_image')->nullable();
        $table->dateTime('start_date');
        $table->dateTime('end_date')->nullable();
        $table->dateTime('registration_deadline')->nullable(); // Changed to dateTime
        $table->decimal('price', 10, 2)->default(0);
        $table->string('location')->nullable();
        $table->boolean('is_active')->default(true);
        $table->softDeletes(); // <--- ADDED THIS (Matches ERD)
        $table->timestamps();
    });
}

   
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
