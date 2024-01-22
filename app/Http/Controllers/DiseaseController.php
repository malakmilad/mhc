<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Disease;
use App\GroupMenuPermissions;
use App\Menu;


class DiseaseController extends Controller
{

    public function index($menuid)
    {
        $allDiseases = Disease::all();
        return View('admin.Diseases.index', compact('allDiseases', 'menuid'));
    }

    public function create($menuid)
    {
        $allmenus = Menu::where('parent_id', '=', NULL)->get();
        return View('admin.Diseases.add', compact('allmenus', 'menuid'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $newDisease = new Disease();
        $newDisease->name = $data['name'];


        $newDisease->save();


        return redirect()->route('disease.index', $data['menuid']);
    }
    public function update(Request $request, Disease $Disease)
    {
        $data = $request->all();

        $Disease->name = $data['name'];


        $Disease->save();


        return redirect()->route('disease.index', $data['menuid']);
    }
    public function edit(Disease $disease, $menuid)
    {
        $allmenus = Menu::where('parent_id', '=', NULL)->get();
        return View('admin.Diseases.edit', compact('allmenus', 'disease', 'menuid'));

    }

    public function destory(Disease $Disease, $menuid)
    {
        GroupMenuPermissions::where('menu_id', '=', $Disease->id)->delete();
        $Disease->delete();

        return redirect()->route('disease.index', $menuid);

    }
}
