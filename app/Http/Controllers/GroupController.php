<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGroup;
use App\Http\Requests\StoreUpdateGroup;
use App\Group;
use App\Menu;
use App\GroupMenuPermissions;

class GroupController extends Controller
{
    public function index($menuid)
    {
        $allgroups = Group::all();
        $activetap = "group";
        return View('admin.groups.index',compact('allgroups','menuid','activetap'));
    }

    public function create($menuid)
    {
        $allmenus = Menu::all();

        return View('admin.groups.add',compact('allmenus','menuid'));
    }
     
     public function store(StoreGroup $request)
    {
        $data = $request->all();
        
        $newGroup = new Group();
        $newGroup->name = $data['name'];
       
        $newGroup->save();

         // save permissions 

     if($request->itrator > 0){
      
            for($i=1 ; $i <= $request->itrator ; $i++){
                $menu_id             = "menu_id".$i;
                $add             = "add".$i;
                $update             = "update".$i;
                $delete             = "delete".$i;
                $view             = "view".$i;
             if( isset($request[$add]) || isset($request[$update]) || isset($request[$delete]) || isset($request[$view])){
                if(isset($request[$menu_id]) && $request[$menu_id] !='' ){
                $permission    = new GroupMenuPermissions();

                $permission->menu_id      = $request[$menu_id];
                $permission->group_id      = $newGroup->id;
                if(isset($request[$add])){
                $permission->add = $request[$add];
                }else{
                $permission->add = 0;
                }

                if(isset($request[$update])){
                $permission->update = $request[$update];
                }else{
                $permission->update = 0;
                }

                if(isset($request[$delete])){
                $permission->delete = $request[$delete];
                }else{
                $permission->delete = 0;
                }

                if(isset($request[$view])){
                $permission->view = $request[$view];
                }else{
                $permission->view = 0;
                }

                $permission->save();

              } // end if 2
            }   // endif  1

            } // end for loop
        }  // end if itrator

        return redirect()->route('group.index',$data['menuid']);
    }

    public function edit(Group $group , $menuid)
    {
        $allmenus = Menu::all();

        return View('admin.groups.edit',compact('allmenus','group','menuid'));
        
    }

    public function update(StoreUpdateGroup $request,Group $group)
    {
        $data = $request->all();
        
        $group->name = $data['name'];
        $group->save();

            // save Phones 
     GroupMenuPermissions::where('group_id','=',$group->id)->delete();
         // save permissions 

     if($request->itrator > 0){
      
            for($i=1 ; $i <= $request->itrator ; $i++){
                $menu_id             = "menu_id".$i;
                $add             = "add".$i;
                $update             = "update".$i;
                $delete             = "delete".$i;
                $view             = "view".$i;
        if( isset($request[$add]) || isset($request[$update]) || isset($request[$delete]) || isset($request[$view]) ){
                if(isset($request[$menu_id]) && $request[$menu_id] !='' ){
                $permission    = new GroupMenuPermissions();

                $permission->menu_id      = $request[$menu_id];
                $permission->group_id      = $group->id;
                
                $permission->group_id = $group->id;
                if(isset($request[$add])){
                $permission->add = $request[$add];
                }else{
                $permission->add = 0;
                }

                if(isset($request[$update])){
                $permission->update = $request[$update];
                }else{
                $permission->update = 0;
                }

                if(isset($request[$delete])){
                $permission->delete = $request[$delete];
                }else{
                $permission->delete = 0;
                }

                if(isset($request[$view])){
                $permission->view = $request[$view];
                }else{
                $permission->view = 0;
                }

                $permission->save();

              } // end if 2 
              } // end if 1 
            } // end for loop
        }  // end if itrator
        return redirect()->route('group.index',$data['menuid']);
    }

    public function destory(Group $group , $menuid)
    {
        GroupMenuPermissions::where('group_id','=',$group->id)->delete();
        $group->delete();
        return redirect()->route('group.index',$menuid);
        
    }

}
