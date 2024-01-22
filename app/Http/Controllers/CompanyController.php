<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Company;
use App\GroupMenuPermissions;
use App\Menu;


class CompanyController extends Controller
{

    public function index($menuid)
    {
        $allcompanies = Company::all();
        return View('admin.Companies.index', compact('allcompanies', 'menuid'));
    }

    public function create($menuid)
    {
        $allmenus = Menu::where('parent_id', '=', NULL)->get();
        return View('admin.Companies.add', compact('allmenus', 'menuid'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $newCompany = new Company();
        $newCompany->name = $data['name'];
        $newCompany->perc = $data['perc'];


        $newCompany->save();


        return redirect()->route('company.index', $data['menuid']);
    }
    public function update(Request $request, Company $Company)
    {
        $data = $request->all();

        $Company->name = $data['name'];
        $Company->perc = $data['perc'];


        $Company->save();


        return redirect()->route('company.index', $data['menuid']);
    }
    public function edit(Company $company, $menuid)
    {
        $allmenus = Menu::where('parent_id', '=', NULL)->get();
        return View('admin.Companies.edit', compact('allmenus', 'company', 'menuid'));

    }

    public function destory(Company $Company, $menuid)
    {
        Company::where('id', '=', $Company->id)->delete();

        return redirect()->route('company.index', $menuid);

    }
}
