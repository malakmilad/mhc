<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\givingPermissions;
use App\Menu;
use App\Client;
use App\Company;
use App\Account;
use App\VarAssets;
use DB;
use App\CostCenter;
use App\CostAccount;
use App\CostCenterTrans;
use App\User;
use App\Order;
use App\Asses;
use App\Problem;
use App\Order_problem;
use App\WorkOrder;
use App\WorkOrder_problem;
use App\WorkAsses;
use App\IncWorkOrder;
use App\TimeTable;
use App\Expense;
class giving_permissionController extends Controller
{
    //
    public function index($id)
    {
      $permissions=givingPermissions::all();
      $menus=Menu::all();
      foreach($permissions as $item)
      {
          if($item->companyid!=0)
          {
              $user=Company::find($item->companyid);
              $item->type_name="شركة تأمين";
          }
          elseif($item->clientid!=0)
          {
              $user=Client::find($item->clientid);
              $item->type_name="عميل ";
          }
          elseif($item->accountid!=0)
          {
              $user=Account::find($item->accountid);
              $item->type_name="حساب عام";
          }
           elseif($item->supplierid!=0)
          {
              $user=Client::find($item->supplierid);
              $item->type_name="مورد";
          }
          if($user!=NULL)
          {
          $item->name=$user->name;
          }
          else
          {
          $item->name="";
          }
      }
      $type=1;
      return view('admin.givingPermissions.index',compact('permissions','menus','id','type'));
    }
   
    public function search($id,Request $request)
    {
      $permissions=givingPermissions::where('created_at', '>=', $request->date_from.' 00:00:00')->where('created_at', '<=', $request->date_to.' 00:00:00')->get();
      $menus=Menu::all();
      foreach($permissions as $item)
      {
          if($item->companyid!=0)
          {
              $user=Company::find($item->companyid);
              $item->type_name="شركة تأمين";
          }
          elseif($item->clientid!=0)
          {
              $user=Client::find($item->clientid);
              $item->type_name="عميل ";
          }
          elseif($item->accountid!=0)
          {
              $user=Account::find($item->accountid);
              $item->type_name="حساب عام";
          }
           elseif($item->supplierid!=0)
          {
              $user=Client::find($item->supplierid);
              $item->type_name="مورد";
          }
          if($user!=NULL)
          {
          $item->name=$user->name;
          }
          else
          {
          $item->name="";
          }
      }
      $date_from=$request->date_from;
      $date_to=$request->date_to;
      $type=1;
      return view('admin.givingPermissions.index',compact('permissions','menus','id','date_from','date_to','type'));
    }
   
    public function add($menuid)
    {
      $users=User::all();
      $menus=Menu::all();
    //  $clients=Client::where("type","!=",2)->get();
      $companies=Company::all();
      // $generic_accounts=Account::all();
      //$suppliers=Client::where("type",2)->get();
      $expenses=Expense::all();
      //$accounts  =   $companies;
     
      $accounts=array();
      foreach($companies as $account)
       {
           array_push($accounts,array("id"=>"1,".$account->id,"name"=>"trips / ".$account->name));
       }
       foreach($expenses as $account)
       {
           array_push($accounts,array("id"=>"2,".$account->id,"name"=>"expenses  / ".$account->name));
       }
       /*foreach($companies as $account)
       {
           array_push($accounts,array("id"=>"3,".$account->id,"name"=>" شركات التأمين / ".$account->name));
       }
       foreach($generic_accounts as $account)
       {
           array_push($accounts,array("id"=>"4,".$account->id,"name"=>"الحسابات العامة  / ".$account->name));
       }*/
        $var_assets=VarAssets::all();//where("parent_id","!=",0)->get();
        $statement = DB::select("show table status like 'giving_permissions'");
        $next_id=$statement[0]->Auto_increment;
    //  $cost_centers_accounts=CostAccount::all();
      //$cost_centers=CostCenter::all();
      return view('admin.givingPermissions.add',compact('menus','var_assets','menuid','accounts','next_id','users'));
  
     // return view('admin.givingPermissions.add',compact('var_assets','menus','menuid','accounts','next_id','cost_centers','users'));
    }
    public function get_operations_duduct(Request $request)
    {
        $company =$request->account;
          
            $operations = DB::table('time_tables')
                        ->select('time_tables.*')          
                        ->whereNotIn('id',function ($query) {
                            $query->select(DB::raw('orderid'))
                                  ->from('giving_permissions')->where('orderid','!=',NULL);
                        })->where('company_id',$company)->where("deduct_value", '!=',NULL)
                        ->get();
            $orders_ids = array();
            
            $response = array(
                'status' => 'success',
                'operations' => $operations,
               
            );
           return response()->json($response);
    }

