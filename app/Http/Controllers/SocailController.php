<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Socail;
use App\GroupMenuPermissions;
use App\Menu;


class SocailController extends Controller
{
   
    public function index($menuid)
    {
         $allSocails = Socail::all();
        return View('admin.socail.index',compact('allSocails','menuid'));
    }
    
    public function create($menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        return View('admin.socail.add',compact('allmenus','menuid'));
    }
    
     public function store(Request $request)
    {
        $data = $request->all();
        
        $newSocail = new Socail();
        $newSocail->name = $data['name'];
       
       
        $newSocail->save();

        
        return redirect()->route('socail.index',$data['menuid']);
    }
     public function update(Request $request,Socail $Socail)
    {
        $data = $request->all();
        
        $Socail->name = $data['name'];
       
       
        $Socail->save();

        
        return redirect()->route('socail.index',$data['menuid']);
    }
    public function edit(Socail $socail , $menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        return View('admin.socail.edit',compact('allmenus','socail','menuid'));
        
    }
    
    public function destory(Socail $socail , $menuid)
    {
        GroupMenuPermissions::where('menu_id','=',$socail->id)->delete();
        $socail->delete();

        return redirect()->route('socail.index',$menuid);
        
    }
}
