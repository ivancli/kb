<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CHAMSRoleSeeder extends Seeder
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
        DB::table('roles')->insert([
            [
                'id' => 3,
                'name' => "chams_admin",
                'display_name' => "CHAMS Administrator",
                'description' => "Administrator of CHAMS",
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 4,
                'name' => "chams_asset_distributor",
                'display_name' => "CHAMS Asset Distributor",
                'description' => "Asset distributor of CHAMS",
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 5,
                'name' => "chams_asset_manager",
                'display_name' => "CHAMS Asset Manager",
                'description' => "Asset manager of CHAMS",
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 6,
                'name' => "chams_client",
                'display_name' => "CHAMS Client",
                'description' => "Client of CHAMS",
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 7,
                'name' => "chams_reporter",
                'display_name' => "CHAMS Reporter",
                'description' => "Reporter of CHAMS",
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 8,
                'name' => "chams_staff",
                'display_name' => "CHAMS Staff",
                'description' => "Staff of CHAMS",
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
        ]);
    }
}
