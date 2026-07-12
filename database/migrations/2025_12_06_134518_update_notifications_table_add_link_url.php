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
        Schema::table('notifications', function (Blueprint $table) {
            // First, drop the foreign key constraint
            $table->dropForeign(['event_id']);
            // Drop the event_id column
            $table->dropColumn('event_id');
            // Add link_url column
            $table->string('link_url')->nullable()->after('message');
        });

        // Change type from enum to string in a separate statement
        // This allows for more notification types (events, dues, orders, etc.)
        Schema::table('notifications', function (Blueprint $table) {
            $table->string('type')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->dropColumn('link_url');
            $table->foreignId('event_id')->nullable()->constrained('events')->onDelete('cascade');
        });

        // Revert type back to enum (MySQL only; the enum type never existed on other drivers)
        if (Schema::getConnection()->getDriverName() === 'mysql') {
            \DB::statement("ALTER TABLE notifications MODIFY COLUMN type ENUM('registration', 'reminder_1day', 'reminder_today') NOT NULL");
        }
    }
};
