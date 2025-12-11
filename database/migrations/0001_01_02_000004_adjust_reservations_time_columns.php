<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('reservations')) {
            return;
        }

        Schema::table('reservations', function (Blueprint $table) {
            if (!Schema::hasColumn('reservations', 'time_start')) {
                $table->time('time_start')->nullable()->after('date');
            }
            if (!Schema::hasColumn('reservations', 'time_end')) {
                $table->time('time_end')->nullable()->after('time_start');
            }
            if (Schema::hasColumn('reservations', 'time')) {
                try {
                    $table->dropColumn('time');
                } catch (\Exception $e) {
                    // dropping columns may require doctrine/dbal; skip if it fails
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (!Schema::hasTable('reservations')) {
            return;
        }

        Schema::table('reservations', function (Blueprint $table) {
            if (!Schema::hasColumn('reservations', 'time') && (Schema::hasColumn('reservations', 'time_start') || Schema::hasColumn('reservations', 'time_end'))) {
                $table->time('time')->nullable()->after('date');
            }
            if (Schema::hasColumn('reservations', 'time_start')) {
                try {
                    $table->dropColumn('time_start');
                } catch (\Exception $e) {
                }
            }
            if (Schema::hasColumn('reservations', 'time_end')) {
                try {
                    $table->dropColumn('time_end');
                } catch (\Exception $e) {
                }
            }
        });
    }
};
