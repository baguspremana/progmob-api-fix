<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhotoColoumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_bookings', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('status');
            $table->text('etc')->nullable()->after('photo');
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
            $table->dropColumn('photo')->nullable();
            $table->dropColumn('etc')->nullable();
        });
    }
}
