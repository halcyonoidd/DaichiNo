<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up(): void
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        
        // kategori 
        $table->enum('category', [
            'mizu', 
            'daichi', 
            'kaen', 
            'ten', 
            'yomi',
            'danpen',
            'gaen',
            'misc'
        ]);

        $table->text('description')->nullable();
        $table->string('image_path')->nullable();
        $table->boolean('is_available')->default(true);
        $table->timestamps();
    });
}

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};