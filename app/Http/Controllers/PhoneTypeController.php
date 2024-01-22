<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePhoneType;
use App\PhoneType;

class PhoneTypeController extends Controller
{
     public function index($menuid)
    {
        $allphonetypes = PhoneType::all();
        return View('admin.phonetype.index',compact('allphonetypes','menuid'));
    }

    public function create($menuid)
    {
        
        return View('admin.phonetype.add',compact('menuid'));
    }
     
     public function store(StorePhoneType $request)
    {
        $data = $request->all();
        
        $newPhoneType = new PhoneType();
        $newPhoneType->type = $data['type'];
        $newPhoneType->save();
        
        return redirect()->route('phonetype.index',$data['menuid']);
    }

    public function edit(PhoneType $phonetype , $menuid)
    {
        
        return View('admin.phonetype.edit',compact('phonetype','menuid'));
        
    }

    public function update(StorePhoneType $request,PhoneType $phonetype)
    {
        $data = $request->all();
        
        $phonetype->type = $data['type'];
        
        $phonetype->save();
            
        return redirect()->route('phonetype.index',$data['menuid']);
    }

    public function destory(PhoneType $phonetype , $menuid)
    {
        $phonetype->delete();
        return redirect()->route('phonetype.index',$menuid);
        
    }
}
