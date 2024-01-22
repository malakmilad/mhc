<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehicle;
use App\GroupMenuPermissions;
use App\Menu;


class VehicleController extends Controller
{

    public function index($menuid)
    {
        $allvehicles = Vehicle::all();
        return View('admin.Vehicles.index', compact('allvehicles', 'menuid'));
    }

    public function create($menuid)
    {
        $allmenus = Menu::where('parent_id', '=', NULL)->get();
        return View('admin.Vehicles.add', compact('allmenus', 'menuid'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $newVehicle = new Vehicle();
        $newVehicle->name = $data['name'];


        $newVehicle->save();


        return redirect()->route('vehicle.index', $data['menuid']);
    }
    public function update(Request $request, Vehicle $Vehicle)
    {
        $data = $request->all();

        $Vehicle->name = $data['name'];


        $Vehicle->save();


        return redirect()->route('vehicle.index', $data['menuid']);
    }
    public function edit(Vehicle $vehicle, $menuid)
    {
        $allmenus = Menu::where('parent_id', '=', NULL)->get();
        return View('admin.Vehicles.edit', compact('allmenus', 'vehicle', 'menuid'));

    }

    public function destory(Vehicle $Vehicle, $menuid)
    {
        GroupMenuPermissions::where('menu_id', '=', $Vehicle->id)->delete();
        $Vehicle->delete();

        return redirect()->route('vehicle.index', $menuid);

    }
}
