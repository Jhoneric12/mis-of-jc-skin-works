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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id()->startingValue(434000);
            $table->unsignedBigInteger('service_id')->constrained();
            $table->unsignedBigInteger('specialist_id')->constrained();
            $table->date('date');
            $table->time('time');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('status');
            $table->timestamps();

            $table->foreign('service_id')->references('id')->on('services');

            $table->foreign('specialist_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
