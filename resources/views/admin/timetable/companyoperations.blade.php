@extends('admin.layouts.master')
@section('pagetitle') @lang('home.operations') @endsection
@section('contentheader') 
 <section class="content-header text-right">
	<!--  <h1>
	    @lang('home.operations')
	    <small>@lang('home.operations_desc')</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i>  @lang('home.control') </a>
      </li>
	    <li class="active">@lang('home.operations')</li>
	  </ol>-->
      <a href="{{ route('home') }}"  class="btn btn-info btn-sm">@lang('home.control') <i class="fa fa-arrow-circle-left"></i></a>

 </section>
@endsection
@section('main-content')
 <section class="content">
      <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  @lang('home.operations')</h5>
                <div class="card-tools">
                    <div class="input-menu" >
                  </div>
                </div>
                <div class="box-body table-responsive no-padding">

                <form action="{{ route('timetable.companyoperationssearch') }}" id="searchrame" method="post" style=" margin-top: 20px; ">
                    {{ csrf_field() }}
                <input type="hidden" name="menuid" value="{{ $menuid }}">
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
                <div class="row">
                 <div class="col-2"> 
                 <div class="form-group pull-left" style="margin-left: 5px;">
                         <label> @lang('home.date') </label>
                   <input type="date" name="dydate" class="col-sm-12 form-control">
                 </div>
               </div>
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
                 <div class="col-2"> 
                 <div class="form-group pull-left" style="margin-left: 5px;">
                       <label> @lang('home.operation_created_by') </label>
                   <select name="created_by" class="col-sm-12 form-control">
                     <option value="">@lang('home.operation_created_by')</option>
                     @foreach($users as $user)
                     <option value="{{ $user->id }}">{{ $user->name }}</option>
                     @endforeach
                   </select>
                 </div>
                  </div>
                 <div class="col-2"> 
                  <div class="form-group pull-left" style="margin-left: 5px;">
                      <label> @lang('home.client') </label>
                   <select name="client_id" class="col-sm-12 form-control">
                     <option value="">@lang('home.client')</option>
                     @foreach($allclients as $client)
                     <option value="{{ $client->id }}">{{ $client->name }}</option>
                     @endforeach
                   </select>
                 </div>
                </div>
                 <div class="col-2">  
                  <div class="form-group pull-left" style="margin-left: 5px;">
                    <label> @lang('home.operation_type') </label>
                   <select name="operation_type" class="col-sm-12 form-control">
                     <option value="">@lang('home.operation_type')</option>
                     @foreach($alltypes as $type)
                     <option value="{{ $type->id }}">{{ $type->name }}</option>
                     @endforeach
                   </select>
                 </div>
                </div>
                <div class="col-2">  
                 <div class="form-group pull-left" style="margin-left: 5px;">
                    <label> @lang('home.operation_status') </label>
                   <select name="operation_status" class="col-sm-12 form-control">
                     <option value="">@lang('home.operation_status')</option>
                     @foreach($allstatus as $status)
                     <option value="{{ $status->id }}">{{ $status->name }}</option>
                     @endforeach
                   </select>
                 </div>
                </div>
                </div>
                <div class="row">
                   <div class="col-2">    
                       <div class="form-group pull-left" style="margin-left: 5px;">
                            <label> @lang('home.datefrom') </label>
             
                   <input type="date" name="datefrom" class="col-sm-12 form-control" placeholder="">
                 </div>
                 </div>
                 <div class="col-2"><div class="form-group pull-left" style="margin-left: 5px;">
                     <label> @lang('home.dateto') </label>
                 
                   <input type="date" name="dateto" class="col-sm-12 form-control" placeholder="">
                 </div>
                </div>
                <div class="col-8">  
                 <div class="form-group pull-left" style="margin-left: 5px">
                   <input type="submit" value="@lang('home.search')" class="col-sm-12 form-control btn btn-success">
                     </div>
                </div>
                </div>
                </form>
     <br><br>
                  <table class="table table-bordered table-hover" id="report">
                   @if($alltimetables->count() > 0)
                   <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">  Operation number</th>
                      <th class="text-center">@lang('home.client')</th>
                      <th class="text-center"> @lang('home.operation_date')</th>
                      <th class="text-center"> @lang('home.time')</th>
                      <th class="text-center">@lang('home.employee')</th>
                      <th class="text-center"> From Area </th>
                      <th class="text-center"> To Area </th>
                      <th class="text-center"> Vehicle </th>
                      <th class="text-center"> Operation Status </th>
                      <th class="text-center"> Company </th>
                      <th class="text-center"> Company Revenue</th> 
                      <th class="text-center"> Paid Status</th> 
                      <th class="text-center"> options</th> 
                    </tr>
                   </thead>
                   <tbody>
                    <?php $i = 1; ?>
                  @foreach($alltimetables as $cat)
                  <?php
                    $operations=\App\Http\Controllers\TimeTableController::get_childs($cat->id);
                  ?>
                    <tr style="background-color: {{ $cat['color']  }}">
                      <td class="text-center">{{ $i }}</td>
                      <td class="text-center">{{$cat->oper_name}}</td>
                      <td class="text-center">@if(isset( $cat->customer )){{ $cat->customer['name'] }}@endif</td>
                      <td class="text-center">{{ date('d/m/Y',strtotime($cat['dydate'])) }}</td>
                      <td class="text-center">{{ $cat->time }}</td>
                      <td class="text-center">{{ $cat->employee_name }}</td>
                      <td class="text-center">@if(isset($cat->from_area_name)){{ $cat->from_area_name }}@endif</td>
                      <td class="text-center">@if(isset($cat->to_area_name)){{ $cat->to_area_name }}@endif</td>
                      <td class="text-center">@if(isset($cat->vehicle)){{ $cat->vehicle }}@endif</td>
                      <td class="text-center">{{ $cat->status_name }}</td>
                      <td class="text-center">@if(isset($cat->company_name)){{ $cat->company_name }}@endif</td>
                      <td class="text-center">{{ $cat->total_money }}</td>
                      <td class="text-center">@if($cat->paid== 1) Paid  @else Not Paid @endif </td>
                  
                      <td class="text-center">  
                      @if($update == "yes")
                      <a href="{{ route('timetable.edit',['timetable' => $cat['id'] , 'menuid' => $menuid ] ) }}" class="label label-warning">@lang('home.edit') <i class="fa fa-edit"></i></a>
                      @endif
                      @if($delete == "yes")
                      <a href="{{ route('timetable.destory',['timetable' => $cat['id'] , 'menuid' => $menuid ] ) }}" class="label label-danger">@lang('home.delete') <i class="fa fa-times"></i></a>
                      @endif
                       </td>      </tr>
                      
             
                    <?php $i = $i + 1; ?>
                  @endforeach
                  </tbody>
              
                   <tfoot>
                      <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">  Operation number</th>
                    <th class="text-center">@lang('home.client')</th>
                    <th class="text-center"> @lang('home.operation_date')</th>
                    <th class="text-center"> @lang('home.time')</th>
                    <th class="text-center">@lang('home.employee')</th>
                    <th class="text-center"> From Area </th>
                    <th class="text-center"> To Area </th>
                    <th class="text-center"> Vehicle </th>
                    <th class="text-center"> Operation Status </th>
                      <th class="text-center"> Company </th>
                      <th class="text-center"> Company Revenue</th> 
                      <th class="text-center"> Paid Status</th> 
                      <th class="text-center"> options</th> 
                     
                    </tr>
                   </tfoot>
                  @else
                  <h3 class="text-center" style="color: red;">
                    <br>
                    <br>
                    <br>
                      @lang('home.empty_data')     
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
 </section><!-- /.content -->
  <script type="text/javascript">
    function searchcvs() {
      $('#searchrame').slideToggle();
    }
 </script>
@endsection