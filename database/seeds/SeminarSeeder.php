<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Seminar;

class SeminarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            Seminar::updateOrcreate([
                'seminar_name' => 'Seminar Teknologi Informasi',
                'seminar_theme' => 'Server Management',
                'seminar_description' => 'Network and Server Management Topic',
                'seminar_schedule' => '2018-03-01 09:00:00',
                'seminar_location' => 'Denpasar',
                'ticket_available' => 100
            ]);
        });
    }
}
