<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('log_verifikasis', function (Blueprint $table) {
            $table->integer('user_id')->after('booking_detail_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('log_verifikasis', function (Blueprint $table) {
            $table->dropColumn('user_id')->after('booking_detail_id');
        });
    }
}
