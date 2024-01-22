@extends('admin.layouts.master')
@section('pagetitle') @lang('home.operation') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.operation')
      <small>@lang('home.add_new')</small>
    </h1>
    <ol class="breadcrumb">
    <!--    <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> @lang('home.control') </a></li>-->
    <a href="{{ route('home') }}"  class="btn btn-info btn-sm">@lang('home.control') <i class="fa fa-arrow-circle-left"></i></a>

    <!--  <li class="active">@lang('home.add_new')</li>-->
  
    </ol>
 </section>
@endsection
@section('main-content')
<script>
  function CalculateRemaining(){
  //  let total_money = $("#total_money").val();
    var total=$("input[name=total_money]").val();
      $("input[name=paid]").val(total);
       var paid=$("input[name=paid]").val();
       var remain=total-paid;
       $("input[name=remaining]").val(remain);
  }
  function CalculateTotalMoney(){
  //  let total_money = $("#total_money").val();
  var service_cost=$("input[name=service_cost]").val();
    var wait_cost=$("input[name=wait_cost]").val();
    var total=parseFloat(wait_cost)+parseFloat(service_cost);
      $("input[name=total_money]").val(total);
       var paid=$("input[name=paid]").val();
       var remain=total-paid;
       $("input[name=remaining]").val(remain);
  }
 function getRemain(){
       var total=$("input[name=total_money]").val();
       var paid=$("input[name=paid]").val();
       var remain=total-paid;
       $("input[name=remaining]").val(remain);
   }
 function myFunction() {
                var checkBox = document.getElementById("CompanyAccount");
                var div = document.getElementById("companydiv");
                if (checkBox.checked == true) {
                    div.style.display = "block";
                } else {
                    div.style.display = "none";
                }
            }
  function viewValue()
  {
    var select = document.getElementById("accounttype");
     var div = document.getElementById("dealvalue");
     var value = select.options[select.selectedIndex].value;

    if(value=="value")
    {
       div.style.display = "block";
    } 
    else {
        div.style.display = "none";
    }
    
  }

