<?php
use Illuminate\Database\Seeder;

/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 1/07/2016
 * Time: 12:19 AM
 */
class RandomUserInfoSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\UserInfo::class)->create();
    }
}