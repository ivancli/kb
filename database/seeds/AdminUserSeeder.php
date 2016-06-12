<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Australia/Sydney');
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => "Ivan Li",
                'email' => "ivan.li@hotmail.com",
                'password' => "$2y$10$2Pdt1RuwNeVJDi64k92u/ODF25gH2.bVZxftp5q24hQ/hZaK.0PvW",
                'status' => "active",
                'confirmation_code' => NULL,
                'remember_token' => "WI4pSMWWiGKTfSbtRDurP9Xk1YWMqgKh0qfj0JhKnyirPFuwdXMhmJJZxr7Z",
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
        ]);
    }
}
