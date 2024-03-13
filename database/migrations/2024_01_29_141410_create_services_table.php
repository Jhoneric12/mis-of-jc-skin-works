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
        Schema::create('services', function (Blueprint $table) {
            $table->id()->startingValue(200000);
            $table->string('service_name')->unique;
            $table->unsignedBigInteger('service_category_id');
            $table->decimal('price', 8,2);
            $table->text('description');
            $table->boolean('status');
            $table->timestamps();

            $table->foreign('service_category_id')->references('category_id')->on('service_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
