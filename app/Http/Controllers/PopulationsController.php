<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Population;
use App\Housing;
use App\GroupMenuPermissions;
use App\Menu;
use App\Sheet;

class PopulationsController extends Controller
{
   
    public function index($menuid)
    {
        $sheets=Sheet::all();
        $companies=Housing::all();
         $allPopulations = Population::select("populations.*","housing_companies.name as company_name","sheets.name as client_name")->join("housing_companies","populations.housingid","=","housing_companies.id")
         ->leftjoin("sheets","populations.clientid","=","sheets.id")->get();
        return View('admin.Populations.index',compact('allPopulations','menuid','sheets','companies'));
    }
    
    public function create($menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        $allHousings=Housing::all();
        $sheets=Sheet::all();

        return View('admin.Populations.add',compact('allmenus','menuid','allHousings','sheets'));
    }
    
     public function store(Request $request)
    {
        $data = $request->all();
        
        $newPopulation = new Population();
        $newPopulation->address = $data['address'];
        $newPopulation->floor = $data['floor'];
        $newPopulation->area = $data['area'];
        $newPopulation->rooms = $data['rooms'];
        $newPopulation->housingid = $data['housingid'];
        $newPopulation->price = $data['price'];
        $newPopulation->commission = $data['commission'];

        if(isset($data['description']))
        {
        $newPopulation->description = $data['description'];
        }
        if(isset($data['clientid']))
        {
        $newPopulation->clientid = $data['clientid'];
        $newPopulation->open = 0;
        }


       
        $newPopulation->save();

        
        return redirect()->route('population.index',$data['menuid']);
    }
     public function update(Request $request,Population $Population)
    {
        $data = $request->all();
        
        $Population->address = $data['address'];
        $Population->floor = $data['floor'];
        $Population->area = $data['area'];
        $Population->rooms = $data['rooms'];
        $Population->housingid = $data['housingid'];
        $Population->price = $data['price'];
        $Population->commission = $data['commission'];
        //$Population->open = $data['open'];
        if(isset($data['description']))
        {
        $Population->description = $data['description'];
        }
        if(isset($data['clientid']))
        {
        $Population->clientid = $data['clientid'];
        $Population->open = 0;
        }
        $Population->save();

        
        return redirect()->route('population.index',$data['menuid']);
    }
    public function edit(Population $Population , $menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        $allHousings=Housing::all();
        $sheets=Sheet::all();

        return View('admin.Populations.edit',compact('allmenus','Population','menuid','allHousings','sheets'));
        
    }
    
    public function destory(Population $Population , $menuid)
    {
        //GroupMenuPermissions::where('menu_id','=',$activite->id)->delete();
        $Population->delete();

        return redirect()->route('population.index',$menuid);
        
    }
    public function populationsearch(Request $request)
    {
        $allinfo = $request->all();
        $sheets=Sheet::all();
        $companies=Housing::all();
         $allPopulations = Population::select("populations.*","housing_companies.name as company_name","sheets.name as client_name")->join("housing_companies","populations.housingid","=","housing_companies.id")
         ->leftjoin("sheets","populations.clientid","=","sheets.id");
         
      if(!empty($allinfo['floor'])){
            $allPopulations->where( function ($query) use($allinfo){
                 $query->where('floor','=',$allinfo['floor']);
            } );
        }
         if(!empty($allinfo['housingid'])){
            $allPopulations->where( function ($query) use($allinfo){
                 $query->where('housingid','=',$allinfo['housingid']);
            } );
        }
         if(!empty($allinfo['client'])){
            $allPopulations->where( function ($query) use($allinfo){
                 $query->where('clientid','=',$allinfo['client']);
            } );
        }
         if(!empty($allinfo['price'])){
            $allPopulations->where( function ($query) use($allinfo){
                 $query->where('price','=',$allinfo['price']);
            } );
        }
         if(!empty($allinfo['commission'])){
            $allPopulations->where( function ($query) use($allinfo){
                 $query->where('commission','=',$allinfo['commission']);
            } );
        }
         if(!empty($allinfo['area'])){
            $allPopulations->where( function ($query) use($allinfo){
                 $query->where('area','=',$allinfo['area']);
            } );
        }
         if(!empty($allinfo['status'])){
            $allPopulations->where( function ($query) use($allinfo){
                 $query->where('open','=',$allinfo['status']);
            } );
        }
        if(!empty($allinfo['address'])){
            $allPopulations->where( function ($query) use($allinfo){
                 $query->where('populations.address','like','%'.$allinfo['address'].'%');
            } );
        }
        
         if(!empty($allinfo['created_at'])){
            $allPopulations->where( function ($query) use($allinfo){
                 $query->where('populations.created_at','like','%'.$allinfo['created_at'].'%');
            } );
        }
         
        $allPopulations=$allPopulations->get();
        $menuid=$allinfo["menuid"];
        return View('admin.Populations.index',compact('allPopulations','menuid','sheets','companies'));
    }
}
