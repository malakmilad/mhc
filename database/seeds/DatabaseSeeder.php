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
        $this->call(MenuTableSeeder::class);
        $this->call(GroupTableSeeder::class);
        $this->call(GroupMenuTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(UserGroupTableSeeder::class);
    }
}
