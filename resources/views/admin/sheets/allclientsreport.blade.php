@extends('admin.layouts.master')
@section('pagetitle') @lang("home.clients") @endsection
@section('contentheader') 

 <section class="content-header text-right">
	  <ol class="breadcrumb">
	  <a href="{{ route('home') }}"  class="btn btn-info btn-sm">@lang('home.control') <i class="fa fa-arrow-circle-left"></i></a>
  </ol>
 </section>
@endsection
@section('main-content')
 <section class="content">
       <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  @lang('home.clients_menu')</h5>
                <div class="card-tools">
     
                    <div class="input-group" >
                    <?php
                      $add = "no";
                      $update = "no";
                      $delete = "no";
                    ?>
                    @foreach(\Auth::user()->groups as $usergroup)   
                      @foreach($usergroup->group->permissions as $permission)   
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
                   
                    </div>
                  </div>
                </div><!-- /.box-header -->
                 <div class="card-body table-responsive no-padding">

                 <form action="{{ route('search.sheatsearch') }}" id="searchrame" method="post" style=" margin-top: 20px; ">
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
                      <label>@lang('home.gov') </label>
                      <select name="govid" id="gov" onchange="chnage_gov()" class="form-control col-sm-12">
                      <option value=""> @lang('home.gov')</option>
                      @foreach($govs as $gov)
                        <option value="{{$gov->id}}">{{$gov->name}}</option>
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
                        <option value="{{$city->id}}" parent="{{$city->parentid}}" style="display:none">{{$city->name}}</option>
                      @endforeach
                      </select>
                    </div>
                      </div>
                  <div class="col-2" style="margin-left: 5px;">
                     <div class="form-group pull-left" style="margin-left: 5px;">
                      <label> @lang('home.date') </label>
              
                   <input type="date" name="dynmicdate" class="col-sm-12 form-control" placeholder="">
                 </div>
                 </div>
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
                <br><br>
               <table class="table table-bordered table-hover table-striped" id="report">
                
                   @if($allsheets->count() > 0)
                   <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">@lang('home.name')</th>
                      <th class="text-center"> @lang('home.client_type')</th>
                      <th class="text-center"> Dynamic Date</th>
                      <th class="text-center">@lang('home.mobile')</th>
                      <th class="text-center">@lang('home.employee')</th>
                      <th class="text-center">Know Us</th>
                      <th class="text-center">Area (gov/city)  </th>
                      <th class="text-center">Operation</th>
                    </tr>
                   </thead>  
                   <tbody> 
                    <?php $i= 1;?>
                  @foreach($allsheets as $cat)
                   
                    <tr style="background-color: {{ $cat['color']  }}">
                      <td class="text-center"> {{ $i }} </td>
                      <td class="text-center"> {{ $cat['name'] }} </td>
                        <td class="text-center"> {{ $cat['customer_type'] }} </td>
                      <td class="text-center"> {{ $cat['dynmicdate'] }} </td>
                      <td class="text-center">
                       @if($cat->phones->count() > 0) 
                       @foreach($cat->phones as $phonenumber).
                        {{ $phonenumber['phone'] }}<br>
                       @endforeach
                       @else
                       @lang('home.no_mobile')
                       @endif
                      </td>
                      <td class="text-center">{{ $cat->userfun['name'] }}</td>
                      
                      <td class="text-center">@if(isset($cat->social)){{  $cat->social['name'] }}@endif</td>

                      <td class="text-center">@if(isset($cat->area)){{  $cat->area['name'] }}@endif</td>
                     <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="<?php echo '#task'.$i?>">Operations</button></td>
                
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
                      <th class="text-center"> Operation</th>
                     <!-- <th class="text-center">@lang('home.opportunity')</th>
                      @if($delete == "yes")
                      <th class="text-center"> @lang('home.select_to_delete')</th>
                      @endif-->
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
        <table class="table table-bordered table-hover " >
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
            <div class="modal-dialog modal-xl ">
          
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Operation</h4>
                </div>
                <div class="modal-body">
                  <div class="col-12">
                      @foreach(\Auth::user()->groups as $usergroup)   <!-- user Groups -->
                      @foreach($usergroup->group->permissions as $permission)   <!-- group permissions -->
                         @if($permission['menu_id'] == $menuid )
                           @if($permission['add'] == 1 )
                             <?php $add = "yes";?>
                           @endif
                          @endif
                       @endforeach 
                    @endforeach
                    @if($add == "yes")
                     
                    <a href="{{ route('timetable.create',$menuid  ) }}" style="font-size: 15px; font-weight: bold;display: inline;" class="btn btn-sm btn-primary pull-left"> 
                      @lang('home.add_new') <i class="fa fa-plus"></i></a>
                    @endif
                  </div>
                   <br>
                      <br>
                    
                <div class="col-12">
                  <table class="table table-bordered table-hover " >
                    <thead>
                     <tr>
                       <th> @lang('home.serial')</th>
                       <th> @lang('home.client')</th>
                       <th> Operation Date</th>
                       <th> @lang('home.time')</th>
                       <th> @lang('home.employee')</th>
                       <th> Operation Status</th>
                       <th> Operation Type</th>
                       <th> Operation Created By</th>
                      <!-- <th class="text-center">@lang('home.refer_task')</th>    -->                   
                     </tr>
                    </thead>
                    <tbody>
                        @foreach($cat->alltimetables as $task)
                        <tr style="background-color: {{ $task['color']  }}">
                            <td class="text-center">{{ $task->id}}</td>
                            <td class="text-center">{{ $task->customer['name'] }}</td>
                            <td class="text-center">{{ date('d/m/Y',strtotime($task['created_at'])) }}</td>
      
                            <td class="text-center">{{ $task->time }}</td>
      
                            <td class="text-center">{{ $task->employee_name }}</td>
      
                            <td class="text-center">{{ $task->status_name }}</td>
                            <td class="text-center">{{ $task->type_name }}</td>
                            <td class="text-center">{{ $task->user['name'] }}</td>
                        <!--    <td class="text-center">{{ $task->timeid}}</td>-->
                        </tr>
                        @endforeach
                 
                    </tbody>
                  </table>
                 </div> 
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