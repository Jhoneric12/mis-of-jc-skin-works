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
            $table->id()->startingValue(100000);
            $table->string('product_name')->unique();
            $table->unsignedBigInteger('product_category_id');
            $table->decimal('price', 8, 2);
            $table->text('description');
            $table->integer('min_qty');
            $table->integer('max_qty');
            $table->integer('total_qty')->default(0);
            $table->boolean('status');
            $table->string('product_image_path')->nullable();
            $table->timestamps();

            $table->foreign('product_category_id')->references('category_id')->on('product_categories');
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
