<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HapusKolomTiketBookingVerfication extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('ticket_booking_verifications');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('ticket_booking_verifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id');
            $table->string('verfication');
            $table->text('etc')->nullable();
            $table->timestamps();
        });
    }
}
