<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_booking_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('booking_id');
            $table->string('booking_code', 20)->nullable();
            $table->string('booking_name', 200);
            $table->string('booking_email', 100);
            $table->string('booking_contact', 20);
            $table->boolean('booking_veget');
            $table->string('booking_institution', 200);
            $table->integer('booking_price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_booking_details');
    }
}
