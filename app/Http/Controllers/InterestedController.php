<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSheet;
use App\Http\Requests\StoreUpdateSheet;
use App\Sheet;
use App\Phone;
use App\User;
use App\PhoneType;
use App\Servic;
use App\CustomerService;


class InterestedController extends Controller
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
        $manager = User::where('managerid', '=', \Auth()->user()->id);
        //dd($manager);
        if ($manager != null) {
            $parents = $this->getchildren(\Auth()->user()->id);
        }
        else {
            $parents = $this->getParent(\Auth()->user()->id);
        //   $a = Arr::flatten($parents);
        }
        array_push($parents, \Auth()->user()->id);
        $users = User::all();

        if (\Auth::user()->type == 1) {
            //  $allsheets = Sheet::where('isintrest','=',1)->orderBy('id', 'DESC')->paginate(20);
            $allsheets = Sheet::where('isintrest', '=', 1)->whereIn('user_id', $parents)->orderBy('id', 'DESC')->paginate(20);
        }
        elseif (\Auth::user()->type == 0) {
            // $allsheets = Sheet::where('user_id','=',\Auth::user()->id)
            $allsheets = Sheet::whereIn('user_id', $parents)
                ->where('isintrest', '=', 1)
                ->orderBy('id', 'DESC')
                ->paginate(20);
        }
        return View('admin.interest.index', compact('allsheets', 'users', 'menuid'));
    }

    public function create($menuid)
    {
        $allphonetypes = PhoneType::all();
        $allservices = Servic::all();

        return View('admin.interest.add', compact('menuid', 'allphonetypes', 'allservices'));
    }

    public function store(StoreSheet $request)
    {
        $data = $request->all();
        $newsheet = new sheet();
        $newsheet->name = $data['name'];
        $newsheet->dynmicdate = $data['dynmicdate'];
        $newsheet->email = $data['email'];
        $newsheet->activitytype = $data['activitytype'];
        $newsheet->note = $data['note'];
        $newsheet->followtype = $data['followtype'];
        $newsheet->isintrest = $data['isintrest'];
        $newsheet->user_id = $data['user_id'];
        $newsheet->color = $data['color'];
        $newsheet->save();

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
        // save Phones 

        if ($request->itrator > 0) {

            for ($i = 1; $i <= $request->itrator; $i++) {
                $phone = "number" . $i;
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



        if (isset($data['saveandclose']) && $data['saveandclose'] = "save&close") {
            return redirect()->route('sheet.index', $data['menuid']);
        }
        else if (isset($data['saveandnew']) && $data['saveandnew'] = "save&new") {
            return redirect()->route('sheet.create', $data['menuid']);
        }
    }

    public function edit(Sheet $interest, $menuid)
    {
        $allphonetypes = PhoneType::all();
        $allservices = Servic::all();
        $allusers = User::all();
        return View('admin.interest.edit', compact('interest', 'menuid', 'allphonetypes', 'allservices', 'allusers'));

    }

    public function update(StoreUpdateSheet $request, Sheet $interest)
    {
        $data = $request->all();

        $interest->name = $data['name'];
        $interest->dynmicdate = $data['dynmicdate'];
        $interest->email = $data['email'];
        $interest->activitytype = $data['activitytype'];
        $interest->note = $data['note'];
        $interest->followtype = $data['followtype'];
        $interest->isintrest = $data['isintrest'];
        $interest->user_id = $data['user_id'];
        $interest->color = $data['color'];
        $interest->save();

        // save customer services
        CustomerService::where('customer_id', '=', $interest->id)->delete();
        if (isset($data['service_id'])) {
            foreach ($data['service_id'] as $serviceee) {
                if ($serviceee != "") {
                    $newuserservice = new CustomerService();
                    $newuserservice->service_id = $serviceee;
                    $newuserservice->customer_id = $interest->id;
                    $newuserservice->save();
                }
            }
        }
        // save Phones 
        Phone::where('sheet_id', '=', $interest->id)->delete();
        if ($request->itrator > 0) {

            for ($i = 1; $i <= $request->itrator; $i++) {
                $phone = "number" . $i;
                $phonetype = "phonetype" . $i;
                if (isset($request[$phone]) && $request[$phone] != '') {
                    $phonemain = new Phone();

                    $phonemain->phone = $request[$phone];
                    $phonemain->phonetype_id = $request[$phonetype];
                    $phonemain->sheet_id = $interest->id;

                    $phonemain->save();

                } // end single skill
            } // end for loop
        } // end if itrator


        if (isset($data['saveandclose']) && $data['saveandclose'] = "save&close") {
            return redirect()->route('interest.index', $data['menuid']);
        }
        else if (isset($data['saveandnew']) && $data['saveandnew'] = "save&new") {
            return redirect()->route('sheet.create', $data['menuid']);
        }
    }

    public function destory(Sheet $interest, $menuid)
    {
        Phone::where('sheet_id', '=', $interest->id)->delete();
        CustomerService::where('customer_id', '=', $interest->id)->delete();

        $interest->delete();
        return redirect()->route('interest.index', $menuid);

    }

    public function destoryallsheets(Request $request)
    {
        $data = $request->all();

        foreach ($data as $sheetid) {
            Phone::where('sheet_id', '=', $sheetid)->delete();
            CustomerService::where('customer_id', '=', $sheetid)->delete();
            Sheet::where('id', '=', $sheetid)->delete();
        }

        return redirect()->route('interest.index', $data['menuid']);

    }



    public function sheatsearch(Request $request)
    {
        $builder = Sheet::query();
        $allinfo = $request->all();
        if (!empty($allinfo['name'])) {
            $builder->where('name', 'like', '%' . $allinfo['name'] . '%');
        }

        if (!empty($allinfo['email'])) {
            $builder->where('email', '=', $allinfo['email']);
        }



        if (!empty($allinfo['dynmicdate'])) {

            $builder->where(function ($query) use ($allinfo) {
                $query->where('dynmicdate', '=', $allinfo['dynmicdate'])
                    ->orWhere('created_at', 'like', '%' . $allinfo['dynmicdate'] . '%');
            });
        }

        $builder->where('isintrest', '=', 1);

        //      phones
        if (!empty($allinfo['phone'])) {
            $sheetphones = Phone::where('phone', $allinfo['phone'])->get();
            foreach ($sheetphones as $phosh) {
                $sheetid[] = $phosh['sheet_id'];
            }

            if (!empty($sheetid)) {
                $builder->whereIn('id', $sheetid);
            }
            else {
                $sheetid[] = 0;
                $builder->whereIn('id', $sheetid);
            }
        }

        if (\Auth::user()->type == 1) {

            if (!empty($allinfo['user_id'])) {
                $builder->where('user_id', '=', $allinfo['user_id']);
            }

            $allsheets = $builder->get();

        }
        elseif (\Auth::user()->type == 0) {

            $builder->where('user_id', '=', \Auth::user()->id);
            $allsheets = $builder->get();

        }
        $pagination = "no";
        $users = User::all();
        $menuid = $allinfo['menuid'];
        return View('admin.interest.index', compact('allsheets', 'users', 'menuid', 'pagination'));

    }
}
