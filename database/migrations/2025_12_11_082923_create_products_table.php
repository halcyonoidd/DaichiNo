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
            'sushi_and_sashimi', 
            'ramen_and_noodles', 
            'grilled_specialties', 
            'appetizer', 
            'dessert',
            'drink' 
        ]);

        $table->text('description')->nullable();
        $table->decimal('price', 10, 2);
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