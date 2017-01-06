<?php

use Illuminate\Database\Seeder;

class RandomUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User\User::class, 5)->create();
    }
}
