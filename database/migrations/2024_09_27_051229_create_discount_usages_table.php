<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('discount_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('booking_id'); // Explicitly set as unsignedBigInteger
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
            $table->foreignId('discount_id')->constrained()->onDelete('cascade');
            $table->dateTime('usage_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('discount_usages');
    }
};
