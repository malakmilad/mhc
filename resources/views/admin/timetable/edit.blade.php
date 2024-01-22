@extends('admin.layouts.master')
@section('pagetitle') @lang('home.task') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.task')
      <small>@lang('home.edit')</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>  @lang('home.edit') </a></li>
      <li class="active"> @lang('home.edit')</li>
    </ol>
 </section>
@endsection
@section('main-content')
<section class="content">
 <!-- <div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-edit"></i>
              <h3 class="box-title"> @lang('home.edit')</h3>    <div class="pull-left box-tools">-->
       <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  @lang('home.edit')</h5>
                <div class="card-tools">
              <!-- tools box -->
          
                <a href="{{ route('timetable.index',$menuid) }}" class="btn btn-info btn-sm">@lang('home.back') <i class="fa fa-arrow-circle-left"></i></a>
              </div><!-- /. tools -->
            </div>
            <div class="box-body">
            @if(count($errors) > 0)
                        <div class="alert alert-danger text-center">
                            @foreach($errors->all() as $error)
                                <P>{{ $error }}</P>
                            @endforeach
                        </div>
                        <div></div>
                    @endif
              <form action="{{ route('timetable.update',$timetable['id']) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="menuid" value="{{ $menuid }}">
                 <div class="form-group">
                 <lable>   Client Name </lable> <span style="color: red;">*</span>
                  <select class="form-control" name="sheet_id">
                     <option value=""> Select Client Name</option>
                     @foreach($allcustomers as $cust)
                      @if($timetable->sheet_id == $cust['id'])
                       <?php $selected = "selected";?>
                      @else
                       <?php $selected = "";?>
                      @endif
                      <option {{ $selected }} value="{{ $cust->id }}">{{ $cust->name }}</option>
                     @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <lable> @lang('home.operation_date')</lable>
                  <input type="date" class="form-control" name="dydate" value="{{ date('Y-m-d' , strtotime($timetable['dydate'])) }}" placeholder="ادخل تاريخ الانشاء">
                </div>

            <div class="form-group">
                  <label>  Operation number </label>
                    <input type="text"  class="form-control" required name="name" value="{{ $timetable['name'] }}" placeholder=" @lang('home.name')"/>
                </div>

                <div class="form-group">
                  <lable>   Operation reservation time </lable>
                  <input type="time" class="form-control" name="time" value="{{ $timetable['time'] }}" placeholder="ادخل الوقت">
                </div>

              <div class="form-group">
                    <select  class="form-control" name="from_area">
                      <label>From (Cities) </label>
                      <option value="">From (Cities)</option>
                      @foreach($fromareas as $fromarea)
                       @if($timetable->from_area == $fromarea['id'])
                       <?php $selected = "selected";?>
                      @else
                       <?php $selected = "";?>
                      @endif
                       <option {{$selected}} value="{{ $fromarea->id }}">@if(isset($fromarea->Gov['name']  )){{ $fromarea->Gov['name']  }}@endif/{{ $fromarea->name  }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group">
                    <select  class="form-control" name="to_area">
                      <label>From (Cities) </label>
                      <option value="">To (Cities)</option>
                      @foreach($toareas as $toarea)
                       @if($timetable->to_area == $toarea['id'])
                       <?php $selected = "selected";?>
                      @else
                       <?php $selected = "";?>
                      @endif
                      <option {{$selected}}
                       value="{{ $toarea->id }}">@if(isset( $toarea->Gov['name'])){{ $toarea->Gov['name']  }}@endif/{{ $toarea->name  }}</option>
                      @endforeach
                    </select>
                  </div>
                <div class="form-group">
                  <select  class="form-control" name="vehicle_id[]">
                     <label>Select Vehicle </label>
                     <option value="">Vehicle</option>
                    @foreach($allvehicles as $vehicle)
                    @if($vehicle1[0]->vehicle_id == $vehicle['id'])
                       <?php $selected = "selected";?>
                      @else
                       <?php $selected = "";?>
                      @endif
                     
                    <option {{$selected}}
                       value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <lable>  @lang('home.notes') </lable>
                  <textarea class="form-control" name="note" placeholder=" @lang('home.notes')">{{ $timetable['note'] }}</textarea>
                </div>

                <div class="form-group">
                   <lable>@lang('home.operation_type') </lable><span style="color: red;">*</span>
                  <select  class="form-control" name="tasktype">
                      @foreach($alltypes as $type)
                      @if($type->id==$timetable['taskType'])
                       <option value="{{$type->id}}" selected>{{$type->name}}</option>

                      @else
                     <option value="{{$type->id}}">{{$type->name}}</option>
                     @endif
                     @endforeach
                  </select>
                </div>
                
                <div class="form-group">
                   <lable>  @lang('home.employee')  </lable><span style="color: red;">*</span>
                  <select  class="form-control" name="employee">
                      @foreach($allusers as $user)
                       @if($user->id==$timetable['employee'])
                       <option value="{{$user->id}}" selected>{{$user->name}}</option>

                      @else
                     <option value="{{$user->id}}">{{$user->name}}</option>
                     @endif
                     @endforeach
                  </select>
                </div>

                <div class="form-group">
                   <lable>  @lang('home.operation_status') </lable><span style="color: red;">*</span>
                  <select  class="form-control" name="meetingstate">
                      @foreach($allstatus as $status)
                         @if($status->id==$timetable['meetingstate'])
                       <option value="{{$status->id}}" selected>{{$status->name}}</option>

                      @else
                     <option value="{{$status->id}}">{{$status->name}}</option>
                     @endif
                     @endforeach
                  </select>
                </div>
                                <div class="form-group">
                  <lable> @lang('home.total_money') </lable> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="total_money"  min="0" value="{{$timetable['total_money']}}" onblur="getRemain()">
                </div>
                
                 <div class="form-group">
                  <lable> @lang('home.paid') </lable> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="paid"  min="0" value="{{$timetable['paid']}}" onblur="getRemain()">
                 </div>
                 
                  <div class="form-group">
                  <lable> @lang('home.remaining') </lable> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="remaining"  min="0" value="{{$timetable['total_money']-$timetable['paid']}}" readonly>
                 </div>
                 
                  <div class="form-group">
                  <lable> @lang('home.desrved_date') </lable> <span style="color: red;"></span>
                  <input type="date" class="form-control"  name="desrved_date" value="{{$timetable['desrved_date']}}">
                 </div>
            <div class="box-footer clearfix">
              <button class="pull-left btn btn-default">@lang('home.save') <i class="fa fa-plus"></i></button>
            </div>
        </div>
      </form>
     </div>
  </div>
 </section>
  <script type="text/javascript">
   function cancelmeeting(i) {
     if(i == 2){
      $('#cancelreasons').slideDown();
     }else{
      $('#cancelreasons').slideUp();
      $('#cancelreasonsfield').val("");
     }
   }
    function getRemain(){
       var total=$("input[name=total_money]").val();
       var paid=$("input[name=paid]").val();
       var remain=total-paid;
       $("input[name=remaining]").val(remain);
   }
 </script>
@endsection