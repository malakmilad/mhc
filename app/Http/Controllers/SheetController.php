<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSheet;
use App\Http\Requests\StoreUpdateSheet;
use App\Sheet;
use App\Phone;
use App\PhoneType;
use App\Servic;
use App\User;
use App\TimeTable;
use App\CustomerService;
use App\CustomerTypes;
use App\Socail;
use App\Area;
use App\Activite;
use Excel;
use App\TaskType;
use App\TaskStatus;
use App\Opportunity;
use App\Stage;
use App\Disease;
use App\DiseaseCustomer;
use Carbon\Carbon;
class SheetController extends Controller
{
    public static function getParent($parent)
    {
        $tree = array();
        if (!empty($parent)) {
            $tree = User::where('id', $parent)->pluck('managerid')->toArray();
            foreach ($tree as $key => $val) {
                $ids = self::getChildren($val);
                if (!empty($ids)) {
                    if (count($ids) > 0)
                        $tree = array_merge($tree, $ids);
                }
            }
        }
        return $tree;
    }
    public static function getChildren($parent)
    {
        $tree = array();
        if (!empty($parent)) {
            $tree = User::where('managerid', $parent)->pluck('id')->toArray();
            foreach ($tree as $key => $val) {
                $ids = self::getChildren($val);
                if (!empty($ids)) {
                    if (count($ids) > 0)
                        $tree = array_merge($tree, $ids);
                }
            }
        }
        return $tree;
    }

    public function index($menuid)
    {
      /*  $manager = User::where('managerid', '=', \Auth()->user()->id);
        if ($manager != null) {
        }
        else {
            $parents = $this->getParent(\Auth()->user()->id);
        //   $a = Arr::flatten($parents);
        }*/
        $parents = $this->getchildren(\Auth()->user()->id);
      
        array_push($parents, \Auth()->user()->id);
        //array_push($parents, 1);
        $users = User::all();
        if (\Auth::user()->type == 1) {
            $allsheets = Sheet::where('created_at', 'like', '%' . date('Y-m-d') . '%')->orWhere('dynmicdate', 'like', '%' . date('Y-m-d') . '%')->whereIn('user_id', $parents)->orderBy('id', 'DESC')->paginate(20);
        }
        elseif (\Auth::user()->type == 0) {
            $allsheets = Sheet::where(function ($query) {
                $query->where('created_at', 'like', '%' . date('Y-m-d') . '%')->orWhere('dynmicdate', 'like', '%' . date('Y-m-d') . '%');
            })->whereIn('user_id', $parents)->orderBy('id', 'DESC')->paginate(20);
        }
        $customerTypess = CustomerTypes::all();
        $acivites = Activite::all();
        $govs = Area::where("parentid", 0)->get();
        $cities = Area::where("parentid", "!=", 0)->get();
        $allservices = Servic::all();


        foreach ($allsheets as $sheet) {
            $CustomerTypes = CustomerTypes::find($sheet->isintrest);
            if ($CustomerTypes != null)
                $sheet->customer_type = $CustomerTypes->name;
            $sheet->alltimetables = TimeTable::where('sheet_id', $sheet->id)->orderBy('id', 'DESC')->get();
            foreach ($sheet->alltimetables as $task) {
                $employee = User::find($task->employee);
                $type = TaskType::find($task->taskType);
                $status = TaskStatus::find($task->meetingstate);
                $task->employee_name = $employee->name;
                $task->status_name = $status->name;
                $task->type_name = $type->name;

            }
            $sheet->allOpportunitys = Opportunity::select("opportunitys.*", "stages.name as stage_name", "sheets.name as customer_name")->join("sheets", "opportunitys.customerid", "=", "sheets.id")->join("stages", "opportunitys.stageid", "=", "stages.id")->where("sheets.id", $sheet->id)->get();

        }
        return View('admin.sheets.index', compact('allsheets', 'users', 'menuid', 'customerTypess', 'acivites', 'govs', 'cities', 'allservices'));
    }

