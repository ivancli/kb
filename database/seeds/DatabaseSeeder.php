<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminUserSeeder::class);
        $this->call(MainRoleSeeder::class);
        $this->call(CHAMSRoleSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(MainRolePermissionSeeder::class);
        $this->call(AdminUserRoleSeeder::class);
        $this->call(CHAMSUserRoleSeeder::class);
    }
}
