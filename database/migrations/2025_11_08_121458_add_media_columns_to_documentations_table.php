<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('documentations', function (Blueprint $table) {
            // 💡 ADDED: The column to store if it's a photo or video
            $table->string('file_type', 10)->after('title')->default('photo');
            
            // 💡 ADDED: The caption field
            $table->text('caption')->nullable()->after('file_type'); 
            
            // 💡 ADDED: The featured status field
            $table->boolean('is_featured')->default(false)->after('caption'); 

            // 💡 RENAMING: Rename image_path to file_path for consistency
            // You MUST use the renameColumn method if data already exists in the column
            $table->renameColumn('image_path', 'file_path');
        });
    }

    public function down(): void
    {
        Schema::table('documentations', function (Blueprint $table) {
            // Revert Renaming
            $table->renameColumn('file_path', 'image_path');
            
            // Drop the new columns in reverse order
            $table->dropColumn(['file_type', 'caption', 'is_featured']);
        });
    }
};