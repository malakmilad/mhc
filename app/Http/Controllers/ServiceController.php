<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreService;
use App\Servic;

class ServiceController extends Controller
{
    public function index($menuid)
    {
        $allservices = Servic::all();
        return View('admin.service.index',compact('allservices','menuid'));
    }

    public function create($menuid)
    {
        
        return View('admin.service.add',compact('menuid'));
    }
     
     public function store(StoreService $request)
    {
        $data = $request->all();
        
        $newService = new Servic();
        $newService->name = $data['name'];
        $newService->save();
        
        return redirect()->route('service.index',$data['menuid']);
    }

    public function edit(Servic $service , $menuid)
    {
        
        return View('admin.service.edit',compact('service','menuid'));
        
    }

    public function update(StoreService $request,Servic $service)
    {
        $data = $request->all();
        
        $service->name = $data['name'];
        
        $service->save();
            
        return redirect()->route('service.index',$data['menuid']);
    }

    public function destory(Servic $service , $menuid)
    {
        $service->delete();
        return redirect()->route('service.index',$menuid);
        
    }
}