    public function allsheets($menuid)
    {
       // $manager = User::where('managerid', '=', \Auth()->user()->id)->get();
       // $manager=User::find( \Auth()->user()->id)->managerid;
       //// dd($manager);
      //  if ($manager == 0 ||$manager==NULL) {
            $parents = $this->getchildren(\Auth()->user()->id);
       /* }
        else {
            $parents = $this->getParent(\Auth()->user()->id);
        //   $a = Arr::flatten($parents);
        }*/
       array_push($parents, \Auth()->user()->id);
        //dd($parents);
       // array_push($parents, 1);
        $users = User::all();
        if (\Auth::user()->type == 1) {

            $allsheets = Sheet::select('sheets.*')
            ->whereIn('sheets.user_id', $parents)->orderBy('sheets.id', 'DESC')->get();
        }
        elseif (\Auth::user()->type == 0) {

            $allsheets = Sheet::select('sheets.*')
            ->whereIn('sheets.user_id', $parents)->orderBy('sheets.id', 'DESC')->get();
        }
        $customerTypess = CustomerTypes::all();
//     dd($allsheets);
        $acivites = Activite::all();
        $govs = Area::where("parentid", 0)->get();
        $cities = Area::where("parentid", "!=", 0)->get();
        $allservices = Servic::all();
        foreach ($allsheets as $sheet) {
            $CustomerTypes = CustomerTypes::find($sheet->isintrest);
            if ($CustomerTypes != null)
                $sheet->customer_type = $CustomerTypes->name;
            $sheet->alltimetables = TimeTable::where('sheet_id', $sheet->id)->orderBy('id', 'DESC')->get();
            foreach ($sheet->alltimetables as $task) {
                $employee = User::find($task->employee);
                $type = TaskType::find($task->taskType);
                $social = Socail::where('id', $task->socailid)->first();
                $area = Area::find($task->areaid);
                $status = TaskStatus::find($task->meetingstate);
                $task->employee_name = $employee->name;
                $task->status_name = $status->name;
                $task->type_name = $type->name;

            }
            $sheet->allOpportunitys = Opportunity::select("opportunitys.*", "stages.name as stage_name", "sheets.name as customer_name")->join("sheets", "opportunitys.customerid", "=", "sheets.id")->join("stages", "opportunitys.stageid", "=", "stages.id")->where("sheets.id", $sheet->id)->get();

        }

        return View('admin.sheets.allclients', compact('allsheets', 'users', 'menuid', 'customerTypess', 'acivites', 'govs', 'cities', 'allservices'));
    }
    public function allsheetsreport($menuid)
    {
        $manager=User::find( \Auth()->user()->id)->managerid;
        $parents = $this->getchildren(\Auth()->user()->id);
        
        array_push($parents, \Auth()->user()->id);
        $users = User::all();
        if (\Auth::user()->type == 1) {

            $allsheets = Sheet::select('sheets.*')
            ->whereIn('sheets.user_id', $parents)->orderBy('sheets.id', 'DESC')->get();
        }
        elseif (\Auth::user()->type == 0) {

            $allsheets = Sheet::select('sheets.*')
            ->whereIn('sheets.user_id', $parents)->orderBy('sheets.id', 'DESC')->get();
        }
        $customerTypess = CustomerTypes::all();
        $acivites = Activite::all();
        $govs = Area::where("parentid", 0)->get();
        $cities = Area::where("parentid", "!=", 0)->get();
        $allservices = Servic::all();
        foreach ($allsheets as $sheet) {
            $CustomerTypes = CustomerTypes::find($sheet->isintrest);
            if ($CustomerTypes != null)
                $sheet->customer_type = $CustomerTypes->name;
            $sheet->alltimetables = TimeTable::where('sheet_id', $sheet->id)->orderBy('id', 'DESC')->get();
            foreach ($sheet->alltimetables as $task) {
                $employee = User::find($task->employee);
                $type = TaskType::find($task->taskType);
                $social = Socail::where('id', $task->socailid)->first();
                $area = Area::find($task->areaid);
                $status = TaskStatus::find($task->meetingstate);
                $task->employee_name = $employee->name;
                $task->status_name = $status->name;
                $task->type_name = $type->name;

            }
            $sheet->allOpportunitys = Opportunity::select("opportunitys.*", "stages.name as stage_name", "sheets.name as customer_name")->join("sheets", "opportunitys.customerid", "=", "sheets.id")->join("stages", "opportunitys.stageid", "=", "stages.id")->where("sheets.id", $sheet->id)->get();

        }

        return View('admin.sheets.allclientsreport', compact('allsheets', 'users', 'menuid', 'customerTypess', 'acivites', 'govs', 'cities', 'allservices'));
    }


