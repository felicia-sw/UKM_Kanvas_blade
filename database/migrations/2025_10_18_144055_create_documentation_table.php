<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
 
public function up()
{
    Schema::create('documentations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('event_id')->nullable()->constrained('events')->onDelete('cascade');
        $table->string('title')->nullable();
        
        // Updated columns to match ERD
        $table->string('file_type')->default('image'); // e.g., 'image', 'video'
        $table->text('caption')->nullable();
        $table->string('file_path'); // Renamed from image_path
        
        $table->timestamps();
        $table->softDeletes();
    });
}

 
    public function down()
    {
        Schema::dropIfExists('documentation');
    }
};
