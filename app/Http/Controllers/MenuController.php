<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenu;
use App\Http\Requests\StoreUpdateMenu;
use App\Menu;
use App\UserGroup;
use App\GroupMenuPermissions;
use App\MenuMenuPermissions;

class MenuController extends Controller
{
     public function index($menuid)
    {
        $allMenus = Menu::all();
        return View('admin.Menus.index',compact('allMenus','menuid'));
    }

    public function create($menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        return View('admin.Menus.add',compact('allmenus','menuid'));
    }
     
     public function store(StoreMenu $request)
    {
        $data = $request->all();
        
        $newMenu = new Menu();
        $newMenu->name = $data['name'];
        $newMenu->name_en = $data['name_en'];
        $newMenu->icon = $data['icon'];
        if(isset($data['url'])){
           $newMenu->url = $data['url'];
         }else{
           $newMenu->url = NULL;
         }
        if(isset($data['parent_id'])){
           $newMenu->parent_id = $data['parent_id'];
        }else{
           $newMenu->parent_id = NULL;
        }
       
        $newMenu->save();

        
        return redirect()->route('menu.index',$data['menuid']);
    }

    public function edit(Menu $menu , $menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        return View('admin.Menus.edit',compact('allmenus','menu','menuid'));
        
    }

    public function update(StoreUpdateMenu $request,Menu $menu)
    {
        $data = $request->all();
        
        $menu->name = $data['name'];
        $menu->name_en = $data['name_en'];
        $menu->icon = $data['icon'];
        if(isset($data['url'])){
           $menu->url = $data['url'];
         }else{
           $menu->url = NULL;
         }
        if(isset($data['parent_id'])){
           $menu->parent_id = $data['parent_id'];
        }else{
           $menu->parent_id = NULL;
        }

        $menu->save();
            
        return redirect()->route('menu.index',$data['menuid']);
    }

    public function destory(Menu $menu , $menuid)
    {
        GroupMenuPermissions::where('menu_id','=',$menu->id)->delete();
        $menu->delete();

        return redirect()->route('menu.index',$menuid);
        
    }
    public static function check_menue($menuid)
    {
        $userid = \Auth::user()->id;
        $groups=UserGroup::where("user_id",$userid)->get();
        foreach ($groups as $group) {
           $has_permission= GroupMenuPermissions::where("menu_id",$menuid)->where("group_id",$group->group_id)->where("view",1)->get();
           if(count($has_permission)>0)
           { 
               return 1;
           }
        }
        return 0;
    }

}