    public function create($menuid)
    {
        $allphonetypes = PhoneType::all();
        $allservices = Servic::all();
        $allusers = User::all();
        $acivites = Activite::all();
        $alldiseases = Disease::all();
        $customerTypess = CustomerTypes::all();
        $socails = Socail::all();
        $govs = Area::where("parentid", 0)->get();
        $cities = Area::where("parentid", "!=", 0)->get();
        return View('admin.sheets.add', compact('menuid', 'alldiseases', 'allservices', 'allphonetypes', 'allusers', 'acivites', 'customerTypess', 'socails', 'govs', 'cities'));
    }
    public function sheet($menuid)
    {
        return view('admin.sheets.sheet', compact('menuid'));
    }

    public function sheetStore(Request $request)
    {
       
      
        $destinationPath = 'uploads';
        $file = $request->file('file');
        $file->move($destinationPath, $file->getClientOriginalName());
        $results = Excel::selectSheetsByIndex(0)->load($destinationPath . "/" . $file->getClientOriginalName())->get();
        $headers = $results->getHeading();
        foreach ($results as $result) {

            $row = $result->toArray();
            $newsheet = new sheet();

            $newsheet->user_id = $row["employeeid"];
            $newsheet->name = $row["clientname"];
            $newsheet->email = $row["email"];
            $newsheet->created_at = $row["created_at"];
            $newsheet->activitytype = $row["activityid"];
            $newsheet->note = $row["notes"];

            $services = explode(",", $row["servicesidssperate_by_comma"]);

            $newsheet->isintrest = $row["clienttypeid"];
            $newsheet->socailid = $row["socailid"];
            $newsheet->areaid = $row["areaid"];
            $newsheet->color = $row["color"];

            $phones = explode(",", $row["phonesphonetypephone_number"]);



            try {
                $newsheet->save();
                foreach ($services as $serviceee) {
                    if ($serviceee != "") {
                        $newuserservice = new CustomerService();
                        $newuserservice->service_id = $serviceee;
                        $newuserservice->customer_id = $newsheet->id;
                        $newuserservice->save();
                    }
                }
                foreach ($phones as $phone) {
                    $myphone = explode("/", $phone);
                    $phonemain = new Phone();

                    $phonemain->phone = $myphone[1];
                    $phonemain->phonetype_id = $myphone[0];
                    $phonemain->sheet_id = $newsheet->id;

                    $phonemain->save();
                }
            }
            catch (\Exception $e) {
                continue;
            }
        }
        return redirect()->route('sheet.index', $request->menuid);
    }

