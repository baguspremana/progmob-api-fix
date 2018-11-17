<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQrcodePhoto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_booking_details', function (Blueprint $table) {
            $table->string('qrcode_photo')->nullable()->after('booking_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_booking_details', function (Blueprint $table) {
            $table->dropColumn('qrcode_photo')->nullable()->after('booking_code');
        });
    }
}
