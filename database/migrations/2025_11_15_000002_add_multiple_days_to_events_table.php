<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->boolean('has_multiple_days')->default(false)->after('max_participants');
            $table->decimal('day_1_price', 10, 2)->nullable()->after('has_multiple_days');
            $table->decimal('day_2_price', 10, 2)->nullable()->after('day_1_price');
            $table->decimal('both_days_price', 10, 2)->nullable()->after('day_2_price');
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['has_multiple_days', 'day_1_price', 'day_2_price', 'both_days_price']);
        });
    }
};