    public function store(Request $request)
    {
        $this->validate(
            $request, 
            ['id'=>'required|unique:giving_permissions'],
            ['id.unique' => 'هذا الكود موجود من قبل'],
            ['attachment' =>  'required|mimes:jpeg,png,jpg,bmp,doc,docx,pdf']
        );
        $permission=new givingPermissions;
        $permission->id=$request->id;
        if(isset($request->operation)&&$request->operation!=0)
        {
            $permission->orderid=$request->operation;
        }
      //  $permission->created_by=auth()->user()->id;
        $account_array=explode(",",$request->account);
        //$type=$account_array[0];
        $account_id=$request->account;//$account_array[1];
        
       /* if($type==1)
        $permission->clientid=$account_id;*/
     //   if($type==3)
        $permission->companyid=$account_array[1];
      /*  if($type==4)
        $permission->accountid=$account_id;
        if($type==2)
        $permission->supplierid=$account_id;*/
        
        $permission->money=$request->money;
        $permission->notes=$request->notes;
        $permission->type=$request->type;
        $permission->var_asset_id=$request->var_asset_id;
        $permission->created_by=$request->users;
        if(isset($request->attachment)) {
            $imageUrl = $this->storeImage($request);
            $permission->attachment = $imageUrl;
        }
        $permission->Date=$request->created_at;
        $permission->Payment_Method=$request->PaymentMethod;
        /*  if(isset($request->cost_centers))
        {
            $permission->cost_centers=1;
        }
        else
        {
            $permission->cost_centers=0;
        }*/
        
        $permission->save();
        if($request->operation!=null)
        {
        $oper_paid=TimeTable::find($request->operation);
        $oper_paid->paid_status=1;
        $oper_paid->save();
        }
    
        return redirect('giving_permissions/'.$request->menuid);
   

    }
    protected function storeImage(Request $request) {
        $path = $request->file('attachment')->store("public/profile");
        return substr($path, strlen('public/'));
    }
    public function update($id,$menuid)
    {
       $repermission=givingPermissions::whereId($id)->first();
     $orders_ids=array();
      if($repermission->companyid!=0 )
        {
            
            $orders = DB::table('time_tables')
                        ->select('time_tables.*')          
                        ->where('company_id',$repermission->companyid)->where("deduc_value", '!=',NULL)
                        ->get(); 
        foreach($orders as $order)
        {
            array_push($orders_ids,array("id"=>$order->id,"name"=>$order->name));
       }
        }
     
      // $clients=Client::where("type","!=",2)->get();
       $companies=Company::all();
      // $generic_accounts=Account::all();
      // $suppliers=Client::where("type",2)->get();
       $menus=Menu::all();
       $var_assets=VarAssets::all();//where("parent_id","!=",0)->get();
       $accounts=array();
     
       foreach($companies as $account)
       {
           array_push($accounts,array("id"=>$account->id,"name"=>$account->name));
       }
        return view('admin.givingPermissions.edit',compact('var_assets','repermission','menus','menuid','accounts','orders_ids'));

    }

    public function edit(Request $request)
    {
        $this->validate(
            $request, 
            ['id'=>'required|unique:giving_permissions,id,'.$request->repermissionid],
            ['id.unique' => 'هذا الكود موجود من قبل']
        );
        $permission=givingPermissions::find($request->repermissionid);
        $permission->id=$request->id;
        if(isset($request->billing)&&$request->billing!=0)
        {
            $permission->orderid=$request->billing;
        }
      
       // $account_array=explode(",",$request->account);
       // $type=$account_array[0];
        $account_id=$request->account;
        
        
        $permission->companyid=$account_id;
        $permission->supplierid=0;
        $permission->clientid=0;
        $permission->accountid=0;
     
        
        $permission->money=$request->money;
        $permission->notes=$request->notes;
        $permission->type=$request->type;
        $permission->var_asset_id=$request->var_asset_id;
       
        $permission->save();
       
        
        return redirect('giving_permissions/'.$request->menuid);
      
           
      }
    public function destory($id,$menuid)
    {
        $deleted=givingPermissions::whereId($id)->first()->delete();
        return redirect('giving_permissions/'.$menuid);   
    }
    
