<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Area;
use App\GroupMenuPermissions;
use App\Menu;


class AreaController extends Controller
{
   
    public function index($menuid)
    {
         $allareas = Area::all();
         foreach($allareas as $area)
         {
             if($area->parentid!=0)
             {
                 $parent=Area::find($area->parentid);
                 if(\Session::has("locale") && \Session::get("locale")=="ar")
                 $area->myparent=$parent->arabicName;
                 else
                 $area->myparent=$parent->name;

             }
             else
             {
                if(\Session::has("locale") && \Session::get("locale")=="ar")
                 {
                 $area->myparent="محافظة";
                 }
                 else
                 {
                    $area->myparent="Gov";
                 }
             }
         }
        return View('admin.areas.index',compact('allareas','menuid'));
    }
    
    public function create($menuid)
    {
        $govs=Area::where("parentid",0)->get();
        return View('admin.areas.add',compact('govs','menuid'));
    }
    
     public function store(Request $request)
    {
        $data = $request->all();
        
      $area=new Area;
      $area->name=$request->name;
      $area->arabicName=$request->arabicName;
      $area->parentid=$request->parentid;
      $area->save();

        
        return redirect()->route('area.index',$data['menuid']);
    }
     public function update(Request $request,Area $area)
    {
        $data = $request->all();
        
        $area->name = $data['name'];
        $area->arabicName = $data['arabicName'];
        $area->parentid = $data['parentid'];
       
       
        $area->save();

        
        return redirect()->route('area.index',$data['menuid']);
    }
    public function edit(Area $area , $menuid)
    {
        $govs=Area::where("parentid",0)->get();
        return View('admin.areas.edit',compact('govs','area','menuid'));
        
    }
    
    public function destory(Area $area , $menuid)
    {
        GroupMenuPermissions::where('menu_id','=',$area->id)->delete();
        $area->delete();

        return redirect()->route('area.index',$menuid);
        
    }
}
