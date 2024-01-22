<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = new \App\Group();
        $group->id = '1';
        $group->name = 'Super Admin';
        $group->save();
    }
}