    public function store(Request $request)
    {
        //DB::transaction(function ()  use ($request){
            DB::beginTransaction();
            try{
        $data = $request->all();
        $newsheet = new sheet();
        $newsheet->name = $data['name'];
        //$newsheet->dynmicdate = $data['dynmicdate'];
        if (!empty($data['email']))
            $newsheet->email = $data['email'];

        // if (!empty($data['activitytype']))
        //   $newsheet->activitytype = $data['activitytype'];

        if (!empty($data['note']))
            $newsheet->note = $data['note'];

        if (!empty($data['followtype']))
            $newsheet->followtype = $data['followtype'];

        if (!empty($data['isintrest']))
            $newsheet->isintrest = $data['isintrest'];

        if (!empty($data['user_id']))
            $newsheet->user_id = $data['user_id'];

        if (!empty($data['color']))
            $newsheet->color = $data['color'];

        if (!empty($data['socail']))
            $newsheet->socailid = $data['socail'];

        if (!empty($data['areaid']))
            $newsheet->areaid = $data['areaid'];
        if (!empty($data['dynmicdate']))
            $newsheet->dynmicdate = $data['dynmicdate'];
        $file = $request->file('customerFile');
        if ($file != "") {
            $destinationPath = public_path() . '/uploads';
            $file->move($destinationPath, $file->getClientOriginalName());
            $newsheet->file = url('/') . '/public/uploads/' . $file->getClientOriginalName();

        }
        $newsheet->address = $data['address'];
     
        $newsheet->customer_weight = $data['customer_weight'];
        $newsheet->customer_type = $data['customer_type'];
     
        $newsheet->save();

        // time table

        if (isset($data['checker']) && $data['checker'] == "1") {

            $newtimetable = new TimeTable();
            $newtimetable->time = $data['time'];
            $newtimetable->dydate = $data['dydate'];
            $newtimetable->meetingplace = $data['meetingplace'];
            $newtimetable->note = $data['timenote'];
            $newtimetable->meetingstate = $data['meetingstate'];
            $newtimetable->dynmicdate = $data['dynmicdate'];
            $newtimetable->sheet_id = $newsheet->id;
            $newtimetable->user_id = \Auth::user()->id;
            $newtimetable->save();
        }

        // save customer services
        if (isset($data['service_id'])) {
            foreach ($data['service_id'] as $serviceee) {
                if ($serviceee != "") {
                    $newuserservice = new CustomerService();
                    $newuserservice->service_id = $serviceee;
                    $newuserservice->customer_id = $newsheet->id;
                    $newuserservice->save();
                }
            }
        }
        // save Disease
        if (isset($data['disease_id'])) {
            foreach ($data['disease_id'] as $diseasee) {
                if ($diseasee != "") {
                    $newdisease = new DiseaseCustomer();
                    $newdisease->disease_id = $diseasee;
                    $newdisease->customer_id = $newsheet->id;
                    $newdisease->save();
                }
            }
        }

        if ($request->itrator > 0) {
          
            for ($i = 1; $i <= $request->itrator; $i++) {
                 //   $phonemain->phone = $request[$phone];
                $phone = "number" . $i;
                $messages = [
                    "number" . $i.'unique'    => 'Phone is unique',
                             ];
                $errors = array();
       
                $validator = Validator::make(
                   $request->all(),
                    
                        ["number". $i=>'required|unique:phones,phone'],$messages
                       
                );
                 if ($validator->fails() ){
                   // return View('admin.sheets.add', compact('menuid', 'errors'));
                    $errors[] ="phone must be unique";
             return redirect()->route('sheet.create', $data['menuid'])->withErrors($validator)->withInput();
                  //  return redirect()->back()->with('error','phone must be unique');
                // return redirect(url()->previous() .'#AddSheet') ->withErrors($validator) ->withInput();
              // return back();
                }
                 /* $validator->after(function($validator) {
                    if ($this->somethingElseIsInvalid()) {
                        $validator->errors()->add('phone', 'Something is wrong with this field!');
                    }
                });
              $validator->errors()->add("number". $i, 'This is not unique phone');
                throw new ValidationException($validator);
                /* $error = \Illuminate\Validation\ValidationException::withMessages([
                    "number". $i => ['Unique phone'],
                 ]);
                 throw $error;
              
                if ($validator->fails()) {
                $validator->errors()->add('phone', 'Something is wrong with this field!');
                }*/
                $phonetype = "phonetype" . $i;
                if (isset($request[$phone]) && $request[$phone] != '') {
                    $phonemain = new Phone();

                    $phonemain->phone = $request[$phone];
                    $phonemain->phonetype_id = $request[$phonetype];
                    $phonemain->sheet_id = $newsheet->id;

                    $phonemain->save();

                } // end single skill
            } // end for loop
        } // end if itrator
      //  Session::flash('success_message', 'Data inserted');
         DB::commit();
        if (isset($data['saveandclose']) && $data['saveandclose'] = "save&close") {
            return redirect()->route('sheet.allsheets', $data['menuid']);
        }
        else if (isset($data['saveandnew']) && $data['saveandnew'] = "save&new") {
            return redirect()->route('sheet.create', $data['menuid']);
        }
    }
    catch(\Exception $e){
        //if there is an error/exception in the above code before commit, it'll rollback
        DB::rollBack(); 
    //   return redirect()->route('sheet.create',36);
    //Console.log($e);
    return redirect()->route('sheet.create', $data['menuid'])->withErrors($validator)->withInput();
           
       throw new ValidationException($validator);
        }
    
    }
    public function edit(Sheet $sheet, $menuid)
    {
        $allphonetypes = PhoneType::all();
        $allservices = Servic::all();
        $alldiseases = Disease::all();
        $allusers = User::all();
        $acivites = Activite::all();
        $customerTypess = CustomerTypes::all();
        $socails = Socail::all();
        $govs = Area::where("parentid", 0)->get();
        $cities = Area::where("parentid", "!=", 0)->get();
        if ($sheet->areaid != NULL && $sheet->areaid != 0) {
            $myarea = Area::find($sheet->areaid);
            $mygov = $myarea->parentid;
        }
        else {
            $myarea = "";
            $mygov = "";
        }
        return View('admin.sheets.edit', compact('alldiseases', 'sheet', 'menuid', 'allphonetypes', 'allservices', 'allusers', 'acivites', 'customerTypess', 'socails', 'govs', 'cities', 'mygov'));

    }

