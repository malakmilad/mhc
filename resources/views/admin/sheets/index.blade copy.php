@extends('admin.layouts.master')
@section('pagetitle') @lang("home.clients") @endsection
@section('contentheader') 

 <section class="content-header text-right">
	<!--  <h1>
        @lang("home.clients")
	    <small>@lang('home.clients_desc') </small>
	  </h1>-->
	  <ol class="breadcrumb">
	   <!--    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> @lang('home.control') </a></li>-->
    <a href="{{ route('home') }}"  class="btn btn-info btn-sm">@lang('home.control') <i class="fa fa-arrow-circle-left"></i></a>

    <!--  <li class="active">@lang('home.add_new')</li>-->
  <a href="{{ route('home') }}"  class="btn btn-info btn-sm">@lang('home.control') <i class="fa fa-arrow-circle-left"></i></a>

	  </ol>
 </section>
@endsection
@section('main-content')
 <section class="content">
  <!-- <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"> @lang('home.clients_menu')</h3>
                  <div class="box-tools">-->
       <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title"> @lang('home.clients_menu') </h5>
                <div class="card-tools">
                    <div class="input-group" >

                      <a onclick="searchcvs()" style="font-size: 15px; font-weight: bold;margin-left: 5px;" class="btn btn-sm btn-info pull-right">@lang('home.search') <i class="fa fa-search"></i></a>

                <!--      <a href="{{ route('sheet.allsheets',$menuid) }}" style="font-size: 15px; font-weight: bold;margin-left: 5px;" class="btn btn-sm btn-success pull-right"> @lang('home.all_clients') <i class="fa fa-users"></i></a>-->


                      <?php
                      $add = "no";
                      $update = "no";
                      $delete = "no";
                    ?>
                    @foreach(\Auth::user()->groups as $usergroup)   <!-- user Groups -->
                      @foreach($usergroup->group->permissions as $permission)   <!-- group permissions -->
                         @if($permission['menu_id'] == $menuid )
                           @if($permission['add'] == 1 )
                             <?php $add = "yes";?>
                           @endif

                           @if($permission['delete'] == 1 )
                             <?php $delete = "yes";?>
                           @endif

                           @if($permission['update'] == 1 )
                             <?php $update = "yes";?>
                           @endif

                          @endif
                       @endforeach 
                    @endforeach
                    @if($add == "yes")
                    <a href="{{ route('sheet.create',$menuid) }}" style="font-size: 15px; font-weight: bold;display: inline;" class="btn btn-sm btn-primary pull-right"> @lang('home.add_new') <i class="fa fa-plus"></i></a>
                    <a href="{{ route('uploadsheet',$menuid) }}" style="font-size: 15px; font-weight: bold;display: inline;" class="btn btn-sm btn-primary pull-right"> @lang('home.upload_file')<i class="fa fa-plus"></i></a>
                    @endif 
                    @if($delete == "yes")
                    <div class="pull-right" style="margin-right: 10px;"> 
                    <input type="checkbox"  onClick="setAllCheckboxes('actors', this);" /> @lang('home.select_all_delete') <br/>
                    </div>
                    @endif 

                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                 <form action="{{ route('search.sheatsearch') }}" id="searchrame" method="post" style="display: none; margin-top: 20px; ">
                {{ csrf_field() }}
                   <input type="hidden" name="menuid" value="{{ $menuid }}">
               
                 
                <div class="row" style="margin-left: 5px;">
                  <div class="col-2">
                    <div class="form-group pull-left" style="margin-left: 5px;">
                    <label> @lang('home.name') </label>
                      <input type="text" name="name" class="col-sm-12 form-control" placeholder="@lang('home.name')">
                  
                    </div>
                 </div>
                  <div class="col-2">
                <div class="form-group pull-left" style="margin-left: 5px;">
                  <label> @lang('home.client_type') </label>
                <select class="col-sm-12 form-control" name="isintrest">
                    <option value=""> @lang('home.client_type')</option>
                  @foreach($customerTypess as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                </div>
                </div>
                 <div class="col-2">

                <div class="form-group pull-left" style="margin-left: 5px;">
                   <label> @lang('home.activity_type') </label>
                  
                   <select name="activitytype" class="form-control col-sm-12">
                                 <option value="">@lang('home.activity_type')</option>

                    @foreach($acivites as $activity)
                    
                      <option value="{{ $activity->name }}">{{ $activity->name }}</option>
                    @endforeach
                  </select>
                </div>
                  </div>
                 <div class="col-2">
                    <div class="form-group pull-left" style="margin-left: 5px;">
                      <label>@lang('home.gov') </label>
                      <select name="govid" id="gov" onchange="chnage_gov()" class="form-control col-sm-12">
                      <option value=""> @lang('home.gov')</option>
                      @foreach($govs as $gov)
                        <option value="{{$gov->id}}">{{$gov->arabicName}}</option>
                      @endforeach
                      </select>
                    </div>
                      </div>
                 <div class="col-2">
                    <div class="form-group pull-left" style="margin-left: 5px;">
                      <label>@lang('home.area')</label>
                      <select name="areaid" id="city" class="form-control col-sm-12">
                      <option value="">@lang('home.area')</option>
                      @foreach($cities as $city)
                        <option value="{{$city->id}}" parent="{{$city->parentid}}" style="display:none">{{$city->arabicName}}</option>
                      @endforeach
                      </select>
                    </div>
                      </div>
                 <div class="col-2">
                <div class="form-group pull-left" style="margin-left: 5px;">
                  <label> @lang('home.services') </label>
                  <select  class="form-control col-sm-12" name="service_id">
                    
                     <option value="">@lang('home.services')</option>
                    @foreach($allservices as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
            </div>
  <div class="row" style="margin-left: 5px;">
                 <div class="col-2" style="margin-left: 5px;">
                     <div class="form-group pull-left" style="margin-left: 5px;">
                    <label> @lang('home.email') </label>
               
                   <input type="email" name="email" class="col-sm-12 form-control" placeholder="@lang('home.email')">
                 </div>
                 </div>
                  <div class="col-2" style="margin-left: 5px;">
                  
                 <div class="form-group pull-left" style="margin-left: 5px;">
                    <label> @lang('home.phone') </label>
                   <input type="text" name="phone" class="col-sm-12 form-control" placeholder="@lang('home.mobile')">
                 </div>
                </div>
                 
                  <div class="col-2" style="margin-left: 5px;">
                     <div class="form-group pull-left" style="margin-left: 5px;">
                      <label> @lang('home.date') </label>
              
                   <input type="date" name="dynmicdate" class="col-sm-12 form-control" placeholder="">
                 </div>
                 </div>
               
                 @if(\Auth::user()->type == 1)
                    <div class="col-2">
                            <div class="form-group pull-left" style="margin-left: 5px;">
                            <label> @lang('home.employee') </label>
           
                   <select name="user_id" class="col-sm-12 form-control">
                     <option value="">@lang('home.employee')</option>
                     @foreach($users as $user)
                     <option value="{{ $user->id }}">{{ $user->name }}</option>
                     @endforeach
                   </select>
                 </div>
                  </div>
                 @endif
                     <div class="col-2">    <div class="form-group pull-left" style="margin-left: 5px;">
                            <label> @lang('home.datefrom') </label>
             
                   <input type="date" name="datefrom" class="col-sm-12 form-control" placeholder="">
                 </div>
</div>
                     <div class="col-2"><div class="form-group pull-left" style="margin-left: 5px;">
                            <label> @lang('home.dateto') </label>
                 
                   <input type="date" name="dateto" class="col-sm-12 form-control" placeholder="">
                 </div>
</div>
</div>
<div class="row">
                 <div class="form-group pull-left" style="margin-left: 5px">
                   <input type="submit" value="@lang('home.search')" class="col-sm-12 form-control btn btn-success">
                 </div>
                 </div>
                </form>
            
                <form action="{{ route('sheet.deleteallselectedsheets') }}" method="POST">
                 {{ csrf_field() }}
                  <input type='hidden' name='menuid' value="{{ $menuid }}" >
                   
                  <table class="table table-bordered table-hover reportorder" id="report">
                   @if($allsheets->count() > 0)
                   <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">@lang('home.name')</th>
                      <th class="text-center"> @lang('home.client_type')</th>
                      <th class="text-center">@lang('home.mobile')</th>
                      @if(\Auth::user()->type == 1)
                      <th class="text-center">@lang('home.employee')</th>
                      @endif
                      <th class="text-center">@lang('home.created_at')</th>
                      <th class="text-center"> @lang('home.activity_type') </th>
                      <th class="text-center">@lang('home.tasks')</th>
                      <th class="text-center">@lang('home.opportunity')</th>
                      @if($delete == "yes")
                      <th class="text-center"> @lang('home.select_to_delete')</th>
                      @endif
                      <th class="text-center">@lang('home.options')</th>
                    </tr>
                   </thead>  
                   <tbody> 
                    <?php $i= 1;?>
                  @foreach($allsheets as $cat)
                   
                    <tr style="background-color: {{ $cat['color']  }}">
                      <td class="text-center"> {{ $i }} </td>
                      <td class="text-center"> {{ $cat['name'] }} </td>
                      <td class="text-center"> {{ $cat['customer_type'] }} </td>
                      <td class="text-center">
                       @if($cat->phones->count() > 0) 
                       @foreach($cat->phones as $phonenumber).
                        {{ $phonenumber['phone'] }}<br>
                       @endforeach
                       @else
                       @lang('home.no_mobile')
                       @endif
                      </td>
                      @if(\Auth::user()->type == 1)
                      <td class="text-center">{{ $cat->userfun['name'] }}</td>
                      @endif
                      
                      <td class="text-center">{{ date('d/m/Y',strtotime($cat['created_at'])) }}</td>

                      <td class="text-center">{{ $cat['activitytype'] }}</td>
                      <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="<?php echo '#task'.$i?>">@lang('home.tasks')</button></td>
                      <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="<?php echo '#ops'.$i?>">@lang('home.opportunity')</button></td>

                      @if($delete == "yes")
                      <td class="text-center"> 
                      
                      <input type="checkbox" name="check{{ $i}}" value="{{ $cat['id'] }}">
               
                      </td>
                      @endif
                      <td class="text-center">
                      @if($update == "yes")
                      <a href="{{ route('sheet.edit',['sheet' => $cat['id'] , 'menuid' => $menuid ] ) }}" class="label label-warning">@lang('home.edit') <i class="fa fa-edit"></i></a>
                      @endif
                      @if($delete == "yes")
                      <a href="{{ route('sheet.destory',['sheet' => $cat['id'] , 'menuid' => $menuid ] ) }}" class="label label-danger">@lang('home.delete') <i class="fa fa-times"></i></a>
                      @endif
                      </td>
                    </tr>
                   
                    <?php $i= $i + 1;?>
                  @endforeach
                  </tbody>
                  <tfoot>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">@lang('home.name')</th>
                      <th class="text-center"> @lang('home.client_type')</th>
                      <th class="text-center">@lang('home.mobile')</th>
                      @if(\Auth::user()->type == 1)
                      <th class="text-center">@lang('home.employee')</th>
                      @endif
                      <th class="text-center">@lang('home.created_at')</th>
                      <th class="text-center"> @lang('home.activity_type') </th>
                      <th class="text-center">@lang('home.tasks')</th>
                      <th class="text-center">@lang('home.opportunity')</th>
                      @if($delete == "yes")
                      <th class="text-center"> @lang('home.select_to_delete')</th>
                      @endif
                      <th class="text-center">@lang('home.options')</th>
                    </tr>
                  </tfoot>
                  @else
                  <h3 class="text-center" style="color: red;">
                    <br>
                    <br>
                    <br>
                        @lang('home.clients_empty')
                    <br>
                    <br>
                    <br>
                  </h3>
                  @endif
                  </table>
                  @if($delete == "yes")
                  <button class="btn btn-danger col-sm-3 pull-left"> @lang('home.delete_selected') </button>
                  @endif
                  </form>
                
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>

          

          <?php $i= 1;?>
          @foreach($allsheets as $cat)
          <!-- Modal -->
<div id="<?php echo 'ops'.$i?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">@lang('home.opportunity')</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover report">
          <thead>
           <tr>
            <th class="text-center"> @lang('home.serial')</th>
            <th class="text-center">@lang('home.name')</th>
            <th class="text-center">@lang('home.client')</th>
            <th class="text-center">@lang('home.price')</th>
            <th class="text-center"> @lang('home.expire_date')</th>
            <th class="text-center">@lang('home.stage')</th>
            <th class="text-center">@lang('home.probability')</th>
            <th class="text-center"> @lang('home.created_at')</th>                      
           </tr>
          </thead>
          <tbody>
              @foreach($cat->allOpportunitys as $opportunity)
              <tr>
              <td class="text-center">{{ $opportunity['id'] }}</td>
              <td class="text-center">{{ $opportunity['name'] }}</td>
              <td class="text-center">{{ $opportunity['customer_name'] }}</td>
              <td class="text-center">{{ $opportunity['price'] }}</td>
              <td class="text-center">{{ $opportunity['dueDate'] }}</td>
              <td class="text-center">{{ $opportunity['stage_name'] }}</td>
              <td class="text-center">{{ $opportunity['prop'] }}</td>
              <td class="text-center">{{ date('d/m/Y',strtotime($opportunity['created_at'])) }}</td>
              </tr>
              @endforeach
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('home.close')</button>
      </div>
    </div>

  </div>
</div>

          <div id="<?php echo 'task'.$i?>" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg">
          
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                 
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">@lang('home.tasks')</h4>
                </div>
                <div class="modal-body">
                   <table class="table table-bordered table-hover report " id="report">
                    <thead>
                     <tr>
                       <th class="text-center"> @lang('home.serial')</th>
                       <th class="text-center">@lang('home.client')</th>
                       <th class="text-center"> @lang('home.task_date')</th>
                       <th class="text-center"> @lang('home.time')</th>
                       <th class="text-center">@lang('home.employee')</th>
                       <th class="text-center"> @lang('home.task_status')</th>
                       <th class="text-center"> @lang('home.task_type')</th>
                       <th class="text-center"> @lang('home.task_created_by')</th>
                       <th class="text-center">@lang('home.refer_task')</th>                       
                     </tr>
                    </thead>
                    <tbody>
                        @foreach($cat->alltimetables as $task)
                        <tr style="background-color: {{ $task['color']  }}">
                            <th class="text-center">{{$task->id}}</th>
                            <td class="text-center">{{ $task->customer['name'] }}</td>
                            <td class="text-center">{{ date('d/m/Y',strtotime($task['created_at'])) }}</td>
      
                            <td class="text-center">{{ $task->time }}</td>
      
                            <td class="text-center">{{ $task->employee_name }}</td>
      
                            <td class="text-center">{{ $task->status_name }}</td>
                            <td class="text-center">{{ $task->type_name }}</td>
                            <td class="text-center">{{ $task->user['name'] }}</td>
                            <td class="text-center">{{ $task->timeid}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                  </table>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
          
            </div>
          </div>
          <?php $i++?>
          @endforeach

 </section><!-- /.content -->
  <script type="text/javascript">
    function searchcvs() {
      $('#searchrame').slideToggle();
    }
 </script>


 <script type="text/javascript">
   function setAllCheckboxes(divId, sourceCheckbox) {
    
    divElement = document.getElementById(divId);
    
    inputElements = divElement.getElementsByTagName('input');
    for (i = 0; i < inputElements.length; i++) {
        if (inputElements[i].type != 'checkbox')
            continue;
        inputElements[i].checked = sourceCheckbox.checked;
    }
}

 function chnage_gov(){
    var valueSelected = $('#gov').val();
    if(valueSelected !="")
    {
        $("#city").val("");

    $("[parent]").hide();
    $("[parent="+valueSelected+"]").show();
    }
    else
    {
          $("[parent]").show();

    }

}


 </script>

@endsection