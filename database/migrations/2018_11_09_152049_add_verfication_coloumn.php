<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVerficationColoumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_bookings', function (Blueprint $table) {
            $table->string('verfication')->nullable();
            $table->text('etc')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_bookings', function (Blueprint $table) {
            $table->dropColumn('verfication')->nullable();
            $table->dropColumn('etc')->nullable();
        });
    }
}
