<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = new \App\Menu();
        $menu->id = '1';
        $menu->name = 'القوائم';
        $menu->icon = 'fa fa-folder-open-o';
        $menu->url = 'menu.index';
        $menu->parent_id = NULL;
        $menu->save();


        $menu = new \App\Menu();
        $menu->id = '2';
        $menu->name = 'قائمة المجموعات';
        $menu->icon = 'fa fa-users';
        $menu->url = 'group.index';
        $menu->parent_id = NULL;
        $menu->save();

        $menu = new \App\Menu();
        $menu->id = '3';
        $menu->name = 'قائمة المستخدمين';
        $menu->icon = 'fa fa-user';
        $menu->url = 'user.index';
        $menu->parent_id = NULL;
        $menu->save();

        $menu = new \App\Menu();
        $menu->id = '4';
        $menu->name = 'قائمة متابعة العملاء';
        $menu->icon = 'fa fa-user';
        $menu->url = 'sheet.index';
        $menu->parent_id = NULL;
        $menu->save();

        $menu = new \App\Menu();
        $menu->id = '5';
        $menu->name = 'قائمة المهتمين';
        $menu->icon = 'fa fa-user';
        $menu->url = 'interest.index';
        $menu->parent_id = NULL;
        $menu->save();

        $menu = new \App\Menu();
        $menu->id = '6';
        $menu->name = 'قائمة انواع الهاتف';
        $menu->icon = 'fa fa-phone';
        $menu->url = 'phonetype.index';
        $menu->parent_id = NULL;
        $menu->save();

        $menu = new \App\Menu();
        $menu->id = '7';
        $menu->name = 'الخدمات';
        $menu->icon = 'fa fa-cart-plus';
        $menu->url = 'service.index';
        $menu->parent_id = NULL;
        $menu->save();

        $menu = new \App\Menu();
        $menu->id = '8';
        $menu->name = 'قائمة المواعيد';
        $menu->icon = 'fa fa-clock-o';
        $menu->url = 'timetable.index';
        $menu->parent_id = NULL;
        $menu->save();
    }
}