</script>
<section class="content">
 <!-- <div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-plus"></i>
                <h3 class="box-title"> @lang('home.add_new')</h3>   <div class="pull-left box-tools">-->

                <!-- tools box -->
       <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  @lang('home.add_new')</h5>
                <div class="card-tools">
             
              <!--      <a href="{{ route('timetable.index',$menuid) }}" class="btn btn-info btn-sm">@lang('home.back') <i class="fa fa-arrow-circle-left"></i></a>-->
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
              <form method="post"  >
                {{ csrf_field() }}
              <input type="hidden" name="menuid" value="{{ $menuid }}">

        <!--     <div class="form-group"> 
                  <label>  @lang('home.client') </label> <span style="color: red;">*</span>
                  <select class="form-control" name="sheet_id1" required>
                     <option value="">@lang('home.client')</option>
                     @foreach($allcustomers as $cust)
                      <option value="{{ $cust->id }}">{{ $cust->name }}</option>
                     @endforeach
                  </select>
                </div>-->

                <div class="form-group"> 
                  <label for="sheet_id"> Client Name </label> <span style="color: red;">*</span>
                   <input type="text"  class="form-control"  list="sheet_id1" name ="sheet_id" id="sheet_id" >
                </div>
                    <datalist id="sheet_id1"  >
                     <option value="">@lang('home.client')</option>
                     @foreach($allcustomers as $cust)
                      <option data-value="{{ $cust->name }}"  value="{{ $cust->id }}---{{ $cust->name }}">{{ $cust->name }}</option>
                     @endforeach
                    </datalist>
                
                <div class="form-group">
                  <label> @lang('home.operation_date') </label> <span style="color: red;">*</span>
                  <input type="date" class="form-control" required name="dydate" value="{{ date('Y-m-d') }}" >
                </div>
                <div class="form-group">
                  <label> Operation number</label>
                    <input type="text"  class="form-control" required name="name" placeholder="Operation number"/>
                </div>
                
                <div class="form-group">
                  <label>   Operation reservation time </label>
                  <input type="time" class="form-control" name="time"  value="{{ old('time') }}" >
                </div>
              <!-- <div class="form-group"> 
                  <label for="sheet_id"> From (Cities) </label> <span style="color: red;">*</span>
                   <input type="text"  class="form-control"  list="from_area" name ="from_area" id="from_area" >
                </div>
                <datalist id="from_area"  >
                     <option value="">From (Cities)</option>
                     @foreach($fromareas as $fromarea)
                      <option data-value="{{ $fromarea->name }}"  value="{{ $fromarea->name }}">{{ $fromarea->name }}</option>
                     @endforeach
               </datalist>-->
                   <div class="form-group">
                    <select  class="form-control" name="from_area">
                      <label>From (Cities) </label>
                      <option value="">From (Cities)</option>
                      @foreach($fromareas as $fromarea)
                       <option value="{{ $fromarea->id }}">@if(isset($fromarea->Gov['name']  )){{ $fromarea->Gov['name']  }}@endif/{{ $fromarea->name  }}</option>
                      @endforeach
                    </select>
                  </div>
                <!--<div class="form-group"> 
                  <label for="to_area"> To (Cities) </label> <span style="color: red;">*</span>
                   <input type="text"  class="form-control"  list="to_area" name ="to_area" id="to_area" >
                </div>
                <datalist id="to_area"  >
                  <option value="">To (Cities)</option>
                  @foreach($toareas as $toarea)
                  <option data-value="{{ $toarea->name }}"  value="{{ $toarea->id }}/@if(isset($toarea->parent)){{ $toarea->parent }}@endif/{{ $toarea->name }}">
                    @if(isset($toarea->parent)){{ $toarea->parent }}@endif/{{ $toarea->name }}</option>
                  @endforeach
                </datalist>-->
                 <div class="form-group">
                    <select  class="form-control" name="to_area">
                      <label>لإخ (Cities) </label>
                      <option value="">To (Cities)</option>
                      @foreach($toareas as $toarea)
                      <option value="{{ $toarea->id }}">@if(isset( $toarea->Gov['name'])){{ $toarea->Gov['name']  }}@endif/{{ $toarea->name  }}</option>
                      @endforeach
                    </select>
                  </div>
              

               <div class="form-group">
                  <select  class="form-control" required name="vehicle_id[]">
                     <label>Select Vehicle </label>
                     <option value="">Vehicle</option>
                    @foreach($allvehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label> @lang('home.direction') </label> <span style="color: red;">*</span>
                  <select name="direction" required class="form-control">
                      <option value="">Select direction</option>
                      <option value="one way">one way</option>
                      <option value="Round trip">Round trip</option>
                      <option value="Wait">Wait</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>  @lang('home.notes') </label>
                  <textarea class="form-control" name="note" placeholder=" @lang('home.notes')"></textarea>
                </div>
                
                <div class="form-group">
                   <label> @lang('home.operation_type') </label><span style="color: red;">*</span>
                  <select  class="form-control" name="tasktype">
                      @foreach($alltypes as $type)
                     <option value="{{$type->id}}">{{$type->name}}</option>
                     @endforeach
                  </select>
                </div>
                
                <div class="form-group">
                   <label> @lang('home.employee') </label><span style="color: red;">*</span>
                  <select  class="form-control" name="employee">
                      @foreach($allusers as $user)
                      @if(isset($user_id) && $user_id==$user->id)
                         <option value="{{$user->id}}" selected>{{$user->name}}</option>
                         @else
                     <option value="{{$user->id}}">{{$user->name}}</option>
                     @endif
                     @endforeach
                  </select>
                </div>

                <div class="form-group">
                   <label> @lang('home.operation_status') </label><span style="color: red;">*</span>
                  <select  class="form-control" name="meetingstate">
                      @foreach($allstatus as $status)
                     <option value="{{$status->id}}">{{$status->name}}</option>
                     @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label> @lang('home.service_cost') </label> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="service_cost"  onkeyup="CalculateTotalMoney()" min="0" value="0" onblur="CalculateTotalMoney()">
                </div>
                <div class="form-group">
                  <label> @lang('home.wait_cost') </label> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="wait_cost"  onkeyup="CalculateTotalMoney()" min="0" value="0" onblur="CalculateTotalMoney()">
                </div>
                <div class="form-group">
                  <label> @lang('home.total_money') </label> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="total_money"  onkeyup="CalculateRemaining()" min="0" value="0" onblur="getRemain()">
                </div>
                
                 <div class="form-group">
                  <label> @lang('home.paid') </label> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="paid"  min="0" value="0" onblur="getRemain()" onkeyup="getRemain()">
                 </div>
                 
                  <div class="form-group">
                  <label> @lang('home.remaining') </label> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="remaining"  min="0" value="0" readonly>
                 </div>
                 
                  <div class="form-group">
                  <label> @lang('home.desrved_date') </label> <span style="color: red;"></span>
                  <input type="date" class="form-control"  name="desrved_date" >
                 </div>
                
                
                
        {{--<div class="form-group">
                  <label> @lang('home.repeat_operation') </label> <span style="color: red;">*</span>
                  <input type="number" class="form-control"  name="repeat" required min="1" value="1">
                </div>--}}    

                <input type="checkbox" id="CompanyAccount" name="CompanyAccount"  onclick="myFunction()">
                <label for="CompanyAccount"> Company Account</label><br>
               <!--  <fieldset>
                 <legend>Company Account:</legend>-->
                 <div class="thumbnail"  id="companydiv" style="display:none">
                 <div class="form-group">
                   <label> Company Name </label>
                      <select  class="form-control" name="company_id">
                          <option value="">Select company</option>
                          @foreach($allcompanies as $company)
                          <option value="{{$company->id}}">{{$company->name}}</option>
                          @endforeach
                      </select>
                </div>
                <div class="form-group">
                   <label> Select Account Type  </label>
                      <select  class="form-control"  onchange="viewValue()" id="accounttype" name="accounttype">
                          <option value=""> Select Account Type </option>
                            <option value="perc" > Percentage </option>
                              <option value="value"   > Value </option>
                      </select>
                </div>
                <input type="radio" id="add" name="Deal" value="add">
                <label for="add">Add</label><br>
                <input type="radio" id="deduct" name="Deal" value="deduct">
                <label for="deduct">Deduct</label><br>
                <div class="form-group" id="dealvalue" style="display:none">
                  <label> Deal Value </label>
                  <input type="number" class="form-control"  name="dealvalue"  required min="1" value="1">
                </div>
                </div>
               <!--  </fieldset>-->


         
            <div class="box-footer clearfix">
             <input class="pull-left btn btn-success" type="submit" name="saveandclose" value="@lang('home.save_close')" formaction="{{ route('timetable.store1')}}"/>
             <input class="pull-left btn btn-info" type="submit" name="saveandnew" value="@lang('home.save_new')" formaction="{{ route('timetable.store1')}}" style="margin-left: 10px;"/>
     
                   
            </div>
      
      </form>
      <meta name="csrf-token" content="{{ csrf_token() }}" />
         </div>
           </div>
     </div>
  </div>
  </section>
@endsection
 <style type="text/css">
   #sheet_id1 option.hide 
   {
    display: none;
    }
 #sheet_id1 li.option 
    {
      display: none;
    }
 </style>
 @push('scripts')
 <script type="text/javascript">
       $(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
             
        });

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
  
 //  window.addEventListener("load", function(){
  // (B) ATTACH KEY UP LISTENER TO SEARCH BOX
  document.getElementById("sheet_id").addEventListener("keyup", function(){
    // (C) GET THE SEARCH TERM
    var search = this.value.toLowerCase();

    // (D) GET ALL LIST ITEMS
    var all = document.querySelectorAll("#sheet_id1 option");

    // (E) LOOP THROUGH LIST ITELS - ONLY SHOW ITEMS THAT MATCH SEARCH
    for (let i of all) {
      let item = i.innerHTML.toLowerCase();
      if (item.indexOf(search) == -1) { i.classList.add("hide"); }
      else { i.classList.remove("hide"); }
    }
  });
//});
function CalculateRemaining(){
  //  let total_money = $("#total_money").val();
    var total=$("input[name=total_money]").val();
      $("input[name=paid]").val(total);
       var paid=$("input[name=paid]").val();
       var remain=total-paid;
       $("input[name=remaining]").val(remain);
  }
   $(function() {
    $('#CompanyAccount').change(function() {
      //  $('#companydiv').toggle($(this).is(':checked'));
        $('#companydiv').toggle( this.checked);
    });
});

function CalculateTotalMoney(){
  //  let total_money = $("#total_money").val();
    var service_cost=$("input[name=service_cost]").val();
    var wait_cost=$("input[name=wait_cost]").val();
    var total=parseFloat(wait_cost)+parseFloat(service_cost);
      $("input[name=total_money]").val(total);
       var paid=$("input[name=paid]").val();
       var remain=total-paid;
       $("input[name=remaining]").val(remain);
  }
 </script>

@endpush
