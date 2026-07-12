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
        // The create_documentation_table migration was later edited to add
        // softDeletes() itself, so guard for installs where the column
        // already exists.
        if (Schema::hasColumn('documentations', 'deleted_at')) {
            return;
        }

        Schema::table('documentations', function (Blueprint $table) {
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasColumn('documentations', 'deleted_at')) {
            return;
        }

        Schema::table('documentations', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
