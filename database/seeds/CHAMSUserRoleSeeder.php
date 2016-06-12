<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CHAMSUserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //role:chams_admin|chams_asset_distributor|chams_asset_manager|chams_client|chams_reporter|chams_staff
        date_default_timezone_set('Australia/Sydney');
        DB::table('role_user')->insert([
            [
                'role_id' => 3,
                'user_id' => 1
            ]
        ]);
    }
}
