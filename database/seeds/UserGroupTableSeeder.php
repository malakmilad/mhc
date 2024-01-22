<?php

use Illuminate\Database\Seeder;

class UserGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\UserGroup();
        $user->user_id = 1;
        $user->group_id = 1;
        $user->save();
    }
}
