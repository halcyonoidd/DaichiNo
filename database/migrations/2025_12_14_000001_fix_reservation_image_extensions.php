<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update all .jpg extensions to .png for restaurantInterior images
        DB::table('reservations')
            ->where('image_path', 'like', '%restaurantInterior.jpg%')
            ->update(['image_path' => DB::raw("REPLACE(image_path, '.jpg', '.png')")]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to .jpg
        DB::table('reservations')
            ->where('image_path', 'like', '%restaurantInterior.png%')
            ->update(['image_path' => DB::raw("REPLACE(image_path, '.png', '.jpg')")]);
    }
};
