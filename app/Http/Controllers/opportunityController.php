<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Opportunity;
use App\GroupMenuPermissions;
use App\Menu;
use App\Sheet;
use App\Stage;

class opportunityController extends Controller
{

    public function index($menuid)
    {
        $sheets = Sheet::all();
        $stages = Stage::all();
        $allOpportunitys = Opportunity::select("opportunitys.*", "stages.name as stage_name", "sheets.name as customer_name")->join("sheets", "opportunitys.customerid", "=", "sheets.id")->join("stages", "opportunitys.stageid", "=", "stages.id")->get();
        return View('admin.opportunity.index', compact('allOpportunitys', 'menuid', 'sheets', 'stages'));
    }

    public function create($menuid)
    {
        $allmenus = Menu::where('parent_id', '=', NULL)->get();
        $customers = Sheet::all();
        $stages = Stage::all();
        return View('admin.opportunity.add', compact('allmenus', 'menuid', 'customers', 'stages'));
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $newOpportunity = new Opportunity();
        $newOpportunity->name = $data['name'];
        $newOpportunity->price = $data['price'];
        $newOpportunity->customerid = $data['customerid'];
        $newOpportunity->dueDate = $data['dueDate'];
        $newOpportunity->stageid = $data['stageid'];
        $newOpportunity->prop = $data['prop'];
        $newOpportunity->save();

        return redirect()->route('opportunity.index', $data['menuid']);
    }
    public function update(Request $request, Opportunity $opportunity)
    {
        $data = $request->all();

        $opportunity->name = $data['name'];
        $opportunity->price = $data['price'];
        $opportunity->customerid = $data['customerid'];
        $opportunity->dueDate = $data['dueDate'];
        $opportunity->stageid = $data['stageid'];
        $opportunity->prop = $data['prop'];

        $opportunity->save();


        return redirect()->route('opportunity.index', $data['menuid']);
    }
    public function edit(Opportunity $opportunity, $menuid)
    {
        $customers = Sheet::all();
        $stages = Stage::all();
        $allmenus = Menu::where('parent_id', '=', NULL)->get();
        return View('admin.opportunity.edit', compact('allmenus', 'opportunity', 'menuid', 'customers', 'stages'));

    }

    public function destory(Opportunity $opportunity, $menuid)
    {
        GroupMenuPermissions::where('menu_id', '=', $opportunity->id)->delete();
        $opportunity->delete();

        return redirect()->route('opportunity.index', $menuid);

    }

    public function opportunitysearch(Request $request)
    {
        $allinfo = $request->all();
        $sheets = Sheet::all();
        $stages = Stage::all();
        $allOpportunitys = Opportunity::select("opportunitys.*", "stages.name as stage_name", "sheets.name as customer_name")->join("sheets", "opportunitys.customerid", "=", "sheets.id")->join("stages", "opportunitys.stageid", "=", "stages.id");
        if (!empty($allinfo['name'])) {
            $allOpportunitys->where(function ($query) use ($allinfo) {
                $query->where('opportunitys.name', '=', $allinfo['name']);
            });
        }

        if (!empty($allinfo['client'])) {
            $allOpportunitys->where(function ($query) use ($allinfo) {
                $query->where('customerid', '=', $allinfo['client']);
            });
        }

        if (!empty($allinfo['price'])) {
            $allOpportunitys->where(function ($query) use ($allinfo) {
                $query->where('price', '=', $allinfo['price']);
            });
        }

        if (!empty($allinfo['expire_date'])) {
            $allOpportunitys->where(function ($query) use ($allinfo) {
                $query->where('dueDate', '=', $allinfo['expire_date']);
            });
        }

        if (!empty($allinfo['stage'])) {
            $allOpportunitys->where(function ($query) use ($allinfo) {
                $query->where('stageid', '=', $allinfo['stage']);
            });
        }

        if (!empty($allinfo['probability'])) {
            $allOpportunitys->where(function ($query) use ($allinfo) {
                $query->where('prop', '=', $allinfo['probability']);
            });
        }

        if (!empty($allinfo['created_at'])) {
            $allOpportunitys->where(function ($query) use ($allinfo) {
                $query->where('opportunitys.created_at', 'like', '%' . $allinfo['created_at'] . '%');
            });
        }
        $menuid = $allinfo['menuid'];
        $allOpportunitys = $allOpportunitys->get();
        return View('admin.opportunity.index', compact('allOpportunitys', 'menuid', 'sheets', 'stages'));
    }
}
