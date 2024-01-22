<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activite;
use App\GroupMenuPermissions;
use App\Menu;


class ActiviteController extends Controller
{
   
    public function index($menuid)
    {
         $allActivites = Activite::all();
        return View('admin.Activites.index',compact('allActivites','menuid'));
    }
    
    public function create($menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        return View('admin.Activites.add',compact('allmenus','menuid'));
    }
    
     public function store(Request $request)
    {
        $data = $request->all();
        
        $newActivite = new Activite();
        $newActivite->name = $data['name'];
       
       
        $newActivite->save();

        
        return redirect()->route('activite.index',$data['menuid']);
    }
     public function update(Request $request,Activite $Activite)
    {
        $data = $request->all();
        
        $Activite->name = $data['name'];
       
       
        $Activite->save();

        
        return redirect()->route('activite.index',$data['menuid']);
    }
    public function edit(Activite $activite , $menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        return View('admin.Activites.edit',compact('allmenus','activite','menuid'));
        
    }
    
    public function destory(Activite $activite , $menuid)
    {
        GroupMenuPermissions::where('menu_id','=',$activite->id)->delete();
        $activite->delete();

        return redirect()->route('activite.index',$menuid);
        
    }
}
