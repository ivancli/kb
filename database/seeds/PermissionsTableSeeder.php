<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set('Australia/Sydney');
        DB::table('permissions')->insert([
            [
                'id' => 1,
                'name' => "view_user",
                'display_name' => "View User",
                'description' => "View User of KB",
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 2,
                'name' => "create_user",
                'display_name' => "Create User",
                'description' => "Create User in KB",
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 3,
                'name' => "edit_user",
                'display_name' => "Edit User",
                'description' => "Edit User of KB",
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
            [
                'id' => 4,
                'name' => "delete_user",
                'display_name' => "Delete User",
                'description' => "Delete User of KB",
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            ],
        ]);
    }
}
