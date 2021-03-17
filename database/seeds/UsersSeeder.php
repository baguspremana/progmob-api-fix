<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            User::updateOrcreate([
                'name' => 'Super User', 
                'email' => 'superuser@mail.com',
                'photo_profile' => null,
                'gender' => 1, 
                'contact' => null,
                'role' => 2,
                'password' => bcrypt('superuser'),
                'fcm_token' => null
            ]);
            User::updateOrCreate([
                'name' => 'Member', 
                'email' => 'aguskun150@gmail.com',
                'photo_profile' => null,
                'gender' => 1, 
                'contact' => null,
                'role' => 1,
                'password' => bcrypt('123456'),
                'fcm_token' => null
            ]);
        });
    }
}
