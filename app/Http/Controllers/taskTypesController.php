<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskType;
use App\GroupMenuPermissions;
use App\Menu;


class taskTypesController extends Controller
{
   
    public function index($menuid)
    {
         $allTypes = TaskType::all();
        return View('admin.TaskTypes.index',compact('allTypes','menuid'));
    }
    
    public function create($menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        return View('admin.TaskTypes.add',compact('allmenus','menuid'));
    }
    
     public function store(Request $request)
    {
        $data = $request->all();
        
        $newTaskType = new TaskType();
        $newTaskType->name = $data['name'];
       
       
        $newTaskType->save();

        
        return redirect()->route('taskTypes.index',$data['menuid']);
    }
     public function update(Request $request,TaskType $TaskType)
    {
        $data = $request->all();
        
        $TaskType->name = $data['name'];
       
       
        $TaskType->save();

        
        return redirect()->route('taskTypes.index',$data['menuid']);
    }
    public function edit(TaskType $TaskType , $menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        return View('admin.TaskTypes.edit',compact('allmenus','TaskType','menuid'));
        
    }
    
    public function destory(TaskType $TaskType , $menuid)
    {
        GroupMenuPermissions::where('menu_id','=',$TaskType->id)->delete();
        $TaskType->delete();

        return redirect()->route('taskTypes.index',$menuid);
        
    }
}