    public function update(Request $request, Sheet $sheet)
    {
        $data = $request->all();

        $sheet->name = $data['name'];
        //$sheet->dynmicdate = $data['dynmicdate'];
        if (!empty($data['email']))
            $sheet->email = $data['email'];

        if (!empty($data['activitytype']))
            $sheet->activitytype = $data['activitytype'];

        if (!empty($data['note']))
            $sheet->note = $data['note'];

        if (!empty($data['followtype']))
            $sheet->followtype = $data['followtype'];

        if (!empty($data['isintrest']))
            $sheet->isintrest = $data['isintrest'];

        if (!empty($data['user_id']))
            $sheet->user_id = $data['user_id'];

        if (!empty($data['color']))
            $sheet->color = $data['color'];

        if (!empty($data['socail']))
            $sheet->socailid = $data['socail'];

        if (!empty($data['areaid']))
            $sheet->areaid = $data['areaid'];

        $file = $request->file('customerFile');
        if ($file != "") {
            $destinationPath = public_path() . '/uploads';
            $file->move($destinationPath, $file->getClientOriginalName());
            $newsheet->file = url('/') . '/public/uploads/' . $file->getClientOriginalName();

        }
        $sheet->dynmicdate = $data['dynmicdate'];
        $sheet->save();

        // save customer services
        CustomerService::where('customer_id', '=', $sheet->id)->delete();
        if (isset($data['service_id'])) {
            foreach ($data['service_id'] as $serviceee) {
                if ($serviceee != "") {
                    $newuserservice = new CustomerService();
                    $newuserservice->service_id = $serviceee;
                    $newuserservice->customer_id = $sheet->id;
                    $newuserservice->save();
                }
            }
        }
        // save customer services
        DiseaseCustomer::where('customer_id', '=', $sheet->id)->delete();
        if (isset($data['disease_id'])) {
            foreach ($data['disease_id'] as $diseaseee) {
                if ($serviceee != "") {
                    $newuserdisease = new DiseaseCustomer();
                    $newuserdisease->disease_id = $diseaseee;
                    $newuserdisease->customer_id = $sheet->id;
                    $newuserdisease->save();
                }
            }
        }

        // save Phones 
        Phone::where('sheet_id', '=', $sheet->id)->delete();
        if ($request->itrator > 0) {

            for ($i = 1; $i <= $request->itrator; $i++) {
                $phone = "number" . $i;
                $phonetype = "phonetype" . $i;
                if (isset($request[$phone]) && $request[$phone] != '') {
                    $phonemain = new Phone();

                    $phonemain->phone = $request[$phone];
                    $phonemain->phonetype_id = $request[$phonetype];
                    $phonemain->sheet_id = $sheet->id;

                    $phonemain->save();

                } // end single skill
            } // end for loop
        } // end if itrator
        if (isset($data['saveandclose']) && $data['saveandclose'] = "save&close") {
            return redirect()->route('sheet.allsheets', $data['menuid']);
        }
        else if (isset($data['saveandnew']) && $data['saveandnew'] = "save&new") {
            return redirect()->route('sheet.create', $data['menuid']);
        }


    }

