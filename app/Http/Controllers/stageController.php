<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Stage;
use App\GroupMenuPermissions;
use App\Menu;


class stageController extends Controller
{
   
    public function index($menuid)
    {
         $allStages = Stage::all();
        return View('admin.stage.index',compact('allStages','menuid'));
    }
    
    public function create($menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        return View('admin.stage.add',compact('allmenus','menuid'));
    }
    
     public function store(Request $request)
    {
        $data = $request->all();
        
        $newStage = new Stage();
        $newStage->name = $data['name'];
       
       
        $newStage->save();

        
        return redirect()->route('stage.index',$data['menuid']);
    }
     public function update(Request $request,Stage $Stage)
    {
        $data = $request->all();
        
        $Stage->name = $data['name'];
       
       
        $Stage->save();

        
        return redirect()->route('stage.index',$data['menuid']);
    }
    public function edit(Stage $Stage , $menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        return View('admin.stage.edit',compact('allmenus','Stage','menuid'));
        
    }
    
    public function destory(Stage $Stage , $menuid)
    {
        GroupMenuPermissions::where('menu_id','=',$Stage->id)->delete();
        $Stage->delete();

        return redirect()->route('stage.index',$menuid);
        
    }
}
