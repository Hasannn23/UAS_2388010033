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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category'); // e.g. Slim Fit, Skinny, Straight, Jacket
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->string('size'); // e.g. "28", "30", "32", "34", "M", "L"
            $table->text('description')->nullable();
            $table->string('wash_type')->nullable(); // e.g. Acid Wash, Stone Wash, Raw Denim
            $table->string('image_url')->nullable(); // For product image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