    public function destory(Sheet $sheet, $menuid)
    {
        Phone::where('sheet_id', '=', $sheet->id)->delete();
        $sheet->delete();
        CustomerService::where('customer_id', '=', $sheet->id)->delete();
        return redirect()->route('sheet.index', $menuid);

    }
    public function destoryallsheets(Request $request)
    {
        $data = $request->all();

        foreach ($data as $sheetid) {
            Phone::where('sheet_id', '=', $sheetid)->delete();
            CustomerService::where('customer_id', '=', $sheetid)->delete();
            Sheet::where('id', '=', $sheetid)->delete();
        }

        return redirect()->route('sheet.index', $data['menuid']);

    }


    public function sheatsearch(Request $request)
    {
        // $builder = Sheet::query();
        $builder = Sheet::select('id', 'name', 'dynmicdate', 'email', 'activitytype', "note",
            "followtype", "isintrest", 'user_id', 'areaid', 'color', 'socailid', 'file', 'created_at'); //, DB::raw(count('*')));
        /*$builder = Sheet::select('name')->select('dynmicdate')->select('email')
         ->select('activitytype')->select('note')->select('followtype')->select('isintrest')
         ->select('user_id ')->select('areaid')->select('color')->select('socailid')->select('file')->distinct('name');*/
        $allinfo = $request->all();
        if (!empty($allinfo['service_id']) && !$allinfo['service_id'] == null) {

            $builder->join('customer_services', 'sheets.id', '=', 'customer_services.customer_id');
            $builder->where('service_id', '=', $allinfo['service_id']);

        }

        if (!empty($allinfo['name']) && !$allinfo['name'] == null) {
            $builder->where('name', 'like', '%' . $allinfo['name'] . '%');
        }

        if (!empty($allinfo['email']) && !$allinfo['email'] == null) {
            $builder->where('email', '=', $allinfo['email']);
        }
        if (!empty($allinfo['isintrest']) && !$allinfo['isintrest'] == null) {
            $builder->where('isintrest', '=', $allinfo['isintrest']);
        }
        if (!empty($allinfo['activitytype']) && !$allinfo['activitytype'] == null) {
            $builder->where('activitytype', '=', $allinfo['activitytype']);
        }
        if (!empty($allinfo['govid']) && (empty($allinfo['areaid']) || $allinfo['areaid'] == null)) {
            $gov_cities = Area::where("parentid", $allinfo['govid'])->pluck("id")->toArray();

            $builder->whereIn('areaid', $gov_cities); //->groupBy('name');
        }
        if (!empty($allinfo['govid']) && !(empty($allinfo['areaid']) || $allinfo['areaid'] == null)) {
            $builder->where('areaid', '=', $allinfo['areaid']);
        }




        //      phones
        if (!empty($allinfo['phone']) && !$allinfo['phone'] == null) {
            $sheetphones = Phone::where('phone', $allinfo['phone'])->get();
            foreach ($sheetphones as $phosh) {
                $sheetid[] = $phosh['sheet_id'];
            }

            if (!empty($sheetid) && !$allinfo['sheetid'] == null) {
                $builder->whereIn('sheets.id', $sheetid);
            }
            else {
                $sheetid[] = 0;
                $builder->whereIn('sheets.id', $sheetid);
            }
        }
        if (!empty($allinfo['dynmicdate']) && !$allinfo['dynmicdate'] == null) {

            $builder->where(function ($query) use ($allinfo) {
                $query->where('dynmicdate', '=', $allinfo['dynmicdate'])
                    ->orWhere('sheets.created_at', 'like', '%' . $allinfo['dynmicdate'] . '%');
            });
        }

        if (!empty($allinfo['datefrom']) && !empty($allinfo['dateto']) && !$allinfo['datefrom'] == null && !$allinfo['dateto'] == null) {

            $builder->whereBetween('created_at', [$allinfo['datefrom'], $allinfo['dateto']]);

        }

        if (\Auth::user()->type == 1) {

            if (!empty($allinfo['user_id'])) {
                $builder->where('user_id', '=', $allinfo['user_id']);
            }

            $allsheets = $builder->groupBy('id', 'name', 'dynmicdate', 'email', 'activitytype', "note",
                "followtype", "isintrest", 'user_id', 'areaid', 'color', 'socailid', 'file', 'created_at')->get();

        }

        if (\Auth::user()->type == 0) {
            $builder->where('user_id', '=', \Auth::user()->id);
            $allsheets = $builder->groupBy('id', 'name', 'dynmicdate', 'email', 'activitytype', "note",
                "followtype", "isintrest", 'user_id', 'areaid', 'color', 'socailid', 'file', 'created_at')->get();
        }


        $pagination = "no";


        $users = User::all();
        $menuid = $allinfo['menuid'];
        $customerTypess = CustomerTypes::all();
        $acivites = Activite::all();
        $govs = Area::where("parentid", 0)->get();
        $cities = Area::where("parentid", "!=", 0)->get();
        $allservices = Servic::all();

        foreach ($allsheets as $sheet) {
            $CustomerTypes = CustomerTypes::find($sheet->isintrest);
            if ($CustomerTypes != null)
                $sheet->customer_type = $CustomerTypes->name;
            $sheet->alltimetables = TimeTable::where('sheet_id', $sheet->id)->orderBy('id', 'DESC')->get();
            foreach ($sheet->alltimetables as $task) {
                $employee = User::find($task->employee);
                $type = TaskType::find($task->taskType);
                $status = TaskStatus::find($task->meetingstate);
                if ($employee != NULL)
                    $task->employee_name = $employee->name;
                else
                    $task->employee_name = "";

                if ($status != NULL)
                    $task->status_name = $status->name;
                else
                    $task->status_name = "";

                if ($type != NULL)
                    $task->type_name = $type->name;
                else
                    $task->type_name = "";

            }
            $sheet->allOpportunitys = Opportunity::select("opportunitys.*", "stages.name as stage_name", "sheets.name as customer_name")->join("sheets", "opportunitys.customerid", "=", "sheets.id")->join("stages", "opportunitys.stageid", "=", "stages.id")->where("sheets.id", $sheet->id)->distinct()->get();

        }
        return View('admin.sheets.allclients', compact('allsheets', 'users', 'menuid', 'pagination', 'customerTypess', 'acivites', 'govs', 'cities', 'allservices'));

    }
    public function report($menuid)
    {
        $currentTime = Carbon::now();

        $builder = Sheet::join('users', 'users.id', '=', 'sheets.user_id');

        $allclients = $builder->orderBy('sheets.id', 'DESC')->get();
        $count1 = 0;
        $dynmicdate = $currentTime->toDateTimeString();
        foreach ($allclients as $client) {
            $count1++;
            $dynmicdate = $client->dynmicdate;
        }
        return View('admin.sheets.report', compact('dynmicdate', 'count1', 'menuid', 'allclients'));
    }
    public function reportsearch(Request $request)
    {
        $allinfo = $request->all();
        $menuid = $request->menuid;
        $currentTime = Carbon::now();

        $builder = Sheet::join('users', 'users.id', '=', 'sheets.user_id');
        if (!empty($allinfo['dynmicdate'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('dynmicdate', '=', $allinfo['dynmicdate'])->orWhere('dynmicdate', 'like', '%' . $allinfo['dynmicdate'] . '%');
            });
        }
        if (!empty($allinfo['datefrom']) && !empty($allinfo['dateto']) && $allinfo['datefrom'] != null && $allinfo['dateto'] != null) {
            $builder->whereBetween('sheets.dynmicdate', [$allinfo['datefrom'], $allinfo['dateto']]);
        }

        $allclients = $builder->orderBy('sheets.id', 'DESC')->get();
        $count1 = 0;
          $dynmicdate = $allinfo['dynmicdate'];//$currentTime->toDateTimeString();
        foreach ($allclients as $client) {
            $count1++;
            $dynmicdate = $client->dynmicdate;
        }
        return View('admin.sheets.report', compact('dynmicdate', 'count1', 'menuid', 'allclients'));
    }

}
