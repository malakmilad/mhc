<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CustomerTypes;
use App\GroupMenuPermissions;
use App\Menu;


class customerController extends Controller
{
   
    public function index($menuid)
    {
         $allCustomers = CustomerTypes::all();
        return View('admin.customer_types.index',compact('allCustomers','menuid'));
    }
    
    public function create($menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        return View('admin.customer_types.add',compact('allmenus','menuid'));
    }
    
     public function store(Request $request)
    {
        $data = $request->all();
        
        $newCustomerType = new CustomerTypes();
        $newCustomerType->name = $data['name'];
       
       
        $newCustomerType->save();

        
        return redirect()->route('customer.index',$data['menuid']);
    }
     public function update(Request $request,CustomerTypes $customerType)
    {
        $data = $request->all();
        
        $customerType->name = $data['name'];
       
       
        $customerType->save();

        
        return redirect()->route('customer.index',$data['menuid']);
    }
    public function edit(CustomerTypes $customerType , $menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        return View('admin.customer_types.edit',compact('allmenus','customerType','menuid'));
        
    }
    
    public function destory(CustomerTypes $customerType , $menuid)
    {
        GroupMenuPermissions::where('menu_id','=',$customerType->id)->delete();
        $customerType->delete();

        return redirect()->route('customer.index',$menuid);
        
    }
}
