<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activite;
use App\GroupMenuPermissions;
use App\Menu;
use App\Http\Requests\StoreTimeTable;
use App\TimeTable;
use App\Sheet;
use App\User;
use App\TaskType;
use App\TaskStatus;

class calenderController extends Controller
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
        if ($manager != null) {
            $parents = $this->getchildren(\Auth()->user()->id);
        }
        else {
            $parents = $this->getParent(\Auth()->user()->id);
        }
        array_push($parents, \Auth()->user()->id);
        array_push($parents, 1);
        $users = User::all();

        if (\Auth::user()->type == 1) {
            //where('created_at', 'like', '%' . date('Y-m-d') . '%')->
            $tasks = TimeTable::where('dydate', '!=', 'null')->orderBy('id', 'DESC')->whereIn('employee', $parents)->get();

        }
        elseif (\Auth::user()->type == 0) {

            //->where('time_tables.created_at', 'like', '%' . date('Y-m-d') . '%')

            $tasks = TimeTable::join('users', 'users.id', '=', 'time_tables.employee')
                ->where('timeid', 0)->whereIn('employee', $parents)->orderBy('time_tables.id', 'DESC')

                ->get();
        }

        $users = User::all();
        foreach ($tasks as $task) {
            $employee = User::find($task->employee);
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
                $task->type_name = "";

        }
        $alltypes = TaskType::all();
        $allstatus = TaskStatus::all();
        $allclients = Sheet::all();
        // dd($tasks);
        return View('admin.calender.index', compact('tasks', 'menuid', 'users', 'alltypes', 'allstatus', 'allclients'));
    }

}
