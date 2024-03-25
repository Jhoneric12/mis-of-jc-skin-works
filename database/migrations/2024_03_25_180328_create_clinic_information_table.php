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
        Schema::create('clinic_information', function (Blueprint $table) {
            $table->id();
            $table->text('clinic_description');
            $table->string('weekly_sched');
            $table->string('time_sched');
            $table->string('email');
            $table->string('contact_number');
            $table->text('facebook');
            $table->text('twitter');
            $table->text('home_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clinic_information');
    }
};