    public function report($id)
    {
        
     $permissions=givingPermissions::whereNotNull("orderid")->where(function ($query) {$query->where('clientid', '!=', 0)->orWhere('companyid', '!=', 0);})->get();
      $menus=Menu::all();
      foreach($permissions as $item)
      {
          if($item->companyid!=0)
          {
              $user=Company::find($item->companyid);
              $item->type_name="شركة تأمين";
          }
          elseif($item->clientid!=0)
          {
              $user=Client::find($item->clientid);
              $item->type_name="عميل ";
          }
          elseif($item->accountid!=0)
          {
              $user=Account::find($item->accountid);
              $item->type_name="حساب عام";
          }
           elseif($item->supplierid!=0)
          {
              $user=Client::find($item->supplierid);
              $item->type_name="مورد";
          }
          if($user!=NULL)
          {
          $item->name=$user->name;
          }
          else
          {
          $item->name="";
          }
      }
      
      $companies=Company::all();

      $clients=Client::where("type","!=",2)->get();
        $accounts=array();
        foreach($clients as $account)
        {
           array_push($accounts,array("id"=>"1,".$account->id,"name"=>" العملاء / ".$account->name));
        }
        
        foreach($companies as $account)
        {
           array_push($accounts,array("id"=>"3,".$account->id,"name"=>" شركات التأمين / ".$account->name));
        }
        $users=User::all();
      return view('admin.givingPermissions.report',compact('permissions','menus','id','accounts','users'));

   }
    public function report_filter($id,Request $request)
    {
        
      $conditions=array();
      $filter=array();
      $conditions=array();
      if(isset($request->date_from) && isset($request->date_to))
      {
          $conditions[]=['created_at', '>=', $request->date_from.' 00:00:00'];
          $conditions[]=['created_at', '<=', $request->date_to.' 00:00:00'];
          $filter['date_from']=$request->date_from;
          $filter['date_to']=$request->date_to;
      }
      if(isset($request->employee) && $request->employee!=0)
      {
          $conditions[]=['created_by', '=', $request->employee];
          $filter['employee']=$request->employee;
      }
      
       if(isset($request->account) && $request->account!=0)
       {
        $account_array=explode(",",$request->account);
        $type=$account_array[0];
        $accountid=$account_array[1];
        if($type==1 )
        {
            $conditions[]=["clientid",'=',$accountid];
            $filter['account']="1,".$accountid;
           
        }
        elseif($type==3 )
        {
            $conditions[]=["companyid",'=',$accountid];
            $filter['account']="3,".$accountid;
        }
       }
        
     $permissions=givingPermissions::whereNotNull("orderid")->where($conditions)->where(function ($query) {$query->where('clientid', '!=', 0)->orWhere('companyid', '!=', 0);})->get();
      $menus=Menu::all();
      foreach($permissions as $item)
      {
          if($item->companyid!=0)
          {
              $user=Company::find($item->companyid);
              $item->type_name="شركة تأمين";
          }
          elseif($item->clientid!=0)
          {
              $user=Client::find($item->clientid);
              $item->type_name="عميل ";
          }
          elseif($item->accountid!=0)
          {
              $user=Account::find($item->accountid);
              $item->type_name="حساب عام";
          }
           elseif($item->supplierid!=0)
          {
              $user=Client::find($item->supplierid);
              $item->type_name="مورد";
          }
          if($user!=NULL)
          {
          $item->name=$user->name;
          }
          else
          {
          $item->name="";
          }
      }
      
      $companies=Company::all();

      $clients=Client::where("type","!=",2)->get();
        $accounts=array();
        foreach($clients as $account)
        {
           array_push($accounts,array("id"=>"1,".$account->id,"name"=>" العملاء / ".$account->name));
        }
        
        foreach($companies as $account)
        {
           array_push($accounts,array("id"=>"3,".$account->id,"name"=>" شركات التأمين / ".$account->name));
        }
        $users=User::all();
      return view('admin.givingPermissions.report',compact('permissions','menus','id','accounts','users','filter'));

   }
}
