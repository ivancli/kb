<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainUserRoleSeeder extends Seeder
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
                'id' => 7,
                'name' => "kb_admin",
                'display_name' => "ICL KB Administrator",
                'description' => "Administrator of ICL Knowledge Base",
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 8,
                'name' => "kb_visitor",
                'display_name' => "ICL KB Visitor",
                'description' => "Visitor of ICL Knowledge Base",
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
        ]);
    }
}
