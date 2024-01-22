<?php

use Illuminate\Database\Seeder;

class GroupMenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = new \App\GroupMenuPermissions();
        $permission->menu_id = '1';
        $permission->group_id = '1';
        $permission->add = 1;
        $permission->update = 1;
        $permission->delete = 1;
        $permission->view = 1;
        $permission->save();

        $permission = new \App\GroupMenuPermissions();
        $permission->menu_id = '2';
        $permission->group_id = '1';
        $permission->add = 1;
        $permission->update = 1;
        $permission->view = 1;
        $permission->delete = 1;
        $permission->save();

        $permission = new \App\GroupMenuPermissions();
        $permission->menu_id = '3';
        $permission->group_id = '1';
        $permission->add = 1;
        $permission->update = 1;
        $permission->view = 1;
        $permission->delete = 1;
        $permission->save();

        $permission = new \App\GroupMenuPermissions();
        $permission->menu_id = '4';
        $permission->group_id = '1';
        $permission->add = 1;
        $permission->update = 1;
        $permission->view = 1;
        $permission->delete = 1;
        $permission->save();

        $permission = new \App\GroupMenuPermissions();
        $permission->menu_id = '5';
        $permission->group_id = '1';
        $permission->add = 1;
        $permission->update = 1;
        $permission->view = 1;
        $permission->delete = 1;
        $permission->save();

        $permission = new \App\GroupMenuPermissions();
        $permission->menu_id = '6';
        $permission->group_id = '1';
        $permission->add = 1;
        $permission->update = 1;
        $permission->view = 1;
        $permission->delete = 1;
        $permission->save();

        $permission = new \App\GroupMenuPermissions();
        $permission->menu_id = '7';
        $permission->group_id = '1';
        $permission->add = 1;
        $permission->update = 1;
        $permission->view = 1;
        $permission->delete = 1;
        $permission->save();

        $permission = new \App\GroupMenuPermissions();
        $permission->menu_id = '8';
        $permission->group_id = '1';
        $permission->add = 1;
        $permission->update = 1;
        $permission->view = 1;
        $permission->delete = 1;
        $permission->save();
    }
}
