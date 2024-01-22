<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\clientGroup;
use App\Menu;
use App\Sheet;
use App\sheetGroups;
use App\Messages;
use App\sheetMessages;
use App\Phone;
class MessageController extends Controller
{
   
    public function index($menuid)
    {
         $allclientGroups = clientGroup::all();
        return View('admin.clientGroup.index',compact('allclientGroups','menuid'));
    }
    
    public function create($menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        $clients=Sheet::all();
        return View('admin.clientGroup.add',compact('allmenus','menuid','clients'));
    }
    
     public function store(Request $request)
    {
        $data = $request->all();
        $newClientGroup = new clientGroup();
        $newClientGroup->name = $data['name'];
        $newClientGroup->save();
        if($data['clients']!=NULL && count($data['clients'])>0)
        {
            
          
            foreach ($data['clients'] as $client) {
                $newSheetGroups=new sheetGroups;
                $newSheetGroups->sheetid=$client;
                $newSheetGroups->groupid=$newClientGroup->id;
                $newSheetGroups->save();
            }
        
        
        }

        
        return redirect()->route('client_groups.index',$data['menuid']);
    }
     public function update(Request $request,clientGroup $clientGroup)
    {
        $data = $request->all();
        
        $clientGroup->name = $data['name'];
        $clientGroup->save();
        sheetGroups::where("groupid",$clientGroup->id)->delete();
        if($data['clients']!=NULL && count($data['clients'])>0)
        {
            
          
            foreach ($data['clients'] as $client) {
                $newSheetGroups=new sheetGroups;
                $newSheetGroups->sheetid=$client;
                $newSheetGroups->groupid=$clientGroup->id;
                $newSheetGroups->save();
            }
        
        
        }
        
        return redirect()->route('client_groups.index',$data['menuid']);
    }
    public function edit(clientGroup $clientGroup , $menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        $clients=Sheet::all();
        $selected=sheetGroups::where("groupid",$clientGroup->id)->pluck('sheetid')->toArray();
        return View('admin.clientGroup.edit',compact('allmenus','clientGroup','menuid','clients','selected'));
        
    }
    
    public function destory(clientGroup $clientGroup , $menuid)
    {
        sheetGroups::where('groupid','=',$clientGroup->id)->delete();
        $clientGroup->delete();

        return redirect()->route('client_groups.index',$menuid);
        
    }

    public function index_message($menuid)
    {
         $allmessages = Messages::all();
        return View('admin.Messages.index',compact('allmessages','menuid'));
    }
    public function create_message($menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        $clients=Sheet::all();
        $allclientGroups = clientGroup::all();
        return View('admin.Messages.add',compact('allmenus','menuid','clients','allclientGroups'));
    }

    public function view_message(Messages $Message ,$menuid)
    {
        $allmenus = Menu::where('parent_id','=',NULL)->get();
        $clients=Sheet::all();
        $allclientGroups = clientGroup::all();
        $sheetMessages_group=sheetMessages::where("messageid",$Message->id)->where("group_sheet",1)->pluck("keyid")->toArray();
        $sheetMessages_client=sheetMessages::where("messageid",$Message->id)->where("group_sheet",2)->pluck("keyid")->toArray();

        return View('admin.Messages.edit',compact('allmenus','menuid','clients','allclientGroups','Message','sheetMessages_group','sheetMessages_client'));
    }

    public function store_message(Request $request)
    {
        $data = $request->all();
        if(!empty($data['groups']))
        {
        $groups = $data['groups'];
        }
        $subject = $data['subject'];
        $content = $data['content'];
        $from = "ahmed.shy31@gmail.com";
        $headers = "";
        $headers .= "From: CRM <ahmed.shy31@gmail.com> \r\n";
        $headers .= "Reply-To:" . $from . "\r\n" ."X-Mailer: PHP/" . phpversion();
        $headers .= 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 
        $type = $data['type'];
        if(!empty($data['clients']))
        {
        $clients = $data['clients'];
        }
        $message=new Messages;
        $message->content=$content;
        $message->type=$type;
        $message->save();

        if(isset($groups))
        {
        foreach ($groups as $group) {
            $clients_group=sheetGroups::where('groupid','=',$group)->pluck('sheetid')->toArray();
            $sheetMessages=new sheetMessages;
            $sheetMessages->messageid=$message->id;
            $sheetMessages->keyid=$group;
            $sheetMessages->group_sheet=1;
            $sheetMessages->save();
            foreach ($clients_group as $id) {
                $user=Sheet::find($id);
                $type=3;
                if($type==1 || $type==3)
                {
                    //send email
                    try
                    {
                        
                    mail($user->email,$subject,$content,$headers);
                    }
                    catch (\Exception $e) {
                    }

                }
                if($type==2 || $type==3)
                {
                    //send sms
                    //dd($user->id);
                    $phone=Phone::where('sheet_id',$user->id)->first();
                    $lang=2;
                    $url="https://smsmisr.com/api/webapi/?username=5jY5Jg2T&password=AElUX7AnKY&language=".$lang."&sender=Healthy&mobile=2".$phone->phone."&message=".$content;
                    $url = str_replace(" ", '%20', $url);
                    $return=$this->CallAPI($url);

                }
            }

         }
        }
     if(isset($clients))
     {
        foreach ($clients as $client) {
            $user=Sheet::find($client);
            $sheetMessages=new sheetMessages;
            $sheetMessages->messageid=$message->id;
            $sheetMessages->keyid=$client;
            $sheetMessages->group_sheet=2;
            $sheetMessages->save();
            if($type==1 || $type==3)
            {
                //send email
                try{
                mail($user->email,$subject,$content,$headers);
                }
                catch (\Exception $e) {
                }

            }
            if($type==2 || $type==3)
            {
                    $phone=Phone::where('sheet_id',$user->id)->first();
                    $lang=2;
                    $url="https://smsmisr.com/api/webapi/?username=5jY5Jg2T&password=AElUX7AnKY&language=".$lang."&sender=Healthy&mobile=2".$phone->phone."&message=".$content;
                    $url = str_replace(" ", '%20', $url);
                    $return=$this->CallAPI($url);
            }
        }
     
      

    }  
        return redirect()->route('client_message.index',$data['menuid']);
    }
    public function CallAPI($url)
    {
            $curl = curl_init();
     //   $final_url = curl_escape($curl, $url);
    
        curl_setopt($curl, CURLOPT_POST, 1);
       // curl_setopt($curl, CURLOPT_URL, $final_url);
      
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json')); 
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }
}
