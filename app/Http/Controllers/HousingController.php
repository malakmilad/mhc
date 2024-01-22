<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Housing;
use App\GroupMenuPermissions;
use App\Menu;


class HousingController extends Controller
{
   
    public function index($menuid)
    {
         $allHousings = Housing::all();
        return View('admin.Housings.index',compact('allHousings','menuid'));
    }
    
    public function create($menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        return View('admin.Housings.add',compact('allmenus','menuid'));
    }
    
     public function store(Request $request)
    {
        $data = $request->all();
        
        $newHousing = new Housing();
        $newHousing->name = $data['name'];
        $newHousing->email = $data['email'];
        $newHousing->address = $data['address'];
        $newHousing->phone = $data['phone'];
        $newHousing->save();

        
        return redirect()->route('housing.index',$data['menuid']);
    }
     public function update(Request $request,Housing $Housing)
    {
        $data = $request->all();
        
        $Housing->name = $data['name'];
        $Housing->email = $data['email'];
        $Housing->address = $data['address'];
        $Housing->phone = $data['phone'];
       
       
        $Housing->save();

        
        return redirect()->route('housing.index',$data['menuid']);
    }
    public function edit(Housing $Housing , $menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        return View('admin.Housings.edit',compact('allmenus','Housing','menuid'));
        
    }
    
    public function destory(Housing $Housing , $menuid)
    {
        GroupMenuPermissions::where('menu_id','=',$Housing->id)->delete();
        $Housing->delete();

        return redirect()->route('housing.index',$menuid);
        
    }
}
