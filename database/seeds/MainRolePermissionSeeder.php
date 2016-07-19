<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_role')->insert([
            [
                'permission_id' => 1,
                'role_id' => 1
            ],
            [
                'permission_id' => 2,
                'role_id' => 1
            ],
            [
                'permission_id' => 3,
                'role_id' => 1
            ],
            [
                'permission_id' => 4,
                'role_id' => 1
            ],
            [
                'permission_id' => 5,
                'role_id' => 3
            ],
            [
                'permission_id' => 5,
                'role_id' => 4
            ],
            [
                'permission_id' => 5,
                'role_id' => 5
            ],
            [
                'permission_id' => 5,
                'role_id' => 6
            ],
            [
                'permission_id' => 5,
                'role_id' => 7
            ],
            [
                'permission_id' => 5,
                'role_id' => 8
            ],
        ]);
    }
}
