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
    Schema::create('role_user', function (Blueprint $table) {
        // This is a Pivot Table, so we need two Foreign Keys
        $table->id();
        
        // Link to Users table
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        // Link to Roles table <--- YOU WERE LIKELY MISSING THIS OR HAD A TYPO
        $table->foreignId('role_id')->constrained()->onDelete('cascade');
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
