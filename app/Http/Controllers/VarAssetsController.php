<?php

namespace App\Http\Controllers;
use App\Dictionary;
use App\Store;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\VarAssets;
use App\Menu;
use DB;
use App\ReceivingPermissions;
use App\GivingPermissions;
use App\Transaction;
use App\MoneyTransaction;
class VarAssetsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
      $menus=Menu::all();
      $varAssets=VarAssets::all();
      $total_debit=0;
      $total_credit=0;
       foreach($varAssets as $item)
      {
          
          $total_credit_giving=GivingPermissions::where('var_asset_id', $item->id)->sum('money');
          $total_debit_revieving=ReceivingPermissions::where('var_asset_id', $item->id)->sum('money');
         /* $total_debit_transaction=MoneyTransaction::where("type",1)->where("account_id",$item->id)->sum('debit');
          $total_credit_transaction=MoneyTransaction::where("type",1)->where("account_id",$item->id)->sum('credit');
          $total_debit_transaction_convert=MoneyTransaction::where("type",9)->where("account_id",$item->id)->sum('debit');
          $total_credit_transaction_convert=MoneyTransaction::where("type",9)->where("account_id",$item->id)->sum('credit');
     */
           $item->sum=($total_debit_revieving-$total_credit_giving);
           $total_debit+=$item->sum;
          if($item->type==1)
          {
              $item->type="حساب بنكى";
          }
          else
          {
              $item->type="خزينة";
          }
      }

   
      return view('admin.varAssets.index',compact('varAssets','menus','id','total_debit'));
    }
    public function search($id,Request $request)
    {
      $varAssets=VarAssets::where('created_at', '>=', $request->date_from.' 00:00:00')->where('created_at', '<=', $request->date_to.' 00:00:00')->get();
      $total_debit=0;
      $total_credit=0;
       foreach($varAssets as $item)
      {
          $total_debit_giving=GivingPermissions::where('var_asset_id', $item->id)->sum('money');
          $total_credit_revieving=ReceivingPermissions::where('var_asset_id', $item->id)->sum('money');
          $total_debit_transaction=MoneyTransaction::where("type",1)->where("account_id",$item->id)->sum('debit');
          $total_credit_transaction=MoneyTransaction::where("type",1)->where("account_id",$item->id)->sum('credit');
          $total_debit_transaction_convert=MoneyTransaction::where("type",9)->where("account_id",$item->id)->sum('debit');
          $total_credit_transaction_convert=MoneyTransaction::where("type",9)->where("account_id",$item->id)->sum('credit');
           //  if($item->type==1)
       //   {
           $item->sum=($total_debit_giving+$total_debit_transaction+ $total_credit_transaction_convert)-($total_credit_revieving+$total_credit_transaction+$total_debit_transaction_convert);
           $total_debit+=$item->sum;
        //  }
         /* else
          {
          $item->sum=($total_credit_revieving+$total_credit_transaction)-($total_debit_giving+$total_debit_transaction);
          $total_credit+=$item->sum;
          }
          
          $parent=VarAssets::find($item->parent_id);
          
          if($parent!=NULL)
          {
          $item->parent=$parent->name;
          }
          else
          {
          $item->parent="حساب رئيسي";
          }*/
          if($item->type==1)
          {
              $item->type="حساب بنكى";
          }
          else
          {
              $item->type="خزينة";
          }
      }
      $menus=Menu::all();
      $date_from=$request->date_from;
      $date_to=$request->date_to;
      return view('admin.varAssets.index',compact('varAssets','menus','id','date_from','date_to','total_debit'));;
    }
    public function show($id,$menuid)
    {
          
           $var_asset=VarAssets::find($id);
               $reciveds=array();//id billing debit credit balance notes created_at
               $transferData=array();
               $recivied=ReceivingPermissions::where("var_asset_id",$id)->get();
               foreach($recivied as $item)
               {
                     array_push($reciveds,array($item->id,1,$item->money,0,$item->money,$item->notes,$item->created_at));

               }
               $givings=GivingPermissions::where("var_asset_id",$id)->get();
               foreach($givings as $item)
               {
                    array_push($reciveds,array($item->id,2,0,$item->money,-$item->money,$item->notes,$item->created_at));

               }
               $transactions=MoneyTransaction::where("type",1)->where("account_id",$id)->where("debit",0)->get();
               foreach($transactions as $item)
               {
                    array_push($reciveds,array($item->id,3,0,$item->credit,-$item->credit,$item->description,$item->created_at));
               }
               $transactions=MoneyTransaction::where("type",1)->where("account_id",$id)->where("credit",0)->get();
               foreach($transactions as $item)
               {
                   array_push($reciveds,array($item->id,3,$item->debit,0,$item->debit,$item->description,$item->created_at));
               }
               $transactions=MoneyTransaction::where("type",9)->where("account_id",$id)->where("debit",0)->get();
               foreach($transactions as $item)
               {
                    array_push($reciveds,array($item->id,5,$item->credit,0,$item->credit,$item->description,$item->created_at));
                    $ass=VarAssets::find($item->account_id);
                 
                }
               $transactions=MoneyTransaction::where("type",9)->where("account_id",$id)->where("credit",0)->get();
 
               foreach($transactions as $item)
               {
                   array_push($reciveds,array($item->id,5,0,$item->debit,-$item->debit,$item->description,$item->created_at));
             }
             //   $transactions=MoneyTransaction::where("type",9)->get();
                $transactions=  DB::table('transactions')
            ->select('money_transactions.*',"var_assets.name as name","transactions.*")
            ->join('money_transactions', 'transactions.id', '=', 'money_transactions.transaction_id')
            ->join('var_assets','money_transactions.account_id','=','var_assets.id')->where("money_transactions.type",9)->where("account_id",$id)
            ->get();
                foreach($transactions as $item)
                { 
                   $transferto= DB::table('transactions')
                    ->select('money_transactions.*',"var_assets.name as name","transactions.id")
                    ->join('money_transactions', 'transactions.id', '=', 'money_transactions.transaction_id')
                    ->join('var_assets','money_transactions.account_id','=','var_assets.id')->where("money_transactions.type",9)->where("account_id",'!=',$id)
                  -> where('money_transactions.transaction_id','=', $item->id) ->get();  
                 
                    if(isset( $transferto[0])) 
                    {      
                  if($item->credit!=0)                  
                     array_push($transferData,array($item->id,5, $item->credit,$transferto[0]->name, $item->name,$item->StartDate));
                    else
                     array_push($transferData,array($item->id,5, $item->debit, $item->name,$transferto[0]->name,$item->StartDate));
                    }
                 }
              
         //  }
           usort($reciveds, function($a, $b) {
            return strtotime($a[6]) - strtotime($b[6]);
           });
           
           for($i=0;$i<count($reciveds);$i++)
           {
               if($i==0)
               {
                   $reciveds[$i][4]=$reciveds[$i][4];
               }
               else
               {
                    $reciveds[$i][4]=$reciveds[$i-1][4]+$reciveds[$i][4];
                  
               }
           }
           $menus=Menu::all();
           return view("admin.varAssets.show",compact("var_asset","reciveds","transferData","menuid","menus"));
                  
    }
    public function add($menuid)
    {
      $menus=Menu::all();
      $statement = DB::select("show table status like 'var_assets'");
      $next_id=$statement[0]->Auto_increment;
      return view('admin.varAssets.add',compact('menus','menuid','next_id'));
    }
    public function addtransfer($id,$menuid)
    {
        $menus=Menu::all();
        $statement = DB::select("show table status like 'var_assets'");
       $var_assets=VarAssets::all();    $varAsset=VarAssets::whereId($id)->first();
        $total_debit=0;$totalSelectedSafe=0;
        foreach($var_assets as $item)
        {
            
            $total_credit_giving = GivingPermissions::where('var_asset_id', $item->id)->sum('money');
            $total_debit_revieving = ReceivingPermissions::where('var_asset_id', $item->id)->sum('money');
            $total_debit_transaction = MoneyTransaction::where("type", 1)->where("account_id", $item->id)->sum('debit');
            $total_credit_transaction = MoneyTransaction::where("type", 1)->where("account_id", $item->id)->sum('credit');
            $total_debit_transaction_convert=MoneyTransaction::where("type",9)->where("account_id",$item->id)->sum('debit');
            $total_credit_transaction_convert=MoneyTransaction::where("type",9)->where("account_id",$item->id)->sum('credit');
       
            $item->sum=($total_debit_revieving+$total_debit_transaction+ $total_credit_transaction_convert)-($total_credit_giving+$total_credit_transaction+$total_debit_transaction_convert);
            $total_debit += $item->sum;
             if($item->id==$varAsset->id)
            {
                $totalSelectedSafe +=$item->sum;
            }

          
        }
        return view('admin.varAssets.TreasuryTransfer',compact('menus','totalSelectedSafe','total_debit','varAsset','menuid','var_assets'));
    }
    public function transfer(Request $request)
    {
        $statement = DB::select("show table status like 'transactions'");
        $next_id=$statement[0]->Auto_increment;
        $transaction=new Transaction;
        $transaction->id= $next_id;
        $transaction->StartDate=$request->start_date;
        $transaction->description=$request->notes;
        $transaction->save();
                $money_transaction=new MoneyTransaction;              
                $money_transaction->type=9;
                $money_transaction->account_id=$request->varasset_from;
                $money_transaction->debit=$request->money_from;
                $money_transaction->credit=0;
                $money_transaction->transaction_id=$transaction->id;
                $money_transaction->save();
                $money_transaction1=new MoneyTransaction; 
                $money_transaction1->type=9;
                $money_transaction1->account_id=$request->varasset_to;
                $money_transaction1->debit=0;
                $money_transaction1->credit=$request->money_from;
                $money_transaction1->transaction_id=$transaction->id;
                $money_transaction1->save();
                $menus=Menu::all();
                $var_asset=VarAssets::find($request->varasset_from); 
                $menuid=$request->menuid;
                return redirect('var_assets/show/'.$request->varasset_from.'/'.$request->menuid);    
            
             //   return view("admin.varAssets.show",compact("var_asset","menus","menuid"));
             
    }
    public function addbank($menuid)
    {
        $menus=Menu::all();
        $statement = DB::select("show table status like 'var_assets'");
        $next_id=$statement[0]->Auto_increment;

        return view('admin.varAssets.addbank',compact('menus','menuid','next_id'));
    }

    public function store(Request $request)
    {
        $this->validate(
            $request, 
            ['id'=>'required|unique:var_assets'],
            ['id.unique' => 'هذا الكود موجود من قبل']
        );
        $varAsset=new VarAssets;
        $statement = VarAssets::all();
        $next_id = count($statement)+1;
        $code = "1250000";
        $varAsset->AccountCode=(int)$code+$next_id;
        $varAsset->name=$request->name;
        $varAsset->id=$request->id;
     //   $varAsset->parent_id=$request->parent_id;
        $varAsset->type=0;//for safe
        $varAsset->save();
        return redirect('var_assets/'.$request->menuid);    

    }
    public function storebank(Request $request)
    {
        $this->validate(
            $request,
            ['id'=>'required|unique:var_assets'],
            ['id.unique' => 'هذا الكود موجود من قبل']
        );
        $varAsset=new VarAssets;
        $statement = VarAssets::all();
        $next_id = count($statement)+1;
        $code = "1250000";
        $varAsset->AccountCode=(int)$code+$next_id;
        $varAsset->name=$request->name;
        $varAsset->id=$request->id;
       // $varAsset->parent_id=$request->parent_id;
        $varAsset->type=1;//for bank account
        $varAsset->	AccountNo=$request->AccountNo;
        $varAsset->save();
        return redirect('var_assets/'.$request->menuid);

    }

    public function update($id,$menuid)
    {
       $menus=Menu::all();
       $varAsset=VarAssets::whereId($id)->first();
       $varAssets=VarAssets::all();
       return view('admin.varAssets.edit',compact('varAsset','varAssets','menus','menuid'));

    }

    public function edit(Request $request)
    {
         $this->validate(
            $request, 
            ['id'=>'required|unique:var_assets,id,'.$request->varAssetid],
            ['id.unique' => 'هذا الكود موجود من قبل']
        );
        $varAsset=VarAssets::whereId($request->varAssetid)->first();
        $varAsset->name=$request->name;
        $varAsset->id=$request->id;
       // $varAsset->parent_id=$request->parent_id;
        $varAsset->type=$request->type;
        $varAsset->save();
        return redirect('var_assets/'.$request->menuid);    
        
    }
    public function destory($id,$menuid)
    {
        $varassetdeleted=VarAssets::whereId($id)->first();
        $deleted=VarAssets::whereId($id)->first()->delete();
     
        return redirect('var_assets/'.$menuid);  
    }
}
