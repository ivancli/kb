<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Australia/Sydney');
        DB::table('role_user')->insert([
            [
                'role_id' => 1,
                'user_id' => 1
            ]
        ]);
    }
}
