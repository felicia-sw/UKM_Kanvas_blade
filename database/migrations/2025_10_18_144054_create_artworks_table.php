<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  
    public function up()
{
    Schema::create('artworks', function (Blueprint $table) {
        $table->id();
        // Link to User (The Uploader)
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
        
        $table->foreignId('category_id')->nullable()->constrained('artwork_categories')->onDelete('set null');
        $table->string('title');
        $table->text('description')->nullable();
        $table->string('image_path');
        $table->string('artist_name')->nullable(); // Made nullable just in case
        $table->date('created_date')->nullable();
        $table->softDeletes(); // <--- ADDED THIS (Matches ERD)
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('artworks');
    }
};
