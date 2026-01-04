<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This method is executed when you run the 'php artisan migrate' command.
     */
    public function up(): void
    {
        // The Schema::table method allows us to modify an existing table.
        // We are targeting the 'artworks' table.
        Schema::table('artworks', function (Blueprint $table) {
            // This line adds a new column to the table.
            // - The column is named 'image_public_id'.
            // - It's a string, as the public_id is a string of characters.
            // - 'nullable()' means that existing rows can have this column empty.
            // - 'after('image')' places this new column right after the 'image' column for organization.
            $table->string('image_public_id')->nullable()->after('image_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * This method is executed when you run 'php artisan migrate:rollback'.
     * It's the opposite of the 'up' method.
     */
    public function down(): void
    {
        Schema::table('artworks', function (Blueprint $table) {
            // This line will drop (delete) the 'image_public_id' column if we need to undo the migration.
            $table->dropColumn('image_public_id');
        });
    }
};
