<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Sheet;
use App\TimeTable;
use App\User;
use App\Area;
use Carbon\Carbon;

class ReportController extends Controller
{

    public function index()
    {
        // عملاء مهتمين
        /*  if (\Auth::user()->type == 1) {
         $allinterestes = Sheet::where('isintrest', '=', 1)->orderBy('id', 'DESC')->get();
         }
         elseif (\Auth::user()->type == 0) {
         $allinterestes = Sheet::where('user_id', '=', \Auth::user()->id)
         ->where('isintrest', '=', 1)
         ->orderBy('id', 'DESC')->get();
         }
         $allinterstedpeople = $allinterestes->groupBy('user_id');
         // عملاء اليوم
         if (\Auth::user()->type == 1) {
         $alltodaysheets = Sheet::where('created_at', 'like', '%' . date('Y-m-d') . '%')->orWhere('dynmicdate', 'like', '%' . date('Y-m-d') . '%')->get();
         }
         elseif (\Auth::user()->type == 0) {
         $alltodaysheets = Sheet::where('created_at', 'like', '%' . date('Y-m-d') . '%')->orWhere('dynmicdate', 'like', '%' . date('Y-m-d') . '%')->where('user_id', '=', \Auth::user()->id)->get();
         }
         $todayshhet = $alltodaysheets->groupBy('user_id');
         // عدد العملاء الكلي
         if (\Auth::user()->type == 1) {
         $allsheets = Sheet::all();
         }
         elseif (\Auth::user()->type == 0) {
         $allsheets = Sheet::where('user_id', '=', \Auth::user()->id)->get();
         }
         $allsheetsfilteratio = $allsheets->groupBy('user_id');
         //users by area
         if (\Auth::user()->type == 1) {
         $allsheets1 = Sheet::select('name')->get();
         }
         elseif (\Auth::user()->type == 0) {
         $allsheets1 = Sheet::select('name')->where('user_id', '=', \Auth::user()->id)->get();
         }
         $allarea = Area::select('name')->get()->groupBy('name');
         $allsheetsbyarea1 = $allsheets1->groupBy('name');
         // مواعيد اليوم
         if (\Auth::user()->type == 1) {
         $alltodaytimetables = TimeTable::where('created_at', 'like', '%' . date('Y-m-d') . '%')->orWhere('dydate', 'like', '%' . date('Y-m-d') . '%')->get();
         }
         elseif (\Auth::user()->type == 0) {
         $alltodaytimetables = TimeTable::where(function ($query) {
         $query->where('created_at', 'like', '%' . date('Y-m-d') . '%')->orWhere('dydate', 'like', '%' . date('Y-m-d') . '%');
         })->where('user_id', '=', \Auth::user()->id)->get();
         }
         $useralltodaytimetables = $alltodaytimetables->groupBy('user_id');
         // مواعيد تمت 
         if (\Auth::user()->type == 1) {
         $donemeeting = TimeTable::where('meetingstate', '=', 1)->get();
         }
         elseif (\Auth::user()->type == 0) {
         $donemeeting = TimeTable::where('meetingstate', '=', 1)->where('user_id', '=', \Auth::user()->id)->get();
         }
         $userdonemeeting = $donemeeting->groupBy('user_id');
         // مواعيد لم تتم 
         if (\Auth::user()->type == 1) {
         $deosnotmeeting = TimeTable::where('meetingstate', '=', 0)->get();
         }
         elseif (\Auth::user()->type == 0) {
         $deosnotmeeting = TimeTable::where('meetingstate', '=', 0)->where('user_id', '=', \Auth::user()->id)->get();
         }
         $userdeosnotmeeting = $deosnotmeeting->groupBy('user_id');
         // مواعيد لم تتم 
         if (\Auth::user()->type == 1) {
         $canceldmeeting = TimeTable::where('meetingstate', '=', 2)->get();
         }
         elseif (\Auth::user()->type == 0) {
         $canceldmeeting = TimeTable::where('meetingstate', '=', 2)->where('user_id', '=', \Auth::user()->id)->get();
         }
         $usercanceldmeeting = $canceldmeeting->groupBy('user_id');*/
        return view('admin.reports.index');
    }
    public function get_areas()
    {
        if (\Auth::user()->type == 1) {
            $allsheets1 = Sheet::select(\DB::raw('count(sheets.name) as count'), 'areas.name as name')
                ->join('areas', 'areas.id', '=', 'sheets.areaid')->groupBy('areas.name')->get();
        } elseif (\Auth::user()->type == 0) {
            //  $allsheets1 = Sheet::select('name')->where('user_id', '=', \Auth::user()->id)->get();
            $allsheets1 = Sheet::select(\DB::raw('count(sheets.name) as count'), 'areas.name as name')
                ->join('areas', 'areas.id', '=', 'sheets.areaid')->groupBy('areas.name')
                ->where('user_id', '=', \Auth::user()->id)->get();
        }
        // dd($allsheets1);
        $allarea = Area::select('name')->get()->groupBy('name');
        $allsheetsbyare = $allsheets1->groupBy('sheets.name');
        $allsheetsbyarea = array();
        $i = 0;
        foreach ($allsheets1 as $area) {
            //  dd($area->name);
            array_push($allsheetsbyarea, array("name" => $area->name, "count" => $area->count));
            $i++;
        }
        $response = array(
            'status' => 'success',
            'allsheetsbyarea' => $allsheetsbyarea,
        );
        return response()->json($response);
    }
}
