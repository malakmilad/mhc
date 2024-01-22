<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TaskStatus;
use App\GroupMenuPermissions;
use App\Menu;


class taskStatusController extends Controller
{
   
    public function index($menuid)
    {
         $allStatus = TaskStatus::all();
        return View('admin.TaskStatus.index',compact('allStatus','menuid'));
    }
    
    public function create($menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        return View('admin.TaskStatus.add',compact('allmenus','menuid'));
    }
    
     public function store(Request $request)
    {
        $data = $request->all();
        
        $newTaskStatus = new TaskStatus();
        $newTaskStatus->name = $data['name'];
       
       
        $newTaskStatus->save();

        
        return redirect()->route('taskStatus.index',$data['menuid']);
    }
     public function update(Request $request,TaskStatus $TaskStatus)
    {
        $data = $request->all();
        
        $TaskStatus->name = $data['name'];
       
       
        $TaskStatus->save();

        
        return redirect()->route('taskStatus.index',$data['menuid']);
    }
    public function edit(TaskStatus $TaskStatus , $menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        return View('admin.TaskStatus.edit',compact('allmenus','TaskStatus','menuid'));
        
    }
    
    public function destory(TaskStatus $TaskStatus , $menuid)
    {
        GroupMenuPermissions::where('menu_id','=',$TaskStatus->id)->delete();
        $TaskStatus->delete();

        return redirect()->route('taskStatus.index',$menuid);
        
    }
}
