<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new \App\User();
        $user->id = '1';
        $user->name = 'Admin';
        $user->type = 1;
        $user->email = "admin@admin.com";
        $user->password = bcrypt('123456');
        $user->save();
    }
}
