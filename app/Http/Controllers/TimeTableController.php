<?php

namespace App\Http\Controllers;

use App\Area;
use App\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTimeTable;
use App\Sheet;
use App\TaskStatus;
use App\TaskType;
use App\TimeTable;
use App\User;
use App\Vehicle;
use App\vehicleCustomer;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class TimeTableController extends Controller
{
    public static function getParent($parent)
    {
        $tree = array();
        if (!empty($parent)) {
            $tree = User::where('id', $parent)->pluck('managerid')->toArray();
            foreach ($tree as $key => $val) {
                $ids = self::getChildren($val);
                if (!empty($ids)) {
                    if (count($ids) > 0) {
                        $tree = array_merge($tree, $ids);
                    }

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
                    if (count($ids) > 0) {
                        $tree = array_merge($tree, $ids);
                    }

                }
            }
        }
        return $tree;
    }
    public function index($menuid)
    {
        $manager = User::where('managerid', '=', \Auth()->user()->id);
        if ($manager != null) {
            $parents = $this->getchildren(\Auth()->user()->id);
        } else {
            $parents = $this->getParent(\Auth()->user()->id);
            //   $a = Arr::flatten($parents);
        }
        array_push($parents, \Auth()->user()->id);
        //array_push($parents, 1);
        $users = User::all();

        if (\Auth::user()->type == 1) {
            //   $alltimetables = TimeTable::where('created_at','like','%'.date('Y-m-d').'%')->orderBy('id', 'DESC')->where('timeid',0)->get();

            $alltimetables = TimeTable::where('created_at', 'like', '%' . date('Y-m-d') . '%')
                ->orderBy('time_tables.id', 'DESC')->where('timeid', 0)->whereIn('employee', $parents)->get();
        } elseif (\Auth::user()->type == 0) {
            /*   $alltimetables = TimeTable::join('users', 'users.id', '=', 'time_tables.employee')->where('time_tables.created_at','like','%'.date('Y-m-d').'%')->where('timeid',0)->where(function($q) {
            $q->where('employee','=',\Auth::user()->id)->orWhere("users.managerid",\Auth::user()->id)->orderBy('id', 'DESC');
            })*/
            $alltimetables = TimeTable::select("time_tables.*")->join('users', 'users.id', '=', 'time_tables.employee')
                ->where('time_tables.created_at', 'like', '%' . date('Y-m-d') . '%')->where('timeid', 0)
                ->whereIn('employee', $parents)->orderBy('time_tables.id', 'DESC')
                ->get();
        }
        $users = User::all();
        foreach ($alltimetables as $task) {
            $employee = User::find($task->employee);
            $type = TaskType::find($task->taskType);
            $status = TaskStatus::find($task->meetingstate);
            $from_area = Area::find($task->from_area);
            $to_area = Area::find($task->to_area);
            $task->oper_name = TimeTable::find($task->id)->name;
            if ($employee != null) {
                $task->employee_name = $employee->name;
            } else {
                $task->employee_name = "";
            }

            if ($from_area != null) {
                $task->from_area_name = $from_area->name;
            }

            if ($to_area != null) {
                $task->to_area_name = $to_area->name;
            }

            if ($status != null) {
                $task->status_name = $status->name;
            } else {
                $task->status_name = "";
            }

            if ($type != null) {
                $task->type_name = $type->name;
            } else {
                $task->type_name = "";
            }

        }
        $alltypes = TaskType::all();
        $allstatus = TaskStatus::all();
        $allclients = Sheet::all();
        return View('admin.timetable.index', compact('alltimetables', 'menuid', 'users', 'alltypes', 'allstatus', 'allclients'));
    }
    /*  public function companyoperations($menuid)
    {
    $manager = User::where('managerid', '=', \Auth()->user()->id);
    if ($manager != null) {
    $parents = $this->getchildren(\Auth()->user()->id);
    }
    else {
    $parents = $this->getParent(\Auth()->user()->id);
    //   $a = Arr::flatten($parents);
    }
    array_push($parents, \Auth()->user()->id);
    array_push($parents, 1);
    $users = User::all();

    if (\Auth::user()->type == 1) {
    //   $alltimetables = TimeTable::where('created_at','like','%'.date('Y-m-d').'%')->orderBy('id', 'DESC')->where('timeid',0)->get();

    $alltimetables = TimeTable::where('created_at', 'like', '%' . date('Y-m-d') . '%')
    ->orderBy('time_tables.id', 'DESC')->where('timeid', 0)->where('added_value', '!=', NULL)
    ->orwhere('deduct_value', '!=', NULL)
    ->whereIn('employee', $parents)->get();

    }
    elseif (\Auth::user()->type == 0) {
    $alltimetables = TimeTable::select("time_tables.*")->join('users', 'users.id', '=', 'time_tables.employee')
    ->where('time_tables.created_at', 'like', '%' . date('Y-m-d') . '%')->where('timeid', 0)
    ->whereIn('employee', $parents)->orderBy('time_tables.id', 'DESC')
    ->where('added_value', '!=', NULL)
    ->orwhere('deduct_value', '!=', NULL)
    ->get();
    }
    $users = User::all();
    foreach ($alltimetables as $task) {
    $employee = User::find($task->employee);
    $type = TaskType::find($task->taskType);
    $status = TaskStatus::find($task->meetingstate);
    $from_area = Area::find($task->from_area);
    $to_area = Area::find($task->to_area);
    $task->oper_name = TimeTable::find($task->id)->name;
    $company = Company::find($task->company_id);
    if ($employee != null)
    $task->employee_name = $employee->name;
    else
    $task->employee_name = "";
    if ($company != null)
    $task->company_name = $company->name;
    else
    $task->company_name = "";

    if ($from_area != null)
    $task->from_area_name = $from_area->name;
    if ($to_area != null)
    $task->to_area_name = $to_area->name;

    if ($status != null)
    $task->status_name = $status->name;
    else
    $task->status_name = "";

    if ($type != null)
    $task->type_name = $type->name;
    else
    $task->type_name = "";

    }
    $alltypes = TaskType::all();
    $allstatus = TaskStatus::all();
    $allclients = Sheet::all();
    return View('admin.timetable.companyoperations', compact('alltimetables', 'menuid', 'users', 'alltypes', 'allstatus', 'allclients'));
    }*/
    public function companyoperationssearch(Request $request)
    {

        $allinfo = $request->all();

        if (\Auth::user()->type == 1) {
            $builder = TimeTable::where('timeid', 0);
            //::join('vehicle_services', 'time_tables.id', '=', 'vehicle_services.timetable_id')->where('timeid', 0)->where('vehicle_services.deleted_at', NULL);

            //

        } elseif (\Auth::user()->type == 0) {

            $builder = TimeTable::select("time_tables.*")->join('users', 'users.id', '=', 'time_tables.employee')
            //    ->join('vehicle_services', 'time_tables.id', '=', 'vehicle_services.timetable_id')->where('vehicle_services.deleted_at', NULL)
                ->where('timeid', 0)->where(function ($q) {
                $q->where('employee', '=', \Auth::user()->id)->orWhere("users.managerid", \Auth::user()->id)
                    ->orWhere("user_id", \Auth::user()->id);
            });
        }
        if (!empty($allinfo['dydate'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('time_tables.dydate', '=', $allinfo['dydate'])
                    ->orWhere('time_tables.dydate', 'like', '%' . $allinfo['dydate'] . '%');
            });
        }
        if (!empty($allinfo['user_id'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('employee', '=', $allinfo['user_id']);
            });
        }

        if (!empty($allinfo['task_type'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('taskType', '=', $allinfo['task_type']);
            });
        }

        if (!empty($allinfo['task_status'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('meetingstate', '=', $allinfo['task_status']);
            });
        }

        if (!empty($allinfo['created_by'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('user_id', '=', $allinfo['created_by']);
            });
        }

        if (!empty($allinfo['client_id'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('sheet_id', '=', $allinfo['client_id']);
            });
        }
        /* if (!empty($allinfo['dydate']) && !$allinfo['dydate'] == null) {
        $builder->where(function ($query) use ($allinfo) {
        $query->where('time_tables.created_at', '=', $allinfo['dydate'])
        ->orWhere('time_tables.created_at', 'like', '%' . $allinfo['dydate'] . '%');
        });
        }*/

        if (!empty($allinfo['datefrom']) && !empty($allinfo['dateto']) && !$allinfo['datefrom'] == null && !$allinfo['dateto'] == null) {
            $builder->whereBetween('time_tables.dydate', [$allinfo['datefrom'], $allinfo['dateto']])
                ->orWhere('time_tables.dydate', 'like', '%' . $allinfo['datefrom'] . '%')
                ->orWhere('time_tables.dydate', 'like', '%' . $allinfo['dateto'] . '%');
        }

        $alltimetables = $builder->where('company_id', '!=', null)->orderBy('time_tables.id', 'DESC')->get();

        foreach ($alltimetables as $task) {
            $employee = User::find($task->employee);
            $type = TaskType::find($task->taskType);
            $status = TaskStatus::find($task->meetingstate);
            $from_area = Area::find($task->from_area);
            $to_area = Area::find($task->to_area);
            $vehicle = VehicleCustomer::where('timetable_id', $task->id)->first();
            $company = Company::find($task->company_id);
            if ($company != null) {
                $task->company_name = $company->name;
            } else {
                $task->company_name = "";
            }

            if ($from_area != null) {
                $task->from_area_name = $from_area->name;
            }

            if ($to_area != null) {
                $task->to_area_name = $to_area->name;
            }

            if ($vehicle != null) {
                $task->vehicle = Vehicle::find($vehicle->vehicle_id)->name;
            }

            if ($employee != null) {
                $task->employee_name = $employee->name;
            } else {
                $task->employee_name = "";
            }

            if ($status != null) {
                $task->status_name = $status->name;
            } else {
                $task->status_name = "";
            }

            if ($type != null) {
                $task->type_name = $type->name;
            } else {
                $task->type_name = "";
            }

            $task->oper_name = TimeTable::find($task->id)->name;
        }

        $alltypes = TaskType::all();
        $allstatus = TaskStatus::all();
        $allclients = Sheet::all();
        $menuid = $allinfo['menuid'];
        $users = User::all();

        //  return View('admin.timetable.alltasks', compact('alltimetables', 'menuid', 'users', 'alltypes', 'allstatus', 'allclients'));
        return View('admin.timetable.companyoperations', compact('alltimetables', 'menuid', 'users', 'alltypes', 'allstatus', 'allclients'));
    }

    public function companyoperations($menuid)
    {
        $parents = array();

        $manager = User::where('managerid', '=', \Auth()->user()->id);
        if ($manager != null) {
            $parents = $this->getchildren(\Auth()->user()->id);
        } else {
            $parents = $this->getParent(\Auth()->user()->id);
            //   $a = Arr::flatten($parents);
        }
        array_push($parents, \Auth()->user()->id);
        array_push($parents, 1);
        if (\Auth::user()->type == 1) {
            $alltimetables = TimeTable::where('timeid', 0)->where(function ($q) {
                $manager = User::where('managerid', '=', \Auth()->user()->id);
                if ($manager != null) {
                    $parents = $this->getchildren(\Auth()->user()->id);
                } else {
                    $parents = $this->getParent(\Auth()->user()->id);
                    //   $a = Arr::flatten($parents);
                }
                array_push($parents, \Auth()->user()->id);
                array_push($parents, 1);
                $q->whereIn('employee', $parents)->orWhereIn("user_id", $parents);
            })->where('company_id', '!=', null)->orderBy('time_tables.dydate', 'DESC')->get();
        } elseif (\Auth::user()->type == 0) {
            $alltimetables = TimeTable::select("time_tables.*")
                ->join('users', 'users.id', '=', 'time_tables.employee')
                ->where('timeid', 0)->where(function ($q) {

                $parents = array();

                $manager = User::where('managerid', '=', \Auth()->user()->id);
                if ($manager != null) {
                    $parents = $this->getchildren(\Auth()->user()->id);
                } else {
                    $parents = $this->getParent(\Auth()->user()->id);
                    //   $a = Arr::flatten($parents);
                }
                array_push($parents, \Auth()->user()->id);
                array_push($parents, 1);
                $q->whereIn('employee', $parents)->orWhereIn("user_id", $parents)
                    ->orWhere("users.managerid", \Auth::user()->id);
            })->where('company_id', '!=', null)->orderBy('time_tables.dydate', 'DESC')
                ->get();
        }

        foreach ($alltimetables as $task) {
            $employee = User::find($task->employee);
            $type = TaskType::find($task->taskType);
            $status = TaskStatus::find($task->meetingstate);
            $from_area = Area::find($task->from_area);
            $to_area = Area::find($task->to_area);
            $vehicle = VehicleCustomer::where('timetable_id', $task->id)->first();
            $company = Company::find($task->company_id);
            if ($company != null) {
                $task->company_name = $company->name;
            } else {
                $task->company_name = "";
            }

            if ($vehicle != null) {
                $task->vehicle = Vehicle::find($vehicle->vehicle_id)->name;
            }

            $task->oper_name = TimeTable::find($task->id)->name;
            if ($employee != null) {
                $task->employee_name = $employee->name;
            } else {
                $task->employee_name = "";
            }

            if ($from_area != null) {
                $task->from_area_name = $from_area->name;
            }

            if ($to_area != null) {
                $task->to_area_name = $to_area->name;
            }

            if ($status != null) {
                $task->status_name = $status->name;
            } else {
                $task->status_name = "";
            }

            if ($type != null) {
                $task->type_name = $type->name;
            } else {
                $task->type_name = "";
            }

        }
        $users = User::all();
        $alltypes = TaskType::all();
        $allstatus = TaskStatus::all();
        $allclients = Sheet::all();
        return View('admin.timetable.companyoperations', compact('alltimetables', 'menuid', 'users', 'alltypes', 'allstatus', 'allclients'));
    }
    public function companysearch(Request $request)
    {

        $allinfo = $request->all();

        if (\Auth::user()->type == 1) {
            $builder = TimeTable::where('timeid', 0)->where('added_value', '!=', null)
                ->orwhere('deduct_value', '!=', null);
            //::join('vehicle_services', 'time_tables.id', '=', 'vehicle_services.timetable_id')->where('timeid', 0)->where('vehicle_services.deleted_at', NULL);

            //

        } elseif (\Auth::user()->type == 0) {

            $builder = TimeTable::select("time_tables.*")->join('users', 'users.id', '=', 'time_tables.employee')
                ->where('added_value', '!=', null)
                ->orwhere('deduct_value', '!=', null)
            //    ->join('vehicle_services', 'time_tables.id', '=', 'vehicle_services.timetable_id')->where('vehicle_services.deleted_at', NULL)
                ->where('timeid', 0)->where(function ($q) {
                $q->where('employee', '=', \Auth::user()->id)->orWhere("users.managerid", \Auth::user()->id)
                    ->orWhere("user_id", \Auth::user()->id);
            });
        }
        if (!empty($allinfo['dydate'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('time_tables.dydate', '=', $allinfo['dydate'])
                    ->orWhere('time_tables.dydate', 'like', '%' . $allinfo['dydate'] . '%');
            });
        }
        if (!empty($allinfo['user_id'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('employee', '=', $allinfo['user_id']);
            });
        }

        if (!empty($allinfo['task_type'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('taskType', '=', $allinfo['task_type']);
            });
        }

        if (!empty($allinfo['task_status'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('meetingstate', '=', $allinfo['task_status']);
            });
        }

        if (!empty($allinfo['created_by'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('user_id', '=', $allinfo['created_by']);
            });
        }

        if (!empty($allinfo['client_id'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('sheet_id', '=', $allinfo['client_id']);
            });
        }

        if (!empty($allinfo['datefrom']) && !empty($allinfo['dateto']) && !$allinfo['datefrom'] == null && !$allinfo['dateto'] == null) {
            $builder->whereBetween('time_tables.dydate', [$allinfo['datefrom'], $allinfo['dateto']])
                ->orWhere('time_tables.dydate', 'like', '%' . $allinfo['datefrom'] . '%')
                ->orWhere('time_tables.dydate', 'like', '%' . $allinfo['dateto'] . '%');
        }

        $alltimetables = $builder->orderBy('time_tables.id', 'DESC')->get();

        foreach ($alltimetables as $task) {
            $employee = User::find($task->employee);
            $type = TaskType::find($task->taskType);
            $status = TaskStatus::find($task->meetingstate);
            $from_area = Area::find($task->from_area);
            $to_area = Area::find($task->to_area);
            $vehicle = VehicleCustomer::where('timetable_id', $task->id)->first();
            if ($from_area != null) {
                $task->from_area_name = $from_area->name;
            }

            if ($to_area != null) {
                $task->to_area_name = $to_area->name;
            }

            if ($vehicle != null) {
                $task->vehicle = Vehicle::find($vehicle->vehicle_id)->name;
            }

            if ($employee != null) {
                $task->employee_name = $employee->name;
            } else {
                $task->employee_name = "";
            }

            if ($status != null) {
                $task->status_name = $status->name;
            } else {
                $task->status_name = "";
            }

            if ($type != null) {
                $task->type_name = $type->name;
            } else {
                $task->type_name = "";
            }

            $task->oper_name = TimeTable::find($task->id)->name;
        }

        $alltypes = TaskType::all();
        $allstatus = TaskStatus::all();
        $allclients = Sheet::all();
        $menuid = $allinfo['menuid'];
        $users = User::all();

        //  return View('admin.timetable.alltasks', compact('alltimetables', 'menuid', 'users', 'alltypes', 'allstatus', 'allclients'));
        return View('admin.timetable.companyoperations', compact('alltimetables', 'menuid', 'users', 'alltypes', 'allstatus', 'allclients'));
    }

    public function get_tasks(Request $request)
    {
        $allopartions = \DB::table('time_tables')
            ->select('time_tables.*')
            ->where('sheet_id', $request->customer_id)->get();
        $operations = array();
        foreach ($allopartions as $item) {
            array_push($operations, array("id" => $item->id, "name" => $item->name));
        }

        $response = array(
            'status' => 'success',
            'operations' => $operations,
        );
        return response()->json($response);
    }

    public function report($menuid)
    {
        $currentTime = Carbon::now();
        $currentTime->toDateTimeString();
        $manager = User::where('managerid', '=', \Auth()->user()->id);
        if ($manager != null) {
            $parents = $this->getchildren(\Auth()->user()->id);
        } else {
            $parents = $this->getParent(\Auth()->user()->id);
            //   $a = Arr::flatten($parents);
        }
        array_push($parents, \Auth()->user()->id);
        array_push($parents, 1);
        $users = User::all();

        if (\Auth::user()->type == 1) {
            $alltimetables = TimeTable::where('time_tables.dydate', 'like', '%' . date('Y-m-d') . '%')->orderBy('time_tables.id', 'DESC')->where('timeid', 0)->get();
            //whereIn('employee', $parents)->orWhereIn("user_id", $parents)->get();

        } elseif (\Auth::user()->type == 0) {
            $alltimetables = TimeTable::join('users', 'users.id', '=', 'time_tables.employee')->where('time_tables.dydate', 'like', '%' . date('Y-m-d') . '%')->where('timeid', 0)
            // ->whereIn('employee', $parents)->orWhereIn("user_id", $parents)
                ->orderBy('time_tables.id', 'DESC')
                ->get();
        }
        $users = User::all();
        $total_money = 0;
        $paid = 0;
        $count1 = 0;
        $dydate = $currentTime->toDateTimeString();

        foreach ($alltimetables as $task) {
            $total_money += $task->total_money;
            $paid += $task->paid;
            $count1++;
            $dydate = $task->dydate;
            /* $employee = User::find($task->employee);
        $type = TaskType::find($task->taskType);
        $status = TaskStatus::find($task->meetingstate);

        if ($employee != null)
        $task->employee_name = $employee->name;
        else
        $task->employee_name = "";
        if ($status != null)
        $task->status_name = $status->name;
        else
        $task->status_name = "";
        if ($type != null)
        $task->type_name = $type->name;
        else
        $task->type_name = "";*/
        }
        /*   $alltypes = TaskType::all();
        $allstatus = TaskStatus::all();
        $allclients = Sheet::all();
        return View('admin.timetable.report', compact('count1', 'total_money', 'paid', 'alltimetables', 'menuid', 'users', 'alltypes', 'allstatus', 'allclients'));*/
        return View('admin.timetable.report', compact('count1', 'dydate', 'total_money', 'paid', 'alltimetables', 'menuid'));
    }
    public function companyreport($menuid)
    {
        $currentTime = Carbon::now();
        $currentTime->toDateTimeString();
        $manager = User::where('managerid', '=', \Auth()->user()->id);
        if ($manager != null) {
            $parents = $this->getchildren(\Auth()->user()->id);
        } else {
            $parents = $this->getParent(\Auth()->user()->id);
            //   $a = Arr::flatten($parents);
        }
        array_push($parents, \Auth()->user()->id);
        array_push($parents, 1);
        $users = User::all();

        if (\Auth::user()->type == 1) {
            $alltimetables = TimeTable::where('company_id', '!=', null)
                ->orderBy('time_tables.id', 'DESC')->where('timeid', 0)->get();
            //whereIn('employee', $parents)->orWhereIn("user_id", $parents)->get();

        } elseif (\Auth::user()->type == 0) {
            $alltimetables = TimeTable::where('company_id', '!=', null)
            //::join('users', 'users.id', '=', 'time_tables.employee')

            //->where('time_tables.dydate', 'like', '%' . date('Y-m-d') . '%')->where('timeid', 0)
            // ->whereIn('employee', $parents)->orWhereIn("user_id", $parents)
                ->orderBy('time_tables.id', 'DESC')
                ->get();
        }
        $users = User::all();
        $deduct_value = 0;
        $added_value = 0;
        $revenu = 0;
        $ma3krevnue = 0;
        //$paid = 0;
        $count1 = 0;
        $dydate = $currentTime->toDateTimeString();

        foreach ($alltimetables as $task) {
            //  $added_value+=$task->added_value;
            if ($task->added_value != null) {
                $ma3krevnue += $task->total_money;
            }

            if ($task->deduct_value != null) {
                $deduct_value += $task->deduct_value;
            }

            //  $deduct_value+=$task->deduct_value;
            //   $ma3krevnue += $task->total_money;
            $count1++;
            $dydate = $task->dydate;
        }
        //$revenu=$added_value+$deduct_value;
        $companies = Company::all();
        return View('admin.timetable.companyreport', compact('count1', 'companies', 'ma3krevnue', 'deduct_value', 'dydate', 'ma3krevnue', 'revenu', 'alltimetables', 'menuid'));
    }
    public function companyreportsearch(Request $request)
    {
        $companies = Company::all();
        $allinfo = $request->all();
        $menuid = $request->menuid;
        $currentTime = Carbon::now();
        //if (\Auth::user()->type == 1) {
        $builder = TimeTable::where('timeid', 0);
        if (!empty($allinfo['dydate'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('dydate', '=', $allinfo['dydate'])->orWhere('dydate', 'like', '%' . $allinfo['dydate'] . '%');
            });
        }
        if (!empty($allinfo['datefrom']) && !empty($allinfo['dateto']) && $allinfo['datefrom'] != null && $allinfo['dateto'] != null) {
            $builder->whereBetween('time_tables.dydate', [$allinfo['datefrom'], $allinfo['dateto']]);
            //   ->orWhere('time_tables.dydate', 'like', '%' . $allinfo['datefrom'] . '%')
            // ->orWhere('time_tables.dydate', 'like', '%' . $allinfo['dateto'] . '%');

        }
        if (!empty($allinfo['company_id'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('company_id', '=', $allinfo['company_id'])->orWhere('company_id', 'like', '%' . $allinfo['company_id'] . '%');
            });
        }
        $alltimetables = $builder->where('company_id', '!=', null)
            ->orderBy('time_tables.id', 'DESC')->get();
        $deduct_value = 0;
        $added_value = 0;
        $revenu = 0;
        $ma3krevnue = 0;

        $count1 = 0;
        $dydate = $currentTime->toDateTimeString();
        foreach ($alltimetables as $task) {
            //  $added_value+=$task->added_value;
            if ($task->added_value != null) {
                $ma3krevnue += $task->total_money;
            }

            if ($task->deduct_value != null) {
                $deduct_value += $task->deduct_value;
            }

            //  $deduct_value+=$task->deduct_value;
            //   $ma3krevnue += $task->total_money;
            $count1++;
            $dydate = $task->dydate;
        }
        $revenu = $added_value + $deduct_value;

        return View('admin.timetable.companyreport', compact('dydate', 'ma3krevnue', 'deduct_value', 'companies', 'count1', 'ma3krevnue', 'revenu', 'menuid', 'alltimetables'));
    }
    //!vehicle report
    public function vehicle_Report()
    {
        $results = TimeTable::join('vehicle_services', 'time_tables.id', '=', 'vehicle_services.timetable_id')
        ->join('users', 'time_tables.user_id', '=', 'users.id')
        ->join('vehicles', 'vehicle_services.vehicle_id', '=', 'vehicles.id')
        ->groupBy('users.name', 'vehicles.name')
        ->select('users.name as user_name', 'vehicles.name as vehicle_name', \DB::raw('COUNT(time_tables.id) as reservation_count'))
        ->get();
        
        // dd($results);
        // die();
        return view('admin.cars.report',compact('results'));
    }

    public static function get_childs($timeid)
    {
        $childs = TimeTable::where("timeid", $timeid)->get();
        foreach ($childs as $task) {
            $employee = User::find($task->employee);
            $type = TaskType::find($task->taskType);
            $status = TaskStatus::find($task->meetingstate);

            if ($employee != null) {
                $task->employee_name = $employee->name;
            } else {
                $task->employee_name = "";
            }

            if ($status != null) {
                $task->status_name = $status->name;
            } else {
                $task->status_name = "";
            }

            if ($type != null) {
                $task->type_name = $type->name;
            } else {
                $task->type_name = "";
            }

        }
        return $childs;
    }
    public function alltimes($menuid)
    {
        $parents = array();

        $parents = $this->getchildren(\Auth()->user()->id);
        array_push($parents, \Auth()->user()->id);
        //  array_push($parents, 1);
        if (\Auth::user()->type == 1) {
            $alltimetables = TimeTable::where('timeid', 0)->where('company_id', '=', null)->where(function ($q) {
                $parents = $this->getchildren(\Auth()->user()->id);

                array_push($parents, \Auth()->user()->id);
                // array_push($parents, 1);
                $q->whereIn('employee', $parents)->orWhereIn("user_id", $parents);
            })->orderBy('time_tables.dydate', 'DESC')->get();
        } elseif (\Auth::user()->type == 0) {
            $alltimetables = TimeTable::select("time_tables.*")
                ->join('users', 'users.id', '=', 'time_tables.employee')
                ->where('timeid', 0)->where('company_id', '=', null)->where(function ($q) {

                $parents = array();

                $manager = User::where('managerid', '=', \Auth()->user()->id);
                if ($manager != null) {
                    $parents = $this->getchildren(\Auth()->user()->id);
                } else {
                    $parents = $this->getParent(\Auth()->user()->id);
                    //   $a = Arr::flatten($parents);
                }
                array_push($parents, \Auth()->user()->id);
                // array_push($parents, 1);
                $q->whereIn('employee', $parents)->orWhereIn("user_id", $parents)->orWhere("users.managerid", \Auth::user()->id);
            })->orderBy('time_tables.dydate', 'DESC')
                ->get();
        }

        foreach ($alltimetables as $task) {
            $employee = User::find($task->employee);
            $type = TaskType::find($task->taskType);
            $status = TaskStatus::find($task->meetingstate);
            $from_area = Area::find($task->from_area);
            $to_area = Area::find($task->to_area);
            $vehicle = VehicleCustomer::where('timetable_id', $task->id)->first();
            if ($vehicle != null) {
                $task->vehicle = Vehicle::find($vehicle->vehicle_id)->name;
            }

            $task->oper_name = TimeTable::find($task->id)->name;
            if ($employee != null) {
                $task->employee_name = $employee->name;
            } else {
                $task->employee_name = "";
            }

            if ($from_area != null) {
                $task->from_area_name = $from_area->name;
            }

            if ($to_area != null) {
                $task->to_area_name = $to_area->name;
            }

            if ($status != null) {
                $task->status_name = $status->name;
            } else {
                $task->status_name = "";
            }

            if ($type != null) {
                $task->type_name = $type->name;
            } else {
                $task->type_name = "";
            }

        }
        $users = User::all();
        $alltypes = TaskType::all();
        $allstatus = TaskStatus::all();
        $allclients = Sheet::all();
        return View('admin.timetable.index', compact('alltimetables', 'menuid', 'users', 'alltypes', 'allstatus', 'allclients'));
    }
    public function alltimesreport($menuid)
    {
        $parents = array();

        $parents = $this->getchildren(\Auth()->user()->id);
        array_push($parents, \Auth()->user()->id);
        if (\Auth::user()->type == 1) {
            $alltimetables = TimeTable::where('timeid', 0)->where(function ($q) {
                $parents = $this->getchildren(\Auth()->user()->id);
                array_push($parents, \Auth()->user()->id);
                $q->whereIn('employee', $parents)->orWhereIn("user_id", $parents);
            })->orderBy('time_tables.dydate', 'DESC')->get();
        } elseif (\Auth::user()->type == 0) {
            $alltimetables = TimeTable::select("time_tables.*")
                ->join('users', 'users.id', '=', 'time_tables.employee')
                ->where('timeid', 0)->where(function ($q) {
                $parents = $this->getchildren(\Auth()->user()->id);
                array_push($parents, \Auth()->user()->id);
                $q->whereIn('employee', $parents)->orWhereIn("user_id", $parents)->orWhere("users.managerid", \Auth::user()->id);
            })->orderBy('time_tables.dydate', 'DESC')
                ->get();
        }

        foreach ($alltimetables as $task) {
            $employee = User::find($task->employee);
            $type = TaskType::find($task->taskType);
            $status = TaskStatus::find($task->meetingstate);
            $from_area = Area::find($task->from_area);
            $to_area = Area::find($task->to_area);
            $vehicle = VehicleCustomer::where('timetable_id', $task->id)->first();
            if ($vehicle != null) {
                $task->vehicle = Vehicle::find($vehicle->vehicle_id)->name;
            }

            $task->oper_name = TimeTable::find($task->id)->name;
            if ($employee != null) {
                $task->employee_name = $employee->name;
            } else {
                $task->employee_name = "";
            }

            if ($from_area != null) {
                $task->from_area_name = $from_area->name;
            }

            if ($to_area != null) {
                $task->to_area_name = $to_area->name;
            }

            if ($status != null) {
                $task->status_name = $status->name;
            } else {
                $task->status_name = "";
            }

            if ($type != null) {
                $task->type_name = $type->name;
            } else {
                $task->type_name = "";
            }

        }
        $users = User::all();
        $alltypes = TaskType::all();
        $allstatus = TaskStatus::all();
        $allclients = Sheet::all();
        return View('admin.timetable.indexreport', compact('alltimetables', 'menuid', 'users', 'alltypes', 'allstatus', 'allclients'));
    }

    public function alltimes1($menuid)
    {

        $parents = $this->getchildren(\Auth()->user()->id);
        array_push($parents, \Auth()->user()->id);

        if (\Auth::user()->type == 1) {
            $alltimetables = TimeTable::where('timeid', 0)->where(function ($q) {
                $parents = $this->getchildren(\Auth()->user()->id);
                array_push($parents, \Auth()->user()->id);
                $q->whereIn('employee', $parents)->orWhereIn("user_id", $parents);
            })->orderBy('time_tables.id', 'DESC')->get();
        } elseif (\Auth::user()->type == 0) {
            $alltimetables = TimeTable::select("time_tables.*")->join('users', 'users.id', '=', 'time_tables.employee')->where('timeid', 0)->where(function ($q) {
                $parents = $this->getchildren(\Auth()->user()->id);
                array_push($parents, \Auth()->user()->id);
                $q->whereIn('employee', $parents)->orWhereIn("user_id", $parents)->orWhere("users.managerid", \Auth::user()->id);
            })->orderBy('time_tables.id', 'DESC')->get();
        }
        foreach ($alltimetables as $task) {
            $employee = User::find($task->employee);
            $type = TaskType::find($task->taskType);
            $status = TaskStatus::find($task->meetingstate);

            $from_area = Area::find($task->from_area);
            $to_area = Area::find($task->to_area);
            $vehicle = VehicleCustomer::where('timetable_id', $task->id)->first();
            if ($vehicle->vehicle_id != null) {
                $task->vehicle = Vehicle::find($vehicle->vehicle_id)->name;
            }

            if ($from_area != null) {
                $task->from_area_name = $from_area->name;
            }

            if ($to_area != null) {
                $task->to_area_name = $to_area->name;
            }

            if ($employee != null) {
                $task->employee_name = $employee->name;
            } else {
                $task->employee_name = "";
            }

            if ($status != null) {
                $task->status_name = $status->name;
            } else {
                $task->status_name = "";
            }

            if ($type != null) {
                $task->type_name = $type->name;
            } else {
                $task->type_name = "";
            }

            $task->oper_name = TimeTable::find($task->id)->name;
        }
        $users = User::all();
        $alltypes = TaskType::all();
        $allstatus = TaskStatus::all();
        $allclients = Sheet::all();
        return View('admin.timetable.alltasks', compact('alltimetables', 'menuid', 'users', 'alltypes', 'allstatus', 'allclients'));
    }
    public function create($menuid)
    {
        $allusers = User::all();
        $allstatus = TaskStatus::all();
        $alltypes = TaskType::all();
        $allvehicles = Vehicle::all();
        $toareas = Area::all();
        $fromareas = Area::all();
        $user_id = \Auth()->user()->id;
        $allcompanies = Company::all();
        $allcustomers = Sheet::all();
        /* if (\Auth::user()->type == 1) {
        $allcustomers = Sheet::all();
        }

        elseif (\Auth::user()->type == 0) {
        $allcustomers = Sheet::where('user_id', '=', \Auth::user()->id)->get();
        }*/
        // dd($fromareas);
        return View('admin.timetable.add', compact('menuid', 'allcompanies', 'toareas', 'fromareas', 'allvehicles', 'allcustomers', 'allusers', 'allstatus', 'alltypes', 'user_id'));
    }
    public function create1($menuid, $user_id)
    {
        $allusers = User::all();
        $allstatus = TaskStatus::all();
        $alltypes = TaskType::all();
        $allvehicles = Vehicle::all();
        $toareas = Area::all();
        $fromareas = Area::all();
        if (\Auth::user()->type == 1) {
            $allcustomers = Sheet::all();
        } elseif (\Auth::user()->type == 0) {
            $allcustomers = Sheet::where('user_id', '=', \Auth::user()->id)->get();
        }
        return View('admin.timetable.add', compact('menuid', 'toareas', 'fromareas', 'allvehicles', 'allcustomers', 'allusers', 'allstatus', 'alltypes', 'user_id'));
    }

    /*public function store(StoreTimeTable $request)
    //  public function store(Request $request)
    {
    $this->validate(
    $request,
    ['id' => 'required|unique: time_tables'],
    ['id.unique' => 'هذا الكود موجود من قبل']
    );
    $data = $request->all();
    $newtimetable = new TimeTable();
    $newtimetable->time = $data['time'];
    //$newtimetable->dydate = $data['dydate'];
    //$newtimetable->meetingplace = $data['meetingplace'];
    $newtimetable->note = $data['note'];
    $newtimetable->meetingstate = $data['meetingstate'];
    $newtimetable->created_at = $data['created_at'];
    if (!empty($data['total_money'])) {
    $newtimetable->total_money = $data['total_money'];
    }
    if (!empty($data['paid'])) {
    $newtimetable->paid = $data['paid'];
    }
    if (!empty($data['desrved_date'])) {
    $newtimetable->desrved_date = $data['desrved_date'];
    }

    $newtimetable->sheet_id = $data['the-filter'];
    $newtimetable->user_id = \Auth::user()->id;
    $newtimetable->taskType = $data['tasktype'];
    $newtimetable->employee = $data['employee'];
    $newtimetable->save();
    if ($data['repeat'] > 1) {
    for ($i = 1; $i < $data['repeat']; $i++) {
    $newtime = new TimeTable();
    $newtime->refer = $newtimetable->id;
    $newtime->save();
    }
    }
    return redirect()->route('admin.timetable.index', $data['menuid']);
    // dd($data);
    }*/
    public function store1(StoreTimeTable $request)
    {
        $data = $request->all();

        $newtimetable = new TimeTable();
        $newtimetable->time = $data['time'];
        $newtimetable->dydate = $data['dydate'];
        $newtimetable->name = $data['name'];
        //$newtimetable->meetingplace = $data['meetingplace'];
        $newtimetable->note = $data['note'];
        $newtimetable->from_area = $data['from_area'];
        $newtimetable->to_area = $data['to_area'];

        $newtimetable->meetingstate = $data['meetingstate'];
        //  $newtimetable->created_at = $data['dydate'];
        if (!empty($data['total_money'])) {
            $newtimetable->total_money = $data['total_money'];
        }
        if (!empty($data['paid']) && !empty($data['accounttype'])) {
            $newtimetable->paid = $data['paid'];
        }
        if (!empty($data['desrved_date'])) {
            $newtimetable->desrved_date = $data['desrved_date'];
        }
        /*if( $data['meetingstate'] == 2 ){
        if(isset($data['cancelreason'])){
        $newtimetable->cancelreason = $data['cancelreason'];
        }
        }*/
        $sheet_id = \Illuminate\Support\Str::before($data['sheet_id'], '---');
        $newtimetable->sheet_id = $sheet_id;
        $newtimetable->user_id = \Auth::user()->id;
        $newtimetable->taskType = $data['tasktype'];
        $newtimetable->employee = $data['employee'];
        $newtimetable->company_id = $data['company_id'];
        $newtimetable->service_cost = $data['service_cost'];
        $newtimetable->wait_cost = $data['wait_cost'];
        $newtimetable->direction = $data['direction'];
        if (isset($data['company_id'])) {
            $Perc_value = (Company::where('id', '=', $data['company_id'])->first())->perc;

            if ($data['accounttype'] == 'perc' && $data['Deal'] == 'add') {
                $newtimetable->added_value = $data['total_money'] - (($data['total_money'] * $Perc_value) / 100);
                $newtimetable->total_money = ($data['total_money'] * $Perc_value) / 100;
                // $newtimetable->paid =  $data['paid']-(($data['paid'] * $Perc_value) / 100);
            } elseif ($data['accounttype'] == 'perc' && $data['Deal'] == 'deduct') {
                $newtimetable->deduct_value = ($data['total_money'] * $Perc_value) / 100;
                $newtimetable->total_money = $data['total_money'] - (($data['total_money'] * $Perc_value) / 100);
            } elseif ($data['accounttype'] == 'value' && $data['Deal'] == 'add') {
                $newtimetable->added_value = $data['total_money'] - $data['dealvalue'];
                $newtimetable->total_money = $data['total_money'];
            } elseif ($data['accounttype'] == 'value' && $data['Deal'] == 'deduct') {
                $newtimetable->deduct_value = $data['dealvalue'];
                $newtimetable->total_money = $data['total_money'] - $data['dealvalue'];
            }
        }
        $newtimetable->save();
        /* if ($data['repeat'] > 1) {
        for ($i = 1; $i < $data['repeat']; $i++) {
        $newtime = new TimeTable();
        $newtime->refer = $newtimetable->id;
        $newtime->save();
        }
        }*/
        // save Disease
        if (isset($data['vehicle_id'])) {
            foreach ($data['vehicle_id'] as $vehiclee) {
                if ($vehiclee != "") {
                    $newvehicle = new vehicleCustomer();
                    $newvehicle->vehicle_id = $vehiclee;
                    $newvehicle->timetable_id = $newtimetable->id; //\Auth::user()->id; // $newsheet->id;
                    $newvehicle->save();
                }
            }
        }
        if (isset($data['saveandclose']) && $data['saveandclose'] = "save&close") {
            // return redirect()->route('timetable.index', $data['menuid']);
            return redirect()->route('timetable.alltimes', $data['menuid']);
        } else if (isset($data['saveandnew']) && $data['saveandnew'] = "save&new") {
            return redirect()->route('timetable.create', $data['menuid']);
        }
        //  return redirect()->route('timetable.index', $data['menuid']);
    }
    public function searchclientoperationreport(Request $request)
    {
        $allinfo = $request->all();
        $menuid = $request->menuid;
        $currentTime = Carbon::now();
        if (\Auth::user()->type == 1) {
            $builder = TimeTable::select(
                'time_tables.id',
                'time_tables.direction',
                'sheets.name as customer_name',
                'sheets.customer_weight as customer_weight',
                'sheets.customer_type as customer_type',
                'sheets.address',
                'diseases.name as disease_name',
                'phones.phone as customer_phone',
                'from_area.name as from_area',
                'to_area.name as to_area',
                'time_tables.service_cost',
                'time_tables.wait_cost',
                'time_tables.total_money',
                'time_tables.name as operation_name',
                'vehicles.name as vehicle_name'
            )
                ->join('users', 'users.id', '=', 'time_tables.employee')
                ->join('sheets', 'sheets.id', '=', 'time_tables.sheet_id')
                ->join('phones', 'sheets.id', '=', 'phones.sheet_id')
                ->join('disease_services', 'sheets.id', '=', 'disease_services.customer_id')
                ->join('diseases', 'diseases.id', '=', 'disease_services.disease_id')
                ->join('areas as from_area', 'from_area.id', '=', 'time_tables.from_area')
                ->join('areas as to_area', 'to_area.id', '=', 'time_tables.to_area')
                ->join('vehicle_services', 'time_tables.id', '=', 'vehicle_services.timetable_id')
                ->join('vehicles', 'vehicle_services.vehicle_id', '=', 'vehicles.id')
                ->where('timeid', 0)->where('vehicle_services.deleted_at', null);
        } elseif (\Auth::user()->type == 0) {

            $builder = TimeTable::select(
                'time_tables.id',
                'time_tables.direction',
                'sheets.name as customer_name',
                'sheets.customer_weight as customer_weight',
                'sheets.customer_type as customer_type',
                'sheets.address',
                'diseases.name as disease_name',
                'phones.phone as customer_phone',
                'from_area.name as from_area',
                'to_area.name as to_area',
                'time_tables.service_cost',
                'time_tables.wait_cost',
                'time_tables.total_money',
                'time_tables.name as operation_name',
                'vehicles.name as vehicle_name'
            )
                ->join('users', 'users.id', '=', 'time_tables.employee')
                ->join('sheets', 'sheets.id', '=', 'time_tables.sheet_id')
                ->join('phones', 'sheets.id', '=', 'phones.sheet_id')
                ->join('disease_services', 'sheets.id', '=', 'disease_services.customer_id')
                ->join('diseases', 'diseases.id', '=', 'disease_services.disease_id')
                ->join('areas as from_area', 'from_area.id', '=', 'time_tables.from_area')
                ->join('areas as to_area', 'to_area.id', '=', 'time_tables.to_area')
                ->join('vehicle_services', 'time_tables.id', '=', 'vehicle_services.timetable_id')
                ->join('vehicles', 'vehicle_services.vehicle_id', '=', 'vehicles.id')
                ->where('vehicle_services.deleted_at', null)
                ->where(function ($q) {
                    $q->where('employee', '=', \Auth::user()->id)->orWhere("users.managerid", \Auth::user()->id);
                });
        }
        if (!empty($allinfo['dydate'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('time_tables.dydate', '=', $allinfo['dydate'])->orWhere('time_tables.dydate', 'like', '%' . $allinfo['dydate'] . '%');
            });
        }

        $alltimetables = $builder->orderBy('time_tables.id', 'DESC')->get();

        return View('admin.timetable.clientoperationreport', compact('menuid', 'alltimetables'));
    }
    //clientoperationreport
    public function clientoperationreport($menuid, Request $request)
    {
        $allinfo = $request->all();
        $menuid = $request->menuid;
        $currentTime = Carbon::now();
        if (\Auth::user()->type == 1) {
            $builder = TimeTable::select(
                'time_tables.id',
                'time_tables.dydate',
                'time_tables.direction',
                'sheets.name as customer_name',
                'sheets.customer_weight as customer_weight',
                'sheets.customer_type as customer_type',
                'sheets.address',
                'diseases.name as disease_name',
                'phones.phone as customer_phone',
                'from_area.name as from_area',
                'to_area.name as to_area',
                'time_tables.service_cost',
                'time_tables.wait_cost',
                'time_tables.total_money',
                'time_tables.name as operation_name',
                'vehicles.name as vehicle_name'
            )
            //  ->join('users', 'users.id', '=', 'time_tables.employee')
                ->join('sheets', 'sheets.id', '=', 'time_tables.sheet_id')
                ->join('phones', 'sheets.id', '=', 'phones.sheet_id')
                ->join('disease_services', 'sheets.id', '=', 'disease_services.customer_id')
                ->join('diseases', 'diseases.id', '=', 'disease_services.disease_id')
                ->join('areas as from_area', 'from_area.id', '=', 'time_tables.from_area')
                ->join('areas as to_area', 'to_area.id', '=', 'time_tables.to_area')
                ->join('vehicle_services', 'time_tables.id', '=', 'vehicle_services.timetable_id')
                ->join('vehicles', 'vehicle_services.vehicle_id', '=', 'vehicles.id')->distinct('time_tables.id')
                ->where('timeid', 0)->where('vehicle_services.deleted_at', null);
        } elseif (\Auth::user()->type == 0) {

            $builder = TimeTable::select(
                'time_tables.id',
                'time_tables.direction',
                'time_tables.dydate',
                'sheets.name as customer_name',
                'sheets.customer_weight as customer_weight',
                'sheets.customer_type as customer_type',
                'sheets.address',
                'diseases.name as disease_name',
                'phones.phone as customer_phone',
                'from_area.name as from_area',
                'to_area.name as to_area',
                'time_tables.service_cost',
                'time_tables.wait_cost',
                'time_tables.total_money',
                'time_tables.name as operation_name',
                'vehicles.name as vehicle_name'
            )
                ->join('users', 'users.id', '=', 'time_tables.employee')
                ->join('sheets', 'sheets.id', '=', 'time_tables.sheet_id')
                ->join('phones', 'sheets.id', '=', 'phones.sheet_id')
                ->join('disease_services', 'sheets.id', '=', 'disease_services.customer_id')
                ->join('diseases', 'diseases.id', '=', 'disease_services.disease_id')
                ->join('areas as from_area', 'from_area.id', '=', 'time_tables.from_area')
                ->join('areas as to_area', 'to_area.id', '=', 'time_tables.to_area')
                ->join('vehicle_services', 'time_tables.id', '=', 'vehicle_services.timetable_id')
                ->join('vehicles', 'vehicle_services.vehicle_id', '=', 'vehicles.id')->distinct('time_tables.id')
                ->where('vehicle_services.deleted_at', null)
                ->where(function ($q) {
                    $q->where('employee', '=', \Auth::user()->id)->orWhere("users.managerid", \Auth::user()->id);
                });
        }
        if (!empty($allinfo['dydate'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('time_tables.dydate', '=', $allinfo['dydate'])->orWhere('time_tables.dydate', 'like', '%' . $allinfo['dydate'] . '%');
            });
        }

        /* if (!empty($allinfo['datefrom']) && !empty($allinfo['dateto']) && $allinfo['datefrom'] != null && $allinfo['dateto'] != null) {
        $builder->whereBetween('time_tables.dydate', [$allinfo['datefrom'], $allinfo['dateto']]);
        }
         */

        $alltimetables = $builder->orderBy('time_tables.id', 'DESC')->get();

        //dd($alltimetables);
        //   dd($alltimetables);
        /*  $total_money = 0;
        $paid = 0;
        $count1 = 0;
        $dydate = $currentTime->toDateTimeString();
        foreach ($alltimetables as $task) {
        $list = \DB::table('vehicle_services')->select('vehicle_services.*')->where('timetable_id', '=', $task->timetable_id)->where('vehicle_services.deleted_at', NULL)->get();
        $task->count1 += $list->count();
        $count1 += $list->count();
        $total_money += $task->total_money;
        $paid += $task->paid;
        //  $count1++;
        $task->name = $task->name;
        $dydate = $task->dydate;
        }*/
        return View('admin.timetable.clientoperationreport', compact('menuid', 'alltimetables'));
    }
    public function edit(TimeTable $timetable, $menuid)
    {
        $allusers = User::all();
        $allstatus = TaskStatus::all();
        $alltypes = TaskType::all();
        $toareas = Area::all();
        $fromareas = Area::all();
        $allvehicles = Vehicle::all();
        // dd($timetable);
        $vehicle1 = (VehicleCustomer::where('timetable_id', $timetable->id)->get());

        if (\Auth::user()->type == 1) {
            $allcustomers = Sheet::all();
        } elseif (\Auth::user()->type == 0) {
            $allcustomers = Sheet::where('user_id', '=', \Auth::user()->id)->get();
        }
        //dd($timetable);
        return View('admin.timetable.edit', compact('timetable', 'allvehicles', 'vehicle1', 'toareas', 'fromareas', 'menuid', 'allcustomers', 'allusers', 'allstatus', 'alltypes'));
    }

    public function update(StoreTimeTable $request, TimeTable $timetable)
    {
        // $newtimetable = new TimeTable();
        $data = $request->all();
        $timetable->time = $data['time'];
        $timetable->dydate = $data['dydate'];
        //$timetable->meetingplace = $data['meetingplace'];
        $timetable->note = $data['note'];
        $timetable->name = $data['name'];
        $timetable->from_area = $data['from_area'];
        $timetable->to_area = $data['to_area'];

        $timetable->meetingstate = $data['meetingstate'];
        //$newtimetable->created_at = $data['dydate'];
        $timetable->sheet_id = $data['sheet_id'];
        $timetable->user_id = \Auth::user()->id;
        /*if( $data['meetingstate'] == 2 ){
        if(isset($data['cancelreason'])){
        $timetable->cancelreason = $data['cancelreason'];
        }
        }*/
        $timetable->taskType = $data['tasktype'];
        $timetable->employee = $data['employee'];
        /*  if ($timetable->timeid == 0) {
        $timetable->timeid = $timetable->id;
        }
        else {
        $timetable->timeid = $timetable->timeid;
        }*/
        if (!empty($data['total_money'])) {
            $timetable->total_money = $data['total_money'];
        }
        if (!empty($data['paid'])) {
            $timetable->paid = $data['paid'];
        }
        if (!empty($data['desrved_date'])) {
            $timetable->desrved_date = $data['desrved_date'];
        }
        // save Vehicle
        VehicleCustomer::where('timetable_id', '=', $timetable->id)->delete();
        if (isset($data['vehicle_id'])) {
            foreach ($data['vehicle_id'] as $vehiclee) {
                if ($vehiclee != "") {
                    $newvehicle = new vehicleCustomer();
                    $newvehicle->vehicle_id = $vehiclee;
                    $newvehicle->timetable_id = $timetable->id; //\Auth::user()->id; // $newsheet->id;
                    $newvehicle->save();
                }
            }
        }
        $timetable->save();

        // return redirect()->route('timetable.index', $data['menuid']);
        return redirect()->route('timetable.alltimes', $data['menuid']);
    }

    public function destory(TimeTable $timetable, $menuid)
    {

        $deleted = Timetable::where('id', $timetable->id)->delete();
        //dd($timetable->id);
        //$timetable->delete();
        return redirect()->route('timetable.index', $menuid);
    }

    public function funtoundone(TimeTable $timetable, $menuid)
    {
        $timetable->meetingstate = 0;
        $timetable->save();
        return redirect()->route('timetable.index', $menuid);
    }

    public function funtodone(TimeTable $timetable, $menuid)
    {
        $timetable->meetingstate = 1;
        $timetable->save();
        return redirect()->route('timetable.index', $menuid);
    }

    public function timetablesearch(Request $request)
    {

        $allinfo = $request->all();

        if (\Auth::user()->type == 1) {
            $builder = TimeTable::where('timeid', 0)->where('company_id', '=', null);
            //::join('vehicle_services', 'time_tables.id', '=', 'vehicle_services.timetable_id')->where('timeid', 0)->where('vehicle_services.deleted_at', NULL);

            //

        } elseif (\Auth::user()->type == 0) {

            $builder = TimeTable::select("time_tables.*")->join('users', 'users.id', '=', 'time_tables.employee')
            //    ->join('vehicle_services', 'time_tables.id', '=', 'vehicle_services.timetable_id')->where('vehicle_services.deleted_at', NULL)
                ->where('timeid', 0)->where('company_id', '=', null)->where(function ($q) {
                $q->where('employee', '=', \Auth::user()->id)->orWhere("users.managerid", \Auth::user()->id)
                    ->orWhere("user_id", \Auth::user()->id);
            });
        }
        if (!empty($allinfo['dydate'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('time_tables.dydate', '=', $allinfo['dydate'])
                    ->orWhere('time_tables.dydate', 'like', '%' . $allinfo['dydate'] . '%');
            });
        }
        if (!empty($allinfo['user_id'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('employee', '=', $allinfo['user_id']);
            });
        }

        if (!empty($allinfo['task_type'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('taskType', '=', $allinfo['task_type']);
            });
        }

        if (!empty($allinfo['task_status'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('meetingstate', '=', $allinfo['task_status']);
            });
        }

        if (!empty($allinfo['created_by'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('user_id', '=', $allinfo['created_by']);
            });
        }

        if (!empty($allinfo['client_id'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('sheet_id', '=', $allinfo['client_id']);
            });
        }
        /* if (!empty($allinfo['dydate']) && !$allinfo['dydate'] == null) {
        $builder->where(function ($query) use ($allinfo) {
        $query->where('time_tables.created_at', '=', $allinfo['dydate'])
        ->orWhere('time_tables.created_at', 'like', '%' . $allinfo['dydate'] . '%');
        });
        }*/

        if (!empty($allinfo['datefrom']) && !empty($allinfo['dateto']) && !$allinfo['datefrom'] == null && !$allinfo['dateto'] == null) {
            $builder->whereBetween('time_tables.dydate', [$allinfo['datefrom'], $allinfo['dateto']])
                ->orWhere('time_tables.dydate', 'like', '%' . $allinfo['datefrom'] . '%')
                ->orWhere('time_tables.dydate', 'like', '%' . $allinfo['dateto'] . '%');
        }

        $alltimetables = $builder->orderBy('time_tables.id', 'DESC')->get();

        foreach ($alltimetables as $task) {
            $employee = User::find($task->employee);
            $type = TaskType::find($task->taskType);
            $status = TaskStatus::find($task->meetingstate);
            $from_area = Area::find($task->from_area);
            $to_area = Area::find($task->to_area);
            $vehicle = VehicleCustomer::where('timetable_id', $task->id)->first();
            if ($from_area != null) {
                $task->from_area_name = $from_area->name;
            }

            if ($to_area != null) {
                $task->to_area_name = $to_area->name;
            }

            if ($vehicle != null) {
                $task->vehicle = Vehicle::find($vehicle->vehicle_id)->name;
            }

            if ($employee != null) {
                $task->employee_name = $employee->name;
            } else {
                $task->employee_name = "";
            }

            if ($status != null) {
                $task->status_name = $status->name;
            } else {
                $task->status_name = "";
            }

            if ($type != null) {
                $task->type_name = $type->name;
            } else {
                $task->type_name = "";
            }

            $task->oper_name = TimeTable::find($task->id)->name;
        }

        $alltypes = TaskType::all();
        $allstatus = TaskStatus::all();
        $allclients = Sheet::all();
        $menuid = $allinfo['menuid'];
        $users = User::all();

        //  return View('admin.timetable.alltasks', compact('alltimetables', 'menuid', 'users', 'alltypes', 'allstatus', 'allclients'));
        return View('admin.timetable.index', compact('alltimetables', 'menuid', 'users', 'alltypes', 'allstatus', 'allclients'));
    }
    public function reportsearchvehicle(Request $request)
    {
        $allinfo = $request->all();
        $menuid = $request->menuid;
        $currentTime = Carbon::now();
        if (\Auth::user()->type == 1) {
            $builder = TimeTable
                ::join('vehicle_services', 'time_tables.id', '=', 'vehicle_services.timetable_id')->where('timeid', 0)->where('vehicle_services.deleted_at', null);
        } elseif (\Auth::user()->type == 0) {

            $builder = TimeTable::join('users', 'users.id', '=', 'time_tables.employee')
                ->join('vehicle_services', 'time_tables.id', '=', 'vehicle_services.timetable_id')->where('vehicle_services.deleted_at', null)
                ->where(function ($q) {
                    $q->where('employee', '=', \Auth::user()->id)->orWhere("users.managerid", \Auth::user()->id);
                });
        }
        if (!empty($allinfo['dydate'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('time_tables.dydate', '=', $allinfo['dydate'])->orWhere('time_tables.dydate', 'like', '%' . $allinfo['dydate'] . '%');
            });
        }
        if (!empty($allinfo['vehicle'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('vehicle_services.vehicle_id', '=', $allinfo['vehicle']);
                // ->orWhere('vehicle_services.vehicle_id', 'like', '%' . $allinfo['vehicle_services.vehicle_id'] . '%');
            });
        }

        if (!empty($allinfo['datefrom']) && !empty($allinfo['dateto']) && $allinfo['datefrom'] != null && $allinfo['dateto'] != null) {
            $builder->whereBetween('time_tables.dydate', [$allinfo['datefrom'], $allinfo['dateto']]);
            //    ->orWhere('time_tables.dydate', 'like', '%' . $allinfo['datefrom'] . '%')
            // ->orWhere('time_tables.dydate', 'like', '%' . $allinfo['dateto'] . '%');
        }
        if (!empty($allinfo['operation']) && $allinfo['operation'] != null) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('time_tables.id', '=', $allinfo['operation']);
                //  ->orWhere('time_tables.id', 'like', '%' . $allinfo['time_tables.id'] . '%');
            });
        }

        $alltimetables = $builder->orderBy('time_tables.id', 'DESC')->get();
        //   dd($alltimetables);

        $alloperations = TimeTable::all();
        $allvehicles = Vehicle::all();

        //   dd($alltimetables);
        $total_money = 0;
        $paid = 0;
        $count1 = 0;
        $dydate = $currentTime->toDateTimeString();
        foreach ($alltimetables as $task) {
            $list = \DB::table('vehicle_services')->select('vehicle_services.*')->where('timetable_id', '=', $task->timetable_id)->where('vehicle_services.deleted_at', null)->get();
            $task->count1 += $list->count();
            $count1 += $list->count();
            $total_money += $task->total_money;
            $paid += $task->paid;
            //  $count1++;
            $task->name = $task->name;
            $dydate = $task->dydate;
        }
        return View('admin.timetable.reportvehicles', compact('alloperations', 'allvehicles', 'dydate', 'count1', 'total_money', 'paid', 'menuid', 'alltimetables'));
    }
    public function reportsearch(Request $request)
    {
        $allinfo = $request->all();
        $menuid = $request->menuid;
        $currentTime = Carbon::now();
        //if (\Auth::user()->type == 1) {
        $builder = TimeTable::where('timeid', 0);
        //}
        /*  elseif (\Auth::user()->type == 0) {
        $builder = TimeTable::join('users', 'users.id', '=', 'time_tables.employee')->where(function ($q) {
        $q->where('employee', '=', \Auth::user()->id)->orWhere("users.managerid", \Auth::user()->id)
        ->orWhere("user_id", \Auth::user()->id);
        });
        }*/
        if (!empty($allinfo['dydate'])) {
            $builder->where(function ($query) use ($allinfo) {
                $query->where('dydate', '=', $allinfo['dydate'])->orWhere('dydate', 'like', '%' . $allinfo['dydate'] . '%');
            });
        }
        if (!empty($allinfo['datefrom']) && !empty($allinfo['dateto']) && $allinfo['datefrom'] != null && $allinfo['dateto'] != null) {
            $builder->whereBetween('time_tables.dydate', [$allinfo['datefrom'], $allinfo['dateto']])
                ->orWhere('time_tables.dydate', 'like', '%' . $allinfo['datefrom'] . '%')
                ->orWhere('time_tables.dydate', 'like', '%' . $allinfo['dateto'] . '%');
        }

        $alltimetables = $builder->orderBy('time_tables.id', 'DESC')->get();
        // dd($alltimetables);
        $total_money = 0;
        $paid = 0;
        $count1 = 0;
        $dydate = $currentTime->toDateTimeString();
        foreach ($alltimetables as $task) {
            $total_money += $task->total_money;
            $paid += $task->paid;
            $count1++;
            $dydate = $task->dydate;
        }
        return View('admin.timetable.report', compact('dydate', 'count1', 'total_money', 'paid', 'menuid', 'alltimetables'));
    }
    public function reportvehicle($menuid)
    {
        //  dd("tetetetettt");
        $currentTime = Carbon::now();
        $currentTime->toDateTimeString();
        $manager = User::where('managerid', '=', \Auth()->user()->id);
        if ($manager != null) {
            $parents = $this->getchildren(\Auth()->user()->id);
        } else {
            $parents = $this->getParent(\Auth()->user()->id);
            //   $a = Arr::flatten($parents);
        }
        array_push($parents, \Auth()->user()->id);
        array_push($parents, 1);
        $users = User::all();

        if (\Auth::user()->type == 1) {
            $alltimetables = TimeTable::where('created_at', 'like', '%' . date('Y-m-d') . '%')
                ->orderBy('id', 'DESC')
            //->where('timeid', 0)
            //->whereIn('user_id', $parents)
                ->get();
        } elseif (\Auth::user()->type == 0) {
            $alltimetables = TimeTable::where('time_tables.dydate', 'like', '%' . date('Y-m-d') . '%')
            //->orderBy('time_tables.id', 'DESC');
            //->where('timeid', 0)
            //  whereIn('user_id', $parents)
                ->orderBy('time_tables.id', 'DESC')
                ->get();
            //::join('users', 'users.id', '=', 'time_tables.employee')
        }
        $alloperations = TimeTable::all();
        $allvehicles = Vehicle::all();
        $users = User::all();
        $total_money = 0;
        $paid = 0;
        $count1 = 0;
        $dydate = $currentTime->toDateTimeString();
        foreach ($alltimetables as $task) {
            // $total_money = $task->total_money;
            //$paid = $task->paid;
            //$name = $task->name;
            // $list = CustomerService::where('customer_id', '=', $task->user_id)->get();
            $list = \DB::table('vehicle_services')->select('vehicle_services.*')
                ->where('timetable_id', '=', $task->id)->where('vehicle_services.deleted_at', null)->get();
            //  $task->count1 = $list->count();
            $count1 += $list->count();

            $task->name = $task->name;
            $total_money += $task->total_money;
            $paid += $task->paid;
            //$count1++;

            $dydate = $task->dydate;
        }
        // dd($alltimetables);
        return View('admin.timetable.reportvehicles', compact('alloperations', 'allvehicles', 'menuid', 'count1', 'dydate', 'total_money', 'paid', 'alltimetables'));

        //  return View('admin.timetable.reportvehicles', compact('dydate', 'count1', 'total_money', 'paid', 'menuid', 'alltimetables'));
    }
}
