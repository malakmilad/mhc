<?php

namespace App\Http\Controllers;
use App\store_movement;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Menu;
use DB;
use App\Category;
use App\Brand;
use App\Client;
use App\Machine;
use App\Store;
use App\Unit;
use App\historyPrice;
use App\Purchase;
use App\Asses;
use App\Convert;
use App\ReturnMachine;
use App\Returns;
use App\Order;
use App\ClientCar;
use App\Company;
use App\User;
use App\Information;
use App\WorkAsses;
use App\IncWorkAsses;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class ProductController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index($id, Request $request)
    {
        $menus = Menu::orderBy('order_menu')->get();
        $products = Product::all();
        $data = $request->all();
        foreach ($products as $product) {
            $machines = Machine::where("productid", $product->id)->get();
            $total_quantity = 0;
            $myunit = Unit::where('id', $product->unitid)->get();
            if (isset($myunit[0])) {
                if ($myunit[0]->unit_id == 0) {
                    //    $myunit=Unit::where('id',$product->unitid)->get();
                    $product->unit_name = $myunit[0]->name;
                }
                else {
                    $myunit1 = Unit::where('id', $myunit[0]->unit_id)->get();

                    $product->unit_name = $myunit1[0]->name;
                }
            }

            foreach ($machines as $machine) {
                $total_quantity += $machine->initial_quantity + $machine->quantity;

            }
            $product->total_quantity = $total_quantity;

            if ($product->min > $total_quantity) {
                $product->class_text = "text-danger";
            }
            else {
                $product->class_text = "table-row";
            }

        }
        return view('admin.products.index', compact('products', 'menus', 'id'));
    }
    public function search($id, Request $request)
    {
        $products = Product::where('created_at', '>=', $request->date_from . ' 00:00:00')->where('created_at', '<=', $request->date_to . ' 00:00:00')->get();
        foreach ($products as $product) {
            $machines = Machine::where("productid", $product->id)->get();
            $total_quantity = 0;
            foreach ($machines as $machine) {
                $total_quantity += $machine->initial_quantity + $machine->quantity;

            }
            $product->total_quantity = $total_quantity;
            if ($product->min > $total_quantity) {
                $product->class_text = "text-danger";
            }
            else {
                $product->class_text = "table-row";
            }
        }
        $menus = Menu::orderBy('order_menu')->get();
        $date_from = $request->date_from;
        $date_to = $request->date_to;
        return view('admin.products.index', compact('products', 'menus', 'id', 'date_from', 'date_to'));
        ;
    }

    public function add($menuid, Request $request)
    { // $data = $request->all();
        $menus = Menu::orderBy('order_menu')->get();
        $statement = DB::select("show table status like 'products'");
        $next_id = $statement[0]->Auto_increment;
        $categories = Category::all();
        $brands = Brand::all();
        $suppliers = Client::where('type', 2)->get();
        $stores = Store::all();
        $units = Unit::all();
        $statement = DB::select("show table status like 'machines'");
        $next_machine = $statement[0]->Auto_increment;
        $info = Information::first(); //$viewmaster=false;
        $products = Product::all(); //$menuid=$request->menuid;
//$sku=$request->sku;
//$productname=$request->productname;
        return view('admin.products.add', compact('menus', 'menuid', 'products', 'next_id', 'categories', 'brands', 'suppliers', 'stores', 'units', 'next_machine', 'info')); //,'sku','productname'));//,'viewmaster'));
    }

    public function store(Request $request)
    {
        //  $name1=$request->name.$request->brand_id;

        $this->validate(
            $request,
        //  ['id'=>'required|unique:products','sku'=>'required|unique:products','name.*.brand_id'=>'required|unique:products,name,'.$request->input('name').',brand_id,'.$request->input('brand_id')],
        // ['id'=>'required|unique:products','sku'=>'required|unique:products','name.brand_id'=>'required|unique:products,name,'.$request->name.',brand_id,'.$request->brand_id],
        ['id' => 'required|unique:products,id', 'sku' => 'required|unique:products', 'name' => 'required|unique:products'],

        //  ['id'=>'required|unique:products','sku'=>'required|unique:products','name'=>'required|unique:products,name,brand_id'],
        ['id.unique' => 'هذا الكود موجود من قبل', 'sku.unique' => 'هذا الرقم التعريفي موجود من قبل', 'name.unique' => 'هذا الاسم  موجود من قبل']
        );

        /*   $messages=   ['name.brand_id.unique'=>'هذا الاسم والماركة موجود من قبل'];
         Validator::make($request, ['name.brand_id'=>['required', Rule::unique('products')
         ->where(function ($query) use ($request){return $query ->where('name',$request->name)
         ->where('brand_id',$request->brand_id);}),],],
         $messages);*/

        $product = new Product;
        $product->name = $request->name;
        $product->model = $request->model;
        $product->type = $request->type;
        $product->supplierid = $request->supplierid;
        $product->brand_id = $request->brand_id;
        $product->purchasing_price = $request->purchasing_price;
        $product->selling_price = $request->selling_price;
        $product->unitid = $request->unitid;
        $product->id = $request->id;
        $product->min = $request->min;
        $product->max = $request->max;
        if (isset($request->year_model)) {
            $product->year_model = $request->year_model;
        }
        if (isset($request->year_prod)) {
            $product->year_prod = $request->year_prod;
        }
        $product->sku = $request->sku;
        $product->save();
        $history_price = new historyPrice;
        $history_price->productid = $product->id;
        $history_price->purchasing_price = $request->purchasing_price;
        $history_price->user_id = auth()->user()->id;
        $history_price->save();

        $history_price = new historyPrice;
        $history_price->productid = $product->id;
        $history_price->selling_price = $request->selling_price;
        $history_price->user_id = auth()->user()->id;
        $history_price->save();

        if (isset($request->store)) {
            $machine = new Machine;
            $machine->productid = $product->id;
            $machine->id = $request->machineid;
            $myunit = Unit::find($request->unitid);


            if ($myunit->unit_id == 0) {
                $multiple = 1;
            }
            else {
                $multiple = $myunit->amount;
            }
            $machine->initial_quantity = $request->initial_quantity * $multiple;
            $machine->storeid = $request->storeid;
            $machine->save();
        }
        return redirect('products/' . $request->menuid);

    }

    public function update($id, $menuid)
    {
        $menus = Menu::orderBy('order_menu')->get();
        $product = Product::whereId($id)->first();
        $categories = Category::all();
        $brands = Brand::all();
        $suppliers = Client::where('type', 2)->get();
        $units = Unit::all();
        $info = Information::first();
        $stores = Store::all();
        return view('admin.products.edit', compact('product', 'stores', 'menus', 'menuid', 'categories', 'brands', 'suppliers', 'units', 'info'));

    }

    public function edit(Request $request)
    {
        $this->validate(
            $request,
        ['id' => 'required|unique:products,id,' . $request->productid, 'sku' => 'required|unique:products,sku,' . $request->productid],
        ['id.unique' => 'هذا الكود موجود من قبل', 'sku.unique' => 'هذا الرقم التعريفي موجود من قبل']
        );
        $product = Product::whereId($request->productid)->first();
        if ($product->purchasing_price != $request->purchasing_price) {
            $history_price = new historyPrice;
            $history_price->productid = $product->id;
            $history_price->purchasing_price = $request->purchasing_price;
            $history_price->user_id = auth()->user()->id;
            $history_price->save();
        }
        if ($product->selling_price != $request->selling_price) {
            $history_price = new historyPrice;
            $history_price->productid = $product->id;
            $history_price->selling_price = $request->selling_price;
            $history_price->user_id = auth()->user()->id;
            $history_price->save();
        }
        $product->name = $request->name;
        $product->model = $request->model;
        $product->type = $request->type;
        $product->supplierid = $request->supplierid;
        $product->brand_id = $request->brand_id;
        $product->unitid = $request->unitid;
        $product->purchasing_price = $request->purchasing_price;
        $product->selling_price = $request->selling_price;
        $product->id = $request->id;
        $product->min = $request->min;
        $product->max = $request->max;
        if (isset($request->year_model)) {
            $product->year_model = $request->year_model;
        }
        if (isset($request->year_prod)) {
            $product->year_model = $request->year_prod;
        }
        $product->sku = $request->sku;
        $product->save();


        return redirect('products/' . $request->menuid);

    }
    public function destory($id, $menuid)
    {
        $deleted = Product::whereId($id)->first()->delete();
        return redirect('products/' . $menuid);
    }
    public function details($id, $menuid)
    {
        /*   $details=array();//id //amount //amount after  //operation // type(ingoing or outgoing)
         $product=Product::find($id);
         $products=Machine::where("productid",$id)->get();
         foreach($products as $item)
         {
         $details[]=array($item->id,$item->initial_quantity,$item->initial_quantity,"كميه ابتدائيه في ".$item->store->name,1,$item->created_at);
         }
         $products=Purchase::select("purchases.*")->join('order_purchs', 'order_purchs.id', '=', 'purchases.unique_col')->where("added",1)->where("machineid",$id)->get();
         foreach($products as $item)
         {
         $details[]=array($item->id,$item->quantity,$item->quantity,"فاتورة مشتريات",1,$item->created_at);
         }
         $products=Asses::select("asses.*")->join('orders', 'orders.id', '=', 'asses.orderid')->where("dismissal_notice",1)->where("machineid",$id)->get();
         foreach($products as $item)
         {
         $details[]=array($item->id,$item->quantity,-$item->quantity,"فاتورة مبيعات",2,$item->created_at);
         }
         $products=WorkAsses::select("work_asses.*")->join('work_orders', 'work_orders.id', '=', 'work_asses.orderid')->where("dismissal_notice",1)->where("machineid",$id)->get();
         foreach($products as $item)
         {
         $details[]=array($item->id,$item->quantity,-$item->quantity,"أمر شغل",2,$item->created_at);
         }
         $products=IncWorkAsses::select("inc_work_asses.*")->join('inc_work_orders', 'inc_work_orders.id', '=', 'inc_work_asses.orderid')
         ->join('work_orders', 'work_orders.id', '=', 'inc_work_orders.work_order_id')->where("work_orders.dismissal_notice",1)->where("machineid",$id)->get();
         foreach($products as $item)
         {
         $details[]=array($item->id,$item->quantity,-$item->quantity,"مقايسه أمر شغل",2,$item->created_at);
         }
         $products=Convert::where("productid",$id)->get();
         foreach($products as $item)
         {
         $details[]=array($item->id,$item->quantity,0," نقل من  ".$item->transfer->from_store->name." ل ". $item->transfer->to_store->name,3,$item->created_at);
         }
         $products=ReturnMachine::join('returns', 'returns.id', '=', 'machines_returns.return_id')->join('asses', 'machines_returns.asses_id', '=', 'asses.id')
         ->select("machines_returns.*")->where('returns.type', 1)->where("agree",1)->where("asses.machineid",$id)->get();
         foreach($products as $item)
         {
         $details[]=array($item->id,$item->quantity,$item->quantity,"مرتجعات العملاء",1,$item->created_at);
         }
         $products=ReturnMachine::join('returns', 'returns.id', '=', 'machines_returns.return_id')->join('purchases', 'machines_returns.asses_id', '=', 'purchases.id')
         ->select("machines_returns.*")->where('returns.type', 2)->where("agree",1)->where("purchases.machineid",$id)->get();
         foreach($products as $item)
         {
         $details[]=array($item->id,$item->quantity,-$item->quantity,"مرتجعات للموردين",2,$item->created_at);
         }
         usort($details, function($a, $b) {
         return strtotime($a[5]) - strtotime($b[5]);
         });
         for($i=0;$i<count($details);$i++)
         {
         if($i==0)
         {
         $details[$i][2]=$details[$i][1];
         }
         else
         {
         $details[$i][2]=$details[$i-1][2]+$details[$i][2];
         }
         }*/
        $details = array(); //id //amount //amount after  //operation // type(ingoing or outgoing)
        $product = Product::find($id);
        $products = Machine::select("machines.*", "units.name as name", "units.id as unit", "units.unit_id as unitid")->join('products', 'products.id', '=', 'machines.productid')
            ->join('units', 'units.id', '=', 'products.unitid')->where("productid", $id)->get();
        foreach ($products as $item) {
            $myunit = Unit::find($item->unit);
            if (isset($myunit)) {
                if ($myunit->unit_id == 0) {
                    $unit_name = $myunit->name;
                }
                else {
                    $myunit1 = Unit::find($myunit->unit_id);

                    $unit_name = $myunit1->name;
                }

                $details[] = array($item->id, $item->initial_quantity, $unit_name, $item->initial_quantity, "كميه ابتدائيه في " . $item->store->name, 1, $item->created_at);
            }
            else
                $details[] = array($item->id, $item->initial_quantity, "", $item->initial_quantity, "كميه ابتدائيه في " . $item->store->name, 1, $item->created_at);

        }
        $products = Purchase::select("purchases.*", "units.name as name")
        ->join('order_purchs', 'order_purchs.id', '=', 'purchases.unique_col')
        ->join('units', 'units.id', '=', 'purchases.unit')->where("added", 1)->where("machineid", $id)->get();
        foreach ($products as $item) {
            $myunit = Unit::find($item->unit);


            if ($myunit->unit_id == 0) {
                $multiple = 1;
            }
            else {
                $multiple = $myunit->amount;
            }
            $details[] = array($item->id, $item->quantity, $item->name, $item->quantity * $multiple, "فاتورة مشتريات", 1, $item->created_at);
        }
        $products = Asses::select("asses.*", "units.name as name")->join('orders', 'orders.id', '=', 'asses.orderid')->join('units', 'units.id', '=', 'asses.unit')->where("dismissal_notice", 1)->where("machineid", $id)->get();
        foreach ($products as $item) {
            $myunit = Unit::find($item->unit);


            if ($myunit->unit_id == 0) {
                $multiple = 1;
            }
            else {
                $multiple = $myunit->amount;
            }
            $details[] = array($item->id, $item->quantity, $item->name, -$item->quantity * $multiple, "فاتورة مبيعات", 2, $item->created_at);
        }
        $products = WorkAsses::select("work_asses.*", "units.name as name")->join('work_orders', 'work_orders.id', '=', 'work_asses.orderid')->join('units', 'units.id', '=', 'work_asses.unit')->where("dismissal_notice", 1)->where("machineid", $id)->get();
        foreach ($products as $item) {
            $myunit = Unit::find($item->unit);


            if ($myunit->unit_id == 0) {
                $multiple = 1;
            }
            else {
                $multiple = $myunit->amount;
            }
            $details[] = array($item->id, $item->quantity, $item->name, -$item->quantity * $multiple, "أمر شغل", 2, $item->created_at);
        }

        $products = IncWorkAsses::select("inc_work_asses.*", "units.name as name")->join('inc_work_orders', 'inc_work_orders.id', '=', 'inc_work_asses.orderid')
            ->join('work_orders', 'work_orders.id', '=', 'inc_work_orders.work_order_id')->join('units', 'units.id', '=', 'inc_work_asses.unit')->where("work_orders.dismissal_notice", 1)->where("machineid", $id)->get();
        foreach ($products as $item) {
            $myunit = Unit::find($item->unit);


            if ($myunit->unit_id == 0) {
                $multiple = 1;
            }
            else {
                $multiple = $myunit->amount;
            }
            $details[] = array($item->id, $item->quantity, $item->name, -$item->quantity * $multiple, "مقايسه أمر شغل", 2, $item->created_at);
        }

        $products = Convert::where("productid", $id)->get();
        foreach ($products as $item) {
            if ($item->transfer->from_store_id == $storeid || $item->transfer->to_store_id == $storeid) {
                $details[] = array($item->id, $item->quantity, "wait", 0, " نقل من  " . $item->transfer->from_store->name . " ل " . $item->transfer->to_store->name, 3, $item->created_at);
            }
        }
        $products = ReturnMachine::join('returns', 'returns.id', '=', 'machines_returns.return_id')->join('asses', 'machines_returns.asses_id', '=', 'asses.id')
            ->join('orders', 'orders.id', '=', 'returns.billing_id')->join('units', 'units.id', '=', 'asses.unit')->select("machines_returns.*", "units.name as name")->where('returns.type', 1)->where("agree", 1)->where("asses.machineid", $id)->get();
        foreach ($products as $item) {
            $myunit = Unit::find($item->unit);


            if ($myunit->unit_id == 0) {
                $multiple = 1;
            }
            else {
                $multiple = $myunit->amount;
            }
            $details[] = array($item->id, $item->quantity, $item->name, $item->quantity * $multiple, "مرتجعات العملاء", 1, $item->created_at);

        }
        $products = ReturnMachine::join('returns', 'returns.id', '=', 'machines_returns.return_id')->join('purchases', 'machines_returns.asses_id', '=', 'purchases.id')
            ->join('order_purchs', 'order_purchs.id', '=', 'returns.billing_id')->join('units', 'units.id', '=', 'purchases.unit')->select("machines_returns.*", "units.name as name")->where('returns.type', 2)->where("agree", 1)->where("purchases.machineid", $id)->get();
        foreach ($products as $item) {
            $myunit = Unit::find($item->unit);


            if ($myunit->unit_id == 0) {
                $multiple = 1;
            }
            else {
                $multiple = $myunit->amount;
            }
            $details[] = array($item->id, $item->quantity, $item->name, -$item->quantity * $multiple, "مرتجعات للموردين", 2, $item->created_at);

        }
        //add to store
        $product = Product::find($id);
        $products = store_movement::select("store_movements.*", "store_movements_products.*", "units.name as name", "units.id as unit", "units.unit_id as unitid")
            ->join('store_movements_products', 'store_movements_products.store_movement_id', '=', 'store_movements.id')

            ->join('products', 'products.id', '=', 'store_movements_products.product_id')
            ->join('units', 'units.id', '=', 'products.unitid')->where("store_movements_products.product_id", $id)->get();
        foreach ($products as $item) {
            $myunit = Unit::find($item->unit);
            if (isset($myunit)) {
                if ($myunit->unit_id == 0) {
                    $unit_name = $myunit->name;
                }
                else {
                    $myunit1 = Unit::find($myunit->unit_id);
                    $unit_name = $myunit1->name;
                }
                if ($item->permission_type == 0)
                    $details[] = array($item->id, $item->quantity, $unit_name, $item->quantity, "اذن اضافة يدوى فى  " . $item->store->name, 1, $item->created_at);
                else
                    $details[] = array($item->id, $item->quantity, $unit_name, -$item->quantity, "اذن صرف يدوى فى  " . $item->store->name, 2, $item->created_at);

            }
            else {
                if ($item->permission_type == 0)
                    $details[] = array($item->id, $item->quantity, "", $item->quantity, "اذن اضافة يدوى فى " . $item->store->name, 1, $item->created_at);
                else
                    $details[] = array($item->id, $item->quantity, "", -$item->quantity, "اذن صرف يدوى فى  " . $item->store->name, 2, $item->created_at);

            }

        }
        usort($details, function ($a, $b) {
            return strtotime($a[5]) - strtotime($b[5]);
        });
        for ($i = 0; $i < count($details); $i++) {
            if ($i == 0) {
                $details[$i][3] = $details[$i][1];
            }
            else {
                $details[$i][3] = $details[$i - 1][3] + $details[$i][3];

            }
        }
        $menus = Menu::orderBy('order_menu')->get();
        return view("admin.products.details", compact("details", "product", "menuid", "menus"));


    }
    public function store_product_details($storeid, $id, $menuid)
    {
        $details = array(); //id //amount //amount after  //operation // type(ingoing or outgoing)
        $product = Product::find($id);
        $products = Machine::select("machines.*", "units.name as name", "units.id as unit", "units.unit_id as unitid")->join('products', 'products.id', '=', 'machines.productid')
            ->join('units', 'units.id', '=', 'products.unitid')->where("productid", $id)->where("storeid", $storeid)->get();
        foreach ($products as $item) {
            //  $myunit=Unit::where('id',$item->unitid)->get();

            $myunit = Unit::find($item->unit);
            if (isset($myunit)) {
                if ($myunit->unit_id == 0) {
                    $unit_name = $myunit->name;
                }
                else {
                    $myunit1 = Unit::find($myunit->unit_id);

                    $unit_name = $myunit1->name;
                }
                $details[] = array($item->id, $item->initial_quantity, $unit_name, $item->initial_quantity, "كميه ابتدائيه في " . $item->store->name, 1, $item->created_at);
            }
            else
                $details[] = array($item->id, $item->initial_quantity, "", $item->initial_quantity, "كميه ابتدائيه في " . $item->store->name, 1, $item->created_at);

        }
        $products = Purchase::select("purchases.*", "units.name as name")->join('order_purchs', 'order_purchs.id', '=', 'purchases.unique_col')->join('units', 'units.id', '=', 'purchases.unit')->where("store_id", $storeid)->where("added", 1)->where("machineid", $id)->get();
        foreach ($products as $item) {
            $myunit = Unit::find($item->unit);


            if ($myunit->unit_id == 0) {
                $multiple = 1;
            }
            else {
                $multiple = $myunit->amount;
            }
            $details[] = array($item->id, $item->quantity, $item->name, $item->quantity * $multiple, "فاتورة مشتريات", 1, $item->created_at);
        }
        $products = Asses::select("asses.*", "units.name as name")->join('orders', 'orders.id', '=', 'asses.orderid')->join('units', 'units.id', '=', 'asses.unit')->where("storeid", $storeid)->where("dismissal_notice", 1)->where("machineid", $id)->get();
        foreach ($products as $item) {
            $myunit = Unit::find($item->unit);


            if ($myunit->unit_id == 0) {
                $multiple = 1;
            }
            else {
                $multiple = $myunit->amount;
            }
            $details[] = array($item->id, $item->quantity, $item->name, -$item->quantity * $multiple, "فاتورة مبيعات", 2, $item->created_at);
        }
        $products = WorkAsses::select("work_asses.*", "units.name as name")->join('work_orders', 'work_orders.id', '=', 'work_asses.orderid')->join('units', 'units.id', '=', 'work_asses.unit')->where("work_orders.storeid", $storeid)->where("dismissal_notice", 1)->where("machineid", $id)->get();
        foreach ($products as $item) {
            $myunit = Unit::find($item->unit);


            if ($myunit->unit_id == 0) {
                $multiple = 1;
            }
            else {
                $multiple = $myunit->amount;
            }
            $details[] = array($item->id, $item->quantity, $item->name, -$item->quantity * $multiple, "أمر شغل", 2, $item->created_at);
        }

        $products = IncWorkAsses::select("inc_work_asses.*", "units.name as name")->join('inc_work_orders', 'inc_work_orders.id', '=', 'inc_work_asses.orderid')
            ->join('work_orders', 'work_orders.id', '=', 'inc_work_orders.work_order_id')->join('units', 'units.id', '=', 'inc_work_asses.unit')->where("work_orders.storeid", $storeid)->where("work_orders.dismissal_notice", 1)->where("machineid", $id)->get();
        foreach ($products as $item) {
            $myunit = Unit::find($item->unit);


            if ($myunit->unit_id == 0) {
                $multiple = 1;
            }
            else {
                $multiple = $myunit->amount;
            }
            $details[] = array($item->id, $item->quantity, $item->name, -$item->quantity * $multiple, "مقايسه أمر شغل", 2, $item->created_at);
        }

        $products = Convert::where("productid", $id)->get();
        foreach ($products as $item) {
            if ($item->transfer->from_store_id == $storeid || $item->transfer->to_store_id == $storeid) {
                $details[] = array($item->id, $item->quantity, "wait", 0, " نقل من  " . $item->transfer->from_store->name . " ل " . $item->transfer->to_store->name, 3, $item->created_at);
            }
        }
        $products = ReturnMachine::join('returns', 'returns.id', '=', 'machines_returns.return_id')->join('asses', 'machines_returns.asses_id', '=', 'asses.id')
            ->join('orders', 'orders.id', '=', 'returns.billing_id')->join('units', 'units.id', '=', 'asses.unit')->select("machines_returns.*", "units.name as name")->where('orders.storeid', $storeid)->where('returns.type', 1)->where("agree", 1)->where("asses.machineid", $id)->get();
        foreach ($products as $item) {
            $myunit = Unit::find($item->unit);


            if ($myunit->unit_id == 0) {
                $multiple = 1;
            }
            else {
                $multiple = $myunit->amount;
            }
            $details[] = array($item->id, $item->quantity, $item->name, $item->quantity * $multiple, "مرتجعات العملاء", 1, $item->created_at);

        }
        $products = ReturnMachine::join('returns', 'returns.id', '=', 'machines_returns.return_id')->join('purchases', 'machines_returns.asses_id', '=', 'purchases.id')
            ->join('order_purchs', 'order_purchs.id', '=', 'returns.billing_id')->join('units', 'units.id', '=', 'purchases.unit')->select("machines_returns.*", "units.name as name")->where('order_purchs.store_id', $storeid)->where('returns.type', 2)->where("agree", 1)->where("purchases.machineid", $id)->get();
        foreach ($products as $item) {
            $myunit = Unit::find($item->unit);


            if ($myunit->unit_id == 0) {
                $multiple = 1;
            }
            else {
                $multiple = $myunit->amount;
            }
            $details[] = array($item->id, $item->quantity, $item->name, -$item->quantity * $multiple, "مرتجعات للموردين", 2, $item->created_at);

        }
        //add to store
        $product = Product::find($id);
        $products = store_movement::select("store_movements.*", "store_movements_products.*", "units.name as name", "units.id as unit", "units.unit_id as unitid")
            ->join('store_movements_products', 'store_movements_products.store_movement_id', '=', 'store_movements.id')

            ->join('products', 'products.id', '=', 'store_movements_products.product_id')
            ->join('units', 'units.id', '=', 'products.unitid')->where("store_movements_products.product_id", $id)->get();
        foreach ($products as $item) {
            $myunit = Unit::find($item->unit);
            if (isset($myunit)) {
                if ($myunit->unit_id == 0) {
                    $unit_name = $myunit->name;
                }
                else {
                    $myunit1 = Unit::find($myunit->unit_id);

                    $unit_name = $myunit1->name;
                }
                if ($item->permission_type == 0)
                    $details[] = array($item->id, $item->quantity, $unit_name, $item->quantity, "اذن اضافة يدوى فى  " . $item->store->name, 1, $item->created_at);
                else
                    $details[] = array($item->id, $item->quantity, $unit_name, -$item->quantity, "اذن صرف يدوى فى  " . $item->store->name, 2, $item->created_at);

            }
            else {
                if ($item->permission_type == 0)
                    $details[] = array($item->id, $item->quantity, "", $item->quantity, "اذن اضافة يدوى فى " . $item->store->name, 1, $item->created_at);
                else
                    $details[] = array($item->id, $item->quantity, "", -$item->quantity, "اذن صرف يدوى فى  " . $item->store->name, 2, $item->created_at);

            }

        }
        usort($details, function ($a, $b) {
            return strtotime($a[5]) - strtotime($b[5]);
        });
        for ($i = 0; $i < count($details); $i++) {
            if ($i == 0) {
                $details[$i][3] = $details[$i][1];
            }
            else {
                $details[$i][3] = $details[$i - 1][3] + $details[$i][3];

            }
        }
        $menus = Menu::orderBy('order_menu')->get();
        return view("admin.products.details", compact("details", "product", "menuid", "menus"));


    }
    public function report($id)
    {
        $products = Product::all();
        $orders = Order::where("dismissal_notice", 1)->get();
        foreach ($products as $product) {
            $product->items = Asses::select('asses.*', 'orders.created_by as employee', 'orders.addition_value as order_addition', 'orders.clientcar_id', 'orders.companyid')
                ->join('orders', 'orders.id', '=', 'asses.orderid')->where("dismissal_notice", 1)->where("machineid", $product->id)->get();
            foreach ($product->items as $item) {
                $created_by = User::find($item->employee);
                $item->employee = $created_by->name;
                if ($item->companyid != 0) {
                    $user = Company::find($item->companyid);
                }
                else {
                    $user = ClientCar::find($item->clientcar_id)->client;
                }
                $item->user_name = $user->name;
            }

        }

        $companies = Company::all();

        $clients = Client::where("type", "!=", 2)->get();
        $accounts = array();
        foreach ($clients as $account) {
            array_push($accounts, array("id" => "1," . $account->id, "name" => " العملاء / " . $account->name));
        }

        foreach ($companies as $account) {
            array_push($accounts, array("id" => "3," . $account->id, "name" => " شركات التأمين / " . $account->name));
        }
        $users = User::all();
        $menus = Menu::orderBy('order_menu')->get();
        $stores = Store::all();
        $orders = Order::where("dismissal_notice", 1)->get();
        return view('admin.products.report', compact('products', 'menus', 'id', 'users', 'accounts', 'stores', 'orders'));


    }
    public function filter_report($id, Request $request)
    {
        $conditions = array();
        $filter = array();
        $conditions[] = ["dismissal_notice", "=", 1];
        if (isset($request->date_from) && isset($request->date_to)) {
            $conditions[] = ['orders.created_at', '>=', $request->date_from . ' 00:00:00'];
            $conditions[] = ['orders.created_at', '<=', $request->date_to . ' 00:00:00'];
            $filter['date_from'] = $request->date_from;
            $filter['date_to'] = $request->date_to;
        }
        if (isset($request->employee) && $request->employee != 0) {
            $conditions[] = ['orders.created_by', '=', $request->employee];
            $filter['employee'] = $request->employee;
        }
        if (isset($request->store) && $request->store != 0) {
            $conditions[] = ['orders.storeid', '=', $request->store];
            $filter['store'] = $request->store;
        }
        if (isset($request->bill) && $request->bill != 0) {
            $conditions[] = ['orders.id', '=', $request->bill];
            $filter['bill'] = $request->bill;
        }

        if (isset($request->account) && $request->account != 0) {
            $account_array = explode(",", $request->account);
            $type = $account_array[0];
            $accountid = $account_array[1];
            if ($type == 1) {
                $conditions[] = ["client_cars.clientid", '=', $accountid];
                $filter['account'] = "1," . $accountid;

            }
            elseif ($type == 3) {
                $conditions[] = ["orders.companyid", '=', $accountid];
                $filter['account'] = "3," . $accountid;
            }
        }
        $products = Product::all();
        foreach ($products as $product) {
            $conditions[] = ["machineid", "=", $product->id];
            $product->items = Asses::select('asses.*', 'orders.created_by as employee', 'orders.addition_value as order_addition', 'orders.clientcar_id', 'orders.companyid')
                ->join('orders', 'orders.id', '=', 'asses.orderid')->join('client_cars', 'client_cars.id', '=', 'orders.clientcar_id')->where($conditions)->get();
            foreach ($product->items as $item) {
                $created_by = User::find($item->employee);
                $item->employee = $created_by->name;
                if ($item->companyid != 0) {
                    $user = Company::find($item->companyid);
                }
                else {
                    $user = ClientCar::find($item->clientcar_id)->client;
                }
                $item->user_name = $user->name;
            }

        }

        $companies = Company::all();

        $clients = Client::where("type", "!=", 2)->get();
        $accounts = array();
        foreach ($clients as $account) {
            array_push($accounts, array("id" => "1," . $account->id, "name" => " العملاء / " . $account->name));
        }

        foreach ($companies as $account) {
            array_push($accounts, array("id" => "3," . $account->id, "name" => " شركات التأمين / " . $account->name));
        }
        $users = User::all();
        $menus = Menu::orderBy('order_menu')->get();
        $stores = Store::all();
        $orders = Order::where("dismissal_notice", 1)->get();
        return view('admin.products.report', compact('products', 'menus', 'id', 'users', 'accounts', 'filter', 'stores', 'orders'));


    }
    public function earnings_report($id)
    {
        $products = Product::all();
        $orders = Order::where("dismissal_notice", 1)->get();
        $i = 0;
        $total_profit = 0;
        foreach ($products as $product) {

            //$firstStringCharacter = substr($product->id, i, 1);

            $productId = $product['id'];
            $asses = Asses::select('asses.*')
                ->join('orders', 'orders.id', '=', 'asses.orderid')->where("dismissal_notice", 1)
                ->where('asses.machineid', $product->id)->get();
            if ($asses->count() > 0) {
                //  print_r($product->count);
                //       print_r($product->id);
                //  print_r($firstStringCharacter);
                $quantity = 0;
                $cost = 0;
                foreach ($asses as $item) {
                    $quantity += $item->quantity;
                    //still without deduction and addition value
                    if ($item->deduction_type == 1) {
                        $deduction = $item->deduction;
                    }
                    else {
                        $deduction = (($item->cost / 100) * $item->deduction);
                    }
                    $cost += ($item->cost - $deduction) * $quantity;
                    $cost = $cost + (($cost) / 100) * $item->myorder->addition_value;
                }
                $product->earnings_sales_quantity = $quantity;
                $product->earnings_sales_cost = round($cost, 2);

                $returns = ReturnMachine::rightjoin('returns', 'returns.id', '=', 'machines_returns.return_id')
                    ->join('asses', 'asses.id', '=', 'machines_returns.asses_id')
                    ->select('asses.*', 'machines_returns.quantity as quantity_returned')
                    ->where("returns.agree", 1)->where("asses.machineid", $product->id)->get();

                $quantity = 0;
                $cost = 0;
                foreach ($returns as $item) {
                    $quantity += $item->quantity_returned;
                    //still without deduction and addition value
                    $order = Order::find($item->orderid);

                    if ($item->deduction_type == 1) {
                        $deduction = $item->deduction;
                    }
                    else {
                        $deduction = (($item->cost / 100) * $item->deduction);
                    }
                    $cost += ($item->cost - $deduction) * $quantity;
                    $cost = $cost + (($cost) / 100) * $order->addition_value;

                }
                $product->earnings_returns_quantity = $quantity;
                $product->earnings_returns_cost = $cost;

                $purchases = Purchase::where('purchases.machineid', $product->id)->get();
                //$purchases=Purchase::all();
                $total = 0;
                foreach ($purchases as $item) {
                    if ($item->deduction_type == 1) {
                        $deduction = $item->deduction;
                    }
                    else {
                        $deduction = (($item->price / 100) * $item->deduction);
                    }
                    $total += ($item->price - $deduction);
                    $total = $total + (($total) / 100) * $item->myorder->addition_value;
                }
                if (count($purchases) > 0)
                    $product->total_cost = round(($total / count($purchases)) * $product->earnings_sales_quantity, 2);
                $product->net_sales_quantity = $product->earnings_sales_quantity - $product->earnings_returns_quantity;
                $product->net_sales_cost = round($product->earnings_sales_cost - $product->earnings_returns_cost, 2);
                $product->profit_value = round($product->net_sales_cost - $product->total_cost, 2);
                $product->profit_percentage = 0;
                $total_profit += round($product->profit_value, 2);
                $product->profit_to_sales = round(($product->profit_value / $product->net_sales_cost) * 100, 2);
                if ($product->total_cost > 0)
                    $product->profit_to_cost = round(($product->profit_value / $product->total_cost) * 100, 2);
            }

        }
        $menus = Menu::orderBy('order_menu')->get();

        return view('admin.products.earnings_report', compact('products', 'menus', 'id', 'total_profit'));

    }
    public function filter_earnings_report($id, Request $request)
    {
        $products = Product::all();
        $orders = Order::where("dismissal_notice", 1)->get();
        $total_profit = 0;
        foreach ($products as $product) {
            $asses = Asses::select('asses.*')
                ->join('orders', 'orders.id', '=', 'asses.orderid')->where("dismissal_notice", 1)->where("machineid", $product->id)
                ->where('orders.created_at', '>=', $request->date_from . ' 00:00:00')->where('orders.created_at', '<=', $request->date_to . ' 00:00:00')->get();
            $quantity = 0;
            $cost = 0;
            foreach ($asses as $item) {
                $quantity += $item->quantity;
                //still without deduction and addition value
                if ($item->deduction_type == 1) {
                    $deduction = $item->deduction;
                }
                else {
                    $deduction = (($item->cost / 100) * $item->deduction);
                }
                $cost += ($item->cost - $deduction) * $quantity;
                $cost = $cost + (($cost) / 100) * $item->myorder->addition_value;
            }
            $product->earnings_sales_quantity = $quantity;
            $product->earnings_sales_cost = round($cost, 2);

            $returns = ReturnMachine::join('returns', 'returns.id', '=', 'machines_returns.return_id')
                ->join('asses', 'asses.id', '=', 'machines_returns.asses_id')
                ->select('asses.*', 'machines_returns.quantity as quantity_returned')->where("returns.agree", 1)->where("asses.machineid", $product->id)
                ->where('returns.created_at', '>=', $request->date_from . ' 00:00:00')->where('returns.created_at', '<=', $request->date_to . ' 00:00:00')->get();
            $quantity = 0;
            $cost = 0;
            foreach ($returns as $item) {
                $quantity += $item->quantity_returned;
                //still without deduction and addition value
                $order = Order::find($item->orderid);

                if ($item->deduction_type == 1) {
                    $deduction = $item->deduction;
                }
                else {
                    $deduction = (($item->cost / 100) * $item->deduction);
                }
                $cost += ($item->cost - $deduction) * $quantity;
                $cost = $cost + (($cost) / 100) * $order->addition_value;

            }
            $product->earnings_returns_quantity = $quantity;
            $product->earnings_returns_cost = $cost;

            $purchases = Purchase::where("machineid", $product->id)->get();
            $total = 0;
            foreach ($purchases as $item) {
                if ($item->deduction_type == 1) {
                    $deduction = $item->deduction;
                }
                else {
                    $deduction = (($item->price / 100) * $item->deduction);
                }
                $total += ($item->price - $deduction);
                $total = $total + (($total) / 100) * $item->myorder->addition_value;
            }
            $product->total_cost = round(($total / count($purchases)) * $product->earnings_sales_quantity, 2);
            $product->net_sales_quantity = $product->earnings_sales_quantity - $product->earnings_returns_quantity;
            $product->net_sales_cost = round($product->earnings_sales_cost - $product->earnings_returns_cost, 2);
            $product->profit_value = round($product->net_sales_cost - $product->total_cost, 2);
            $product->profit_percentage = 0;
            $total_profit += round($product->profit_value, 2);
            $product->profit_to_sales = round(($product->profit_value / $product->net_sales_cost) * 100, 2);
            $product->profit_to_cost = round(($product->profit_value / $product->total_cost) * 100, 2);

        }

        $menus = Menu::orderBy('order_menu')->get();
        $filter['date_from'] = $request->date_from;
        $filter['date_to'] = $request->date_to;

        return view('admin.products.earnings_report', compact('products', 'menus', 'id', 'total_profit', 'filter'));

    }
    public function inventory_sheet_report($id)
    {
        $products = Product::all();
        foreach ($products as $item) {
            $unit = Unit::find($item->unitid);
            if ($unit->unit_id != 0)
                $item->unit = Unit::find($unit->unit_id);
        }
        $stores = Store::all();
        $categories = Category::all();
        $brands = Brand::all();
        foreach ($products as $product) {
            $product->quantity = Machine::where('productid', $product->id)
                ->value(DB::raw("SUM(quantity + initial_quantity)"));
        }
        $menus = Menu::orderBy('order_menu')->get();
        return view('admin.products.inventory_sheet_report', compact('products', 'menus', 'id', 'stores', 'brands', 'categories'));

    }
    public function inventory_sheet_report_filter($id, Request $request)
    {

        $conditions = array();
        $filter = array();
        if (isset($request->brand) && $request->brand != 0) {
            $conditions[] = ['brand_id', '=', $request->brand];
            $filter['brand'] = $request->brand;
        }
        if (isset($request->category) && $request->category != 0) {
            $conditions[] = ['type', '=', $request->category];
            $filter['category'] = $request->category;
        }

        $products = Product::where($conditions)->get();
        $stores = Store::all();
        $categories = Category::all();
        $brands = Brand::all();
        foreach ($products as $product) {
            $conditions_store = array();
            $conditions_store[] = ['productid', '=', $product->id];
            if (isset($request->store) && $request->store != 0) {
                $conditions_store[] = ['storeid', '=', $request->store];
                $filter['store'] = $request->store;
            }
            $product->quantity = Machine::where($conditions_store)
                ->value(DB::raw("SUM(quantity + initial_quantity)"));
            if ($product->quantity == NULL) {
                $product->quantity = 0;
            }
        }
        $menus = Menu::orderBy('order_menu')->get();
        return view('admin.products.inventory_sheet_report', compact('products', 'menus', 'id', 'stores', 'brands', 'categories', 'filter'));

    }
    public function product_details_report($menuid)
    {
        $details = array(); //id //ingoing //outgoin //store  //operation // created_at //product_name


        $all_products = Product::all();

        foreach ($all_products as $product_item) {
            $id = $product_item->id;
            $products = Machine::where("productid", $id)->get();
            foreach ($products as $item) {
                $details[] = array($item->id, $item->initial_quantity, 0, $item->store->name, "كمية ابتدائية", $item->created_at, $product_item->name);
            }
            $products = Purchase::where("machineid", $id)->get();
            foreach ($products as $item) {
                $details[] = array($item->id, $item->quantity, 0, $item->myorder->store->name, "أمر شراء", $item->created_at, $product_item->name);
            }
            $products = Asses::where("machineid", $id)->get();
            foreach ($products as $item) {

                $details[] = array($item->id, 0, -$item->quantity, $item->myorder->store->name, "فاتورة", $item->created_at, $product_item->name);
            }
            $products = Convert::where("productid", $id)->get();
            foreach ($products as $item) {
                try {
                    $details[] = array($item->id, $item->quantity, $item->quantity, "----", " نقل من  " . $item->transfer->from_store->name . " ل " . $item->transfer->to_store->name, $item->created_at, $product_item->name);
                }
                catch (\Exception $e) {

                    return $item;
                }
            }
            $products = ReturnMachine::join('returns', 'returns.id', '=', 'machines_returns.return_id')->join('asses', 'machines_returns.asses_id', '=', 'asses.id')
                ->select("machines_returns.*")->where('returns.type', 1)->where("asses.machineid", $id)->get();
            foreach ($products as $item) {
                $Asses = Asses::find($item->asses_id);
                $details[] = array($item->id, $item->quantity, 0, $Asses->myorder->store->name, "Customer Return", $item->created_at, $product_item->name);

            }
            $products = ReturnMachine::join('returns', 'returns.id', '=', 'machines_returns.return_id')->join('purchases', 'machines_returns.asses_id', '=', 'purchases.id')
                ->select("machines_returns.*")->where('returns.type', 2)->where("purchases.machineid", $id)->get();
            foreach ($products as $item) {
                $Asses = Purchase::find($item->asses_id);
                $details[] = array($item->id, 0, -$item->quantity, $Asses->myorder->store->name, "Supllier Return", $item->created_at, $product_item->name);

            }
        }
        usort($details, function ($a, $b) {
            return strtotime($a[5]) - strtotime($b[5]);
        });

        $menus = Menu::orderBy('order_menu')->get();
        $id = $menuid;
        $products = Product::all();
        $stores = Store::all();
        return view('admin.products.product_details_report', compact('details', 'menus', 'id', 'products', 'stores'));

    }
    public function product_details_report_filter($menuid, Request $request)
    {

        $conditions = array();
        $conditions_purchases = array();
        $filter = array();
        $conditions_return_customer = array();
        $conditions_return_supplier = array();

        $conditions_asses = array();
        $conditions_converts = array();
        if (isset($request->date_from) && isset($request->date_to)) {
            $conditions[] = ['created_at', '>=', $request->date_from . ' 00:00:00'];
            $conditions[] = ['created_at', '<=', $request->date_to . ' 00:00:00'];
            $conditions_return_customer[] = ['returns.created_at', '>=', $request->date_from . ' 00:00:00'];
            $conditions_return_customer[] = ['returns.created_at', '<=', $request->date_to . ' 00:00:00'];
            $conditions_return_supplier[] = ['returns.created_at', '>=', $request->date_from . ' 00:00:00'];
            $conditions_return_supplier[] = ['returns.created_at', '<=', $request->date_to . ' 00:00:00'];
            $conditions_purchases[] = ['order_purchs.created_at', '>=', $request->date_from . ' 00:00:00'];
            $conditions_purchases[] = ['order_purchs.created_at', '<=', $request->date_to . ' 00:00:00'];
            $conditions_asses[] = ['orders.created_at', '>=', $request->date_from . ' 00:00:00'];
            $conditions_asses[] = ['orders.created_at', '<=', $request->date_to . ' 00:00:00'];
            $conditions_converts[] = ['transfers.created_at', '>=', $request->date_from . ' 00:00:00'];
            $conditions_converts[] = ['transfers.created_at', '<=', $request->date_to . ' 00:00:00'];
            $filter['date_from'] = $request->date_from;
            $filter['date_to'] = $request->date_to;
        }
        if (isset($request->store)) {
            $conditions[] = ['storeid', '=', $request->store];
            $conditions_return_customer[] = ['orders.storeid', '=', $request->store];
            $conditions_return_supplier[] = ['order_purchs.store_id', '=', $request->store];
            $conditions_purchases[] = ['order_purchs.store_id', '=', $request->store];
            $conditions_asses[] = ['orders.storeid', '=', $request->store];
            $conditions_converts[] = ['transfers.from_store_id', '=', $request->store];

            $filter['store'] = $request->store;
        }
        $details = array(); //id //ingoing //outgoin //store  //operation // created_at //product_name

        if (isset($request->product)) {

            $filter['product'] = $request->product;
            $all_products = Product::where("id", $request->product)->get();
        }
        else {
            $all_products = Product::all();
        }
        foreach ($all_products as $product_item) {
            $id = $product_item->id;
            $products = Machine::where("productid", $id)->where($conditions)->get();
            foreach ($products as $item) {
                $details[] = array($item->id, $item->initial_quantity, 0, $item->store->name, "كمية ابتدائية", $item->created_at, $product_item->name);
            }
            $products = Purchase::join('order_purchs', 'purchases.unique_col', '=', 'order_purchs.id')->where("machineid", $id)->where($conditions_purchases)->get();
            foreach ($products as $item) {
                $details[] = array($item->id, $item->quantity, 0, $item->myorder->store->name, "أمر شراء", $item->created_at, $product_item->name);
            }
            $products = Asses::join('orders', 'asses.orderid', '=', 'orders.id')->where("machineid", $id)->where($conditions_asses)->get();
            foreach ($products as $item) {

                $details[] = array($item->id, 0, -$item->quantity, $item->myorder->store->name, "sales", $item->created_at, $product_item->name);
            }
            $products = Convert::join('transfers', 'converts.transfer_id', '=', 'transfers.id')->where("productid", $id)->where($conditions_converts)->get();
            foreach ($products as $item) {
                $details[] = array($item->id, $item->quantity, $item->quantity, "----", " نقل من  " . $item->transfer->from_store->name . " ل " . $item->transfer->to_store->name, $item->created_at, $product_item->name);
            }
            $products = ReturnMachine::join('returns', 'returns.id', '=', 'machines_returns.return_id')->join('asses', 'machines_returns.asses_id', '=', 'asses.id')->join('orders', 'asses.orderid', '=', 'orders.id')
                ->select("machines_returns.*")->where('returns.type', 1)->where("asses.machineid", $id)->where($conditions_return_customer)->get();
            foreach ($products as $item) {
                $Asses = Asses::find($item->asses_id);
                $details[] = array($item->id, $item->quantity, 0, $Asses->myorder->store->name, "Customer Return", $item->created_at, $product_item->name);

            }
            $products = ReturnMachine::join('returns', 'returns.id', '=', 'machines_returns.return_id')->join('purchases', 'machines_returns.asses_id', '=', 'purchases.id')->join('order_purchs', 'purchases.unique_col', '=', 'order_purchs.id')
                ->select("machines_returns.*")->where('returns.type', 2)->where("purchases.machineid", $id)->where($conditions_return_supplier)->get();
            foreach ($products as $item) {
                $Asses = Purchase::find($item->asses_id);
                $details[] = array($item->id, 0, -$item->quantity, $Asses->myorder->store->name, "Supllier Return", $item->created_at, $product_item->name);

            }
        }
        usort($details, function ($a, $b) {
            return strtotime($a[5]) - strtotime($b[5]);
        });

        $menus = Menu::orderBy('order_menu')->get();
        $id = $menuid;
        $products = Product::all();
        $stores = Store::all();
        return view('admin.products.product_details_report', compact('details', 'menus', 'id', 'products', 'stores', 'filter'));

    }
    public function product_value_report($id)
    {
        $products = Product::all();
        foreach ($products as $product) {
            $product->quantity = Machine::where('productid', $product->id)
                ->value(DB::raw("SUM(quantity + initial_quantity)"));
            $purchases = Purchase::where("machineid", $product->id)->get();
            $total = 0;
            foreach ($purchases as $item) {
                if ($item->deduction_type == 1) {
                    $deduction = $item->deduction;
                }
                else {
                    $deduction = (($item->price / 100) * $item->deduction);
                }
                $total += ($item->price - $deduction);
            //$total=$total+(($total)/100)*$item->myorder->addition_value;
            }
            try {
                $product->avg_cost = round(($total / count($purchases)), 2);
            }
            catch (\Exception $e) {

                $product->avg_cost = 0;
            }
            $product->expected_sales_price = round($product->quantity * $product->selling_price, 2);
            $product->total_purchases = round($product->quantity * $product->avg_cost, 2);
            $product->expected_profit = $product->expected_sales_price - $product->total_purchases;

        }
        $stores = Store::all();
        $menus = Menu::orderBy('order_menu')->get();

        return view('admin.products.product_value_report', compact('products', 'menus', 'id', 'stores'));
    }

    public function product_value_report_filter($id, Request $request)
    {
        $conditions_machines = array();
        $conditions_purchases = array();

        $filter = array();
        $products = Product::all();
        if (isset($request->date_from) && isset($request->date_to)) {
            $conditions_machines[] = ['created_at', '>=', $request->date_from . ' 00:00:00'];
            $conditions_machines[] = ['created_at', '<=', $request->date_to . ' 00:00:00'];
            $conditions_purchases[] = ['order_purchs.created_at', '>=', $request->date_from . ' 00:00:00'];
            $conditions_purchases[] = ['order_purchs.created_at', '<=', $request->date_to . ' 00:00:00'];
            $filter['date_from'] = $request->date_from;
            $filter['date_to'] = $request->date_to;
        }
        if (isset($request->store) && $request->store != 0) {
            $conditions_machines[] = ['storeid', '=', $request->store];
            $conditions_purchases[] = ['order_purchs.store_id', '=', $request->store];
            $filter['store'] = $request->store;
        }
        foreach ($products as $product) {
            $product->quantity = Machine::where('productid', $product->id)->where($conditions_machines)
                ->value(DB::raw("SUM(quantity + initial_quantity)"));
            if ($product->quantity == NULL) {
                $product->quantity = 0;
            }
            $purchases = Purchase::join('order_purchs', 'purchases.unique_col', '=', 'order_purchs.id')->where("machineid", $product->id)->where($conditions_purchases)->get();
            $total = 0;
            foreach ($purchases as $item) {
                if ($item->deduction_type == 1) {
                    $deduction = $item->deduction;
                }
                else {
                    $deduction = (($item->price / 100) * $item->deduction);
                }
                $total += ($item->price - $deduction);
            //$total=$total+(($total)/100)*$item->myorder->addition_value;
            }
            if (count($purchases) == 0) {
                $product->avg_cost = 0;
            }
            else {
                $product->avg_cost = round(($total / count($purchases)), 2);
            }
            $product->expected_sales_price = round($product->quantity * $product->selling_price, 2);
            $product->total_purchases = round($product->quantity * $product->avg_cost, 2);
            $product->expected_profit = $product->expected_sales_price - $product->total_purchases;

        }
        $stores = Store::all();
        $menus = Menu::orderBy('order_menu')->get();

        return view('admin.products.product_value_report', compact('products', 'menus', 'id', 'stores', 'filter'));
    }
    public function shortcomings($id)
    {
        $menus = Menu::orderBy('order_menu')->get();
        $all_products = Product::all();
        $products = array();
        foreach ($all_products as $product) {
            $machines = Machine::where("productid", $product->id)->get();
            $total_quantity = 0;
            foreach ($machines as $machine) {
                $total_quantity += $machine->initial_quantity + $machine->quantity;

            }
            $product->total_quantity = $total_quantity;
            if ($product->min > $total_quantity) {
                $products[] = $product;
            }

        }
        $products = collect($products);
        return view('admin.products.shortcomings', compact('products', 'menus', 'id'));
    }
}
