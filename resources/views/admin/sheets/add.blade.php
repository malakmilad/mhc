@extends('admin.layouts.master')
@section('pagetitle') @lang('home.customer') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.customer')
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
<section class="content">
 <!-- <div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-plus"></i>
              <h3 class="box-title">@lang('home.add_new')</h3>-->
        <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  </h5>
                <div class="card-tools">
              <!-- tools box -->
              <div class="pull-left box-tools">
               <!-- <a href="{{ route('sheet.index',$menuid) }}" class="btn btn-info btn-sm">@lang('home.back') <i class="fa fa-arrow-circle-left"></i></a>-->
              </div><!-- /. tools -->
            </div>
           <div class="card-body">
            @if(count($errors) > 0)
                        <div class="alert alert-danger text-center">
                            @foreach($errors->all() as $error)
                                <P>{{ $error }}</P>
                            @endforeach
                        </div>
                    @endif
              <form action="{{ route('sheet.store') }}" method="post" id="AddSheet" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="menuid" value="{{ $menuid }}">
               @if( \Auth::user()->type == 1 )
                <div class="form-group">
                   <label> @lang('home.employee') </label> <span style="color: red;">*</span>

                  <select name="user_id" required class="form-control">
                    
                    @foreach($allusers as $userr)
                    @if( $userr['id']  == \Auth::user()->id )
                    <?php $selected = "selected"; ?>
                    @else
                    <?php $selected = ""; ?>
                    @endif
                      <option {{ $selected }} value="{{ $userr['id'] }}">{{ $userr['name'] }}</option>
                    @endforeach
                  </select>
                </div>
                @elseif(\Auth::user()->type == 0)
                <input type="hidden" name="user_id" value="{{ \Auth::user()->id }}">
               @endif
                <div class="form-group">
                   <label>@lang('home.name')</label> <span style="color: red;">*</span>
                  <input type="text" class="form-control" name="name"  required value="{{ old('name') }}" placeholder="@lang('home.name')">
                </div>

                <div class="form-group">
                   <label>@lang('home.email')</label>
                  <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="@lang('home.email')">
                </div>
                <div class="form-group">
                   <label>@lang('home.address')</label>
                  <input type="text" class="form-control" name="address" value="{{ old('address') }}" placeholder="@lang('home.address')">
                </div>
                <div class="form-group">
                   <label>@lang('home.customer_weight')</label>
                  <input type="number" class="form-control" name="customer_weight" value="{{ old('customer_weight') }}" placeholder="@lang('home.customer_weight')">
                </div>
                <div class="form-group">
                  <label> @lang('home.CustomerType') </label> <span style="color: red;">*</span>
                  <select name="customer_type" required class="form-control">
                  @foreach($customerTypess as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>  Dynamic Date </label>
                  <input type="date"  name="dynmicdate" class="form-control" />
                </div>

                <!--<div class="form-group">
                  <label> ادخل تاريخ الترحيل </label>
                  <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="dynmicdate">
                </div>-->

              
                <!--  <div class="form-group"> 
                      <label for="activitytype"> @lang('home.activity') </label> <span style="color: red;">*</span>
                      <input type="text"  class="form-control"  list="activity1" name ="activitytype" id="activitytype" >
                  </div>
                   <datalist id="activity1"  >
                    
                     <option value="">@lang('home.activity')</option>
                      @foreach($acivites as $activity)
                        <option value="{{ $activity->name }}">{{ $activity->name }}</option>
                      @endforeach
                    </datalist>-->
              

                    <div class="form-group">
                      <label> @lang('home.notes')</label>
                      <textarea class="form-control" name="note" placeholder="@lang('home.notes')">{{ old('note') }}</textarea>
                    </div>

                <!--<div class="form-group">
                   <label> ادخل حالة المتابعة </label>
                  <textarea class="form-control" name="followtype" placeholder="ادخل حالة المتابعة">{{ old('followtype') }}</textarea>
                </div>-->

               
                <div class="form-group">
                  <label>@lang('home.client_type')</label>
                <select class="form-control" name="isintrest">
                  @foreach($customerTypess as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                </div>
                
                <div class="form-group">
                  <label>@lang('home.know_from')</label>
                <select class="form-control" name="socail">
                  @foreach($socails as $socail)
                    <option value="{{ $socail->id }}">{{ $socail->name }}</option>
                    @endforeach
                </select>
                </div>
                
                    <div class="form-group">
                      <label>@lang('home.gov') </label>
                      <select name="govid" id="gov" required onchange="chnage_gov()" class="form-control">
                      <option value="">@lang('home.gov')</option>
                      @foreach($govs as $gov)
                        <option value="{{$gov->id}}">{{$gov->name}}</option>
                      @endforeach
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label>@lang('home.area')</label>
                      <select name="areaid" id="city" required class="form-control">
                      <option value="">@lang('home.area')</option>
                      @foreach($cities as $city)
                        <option value="{{$city->id}}" parent="{{$city->parentid}}" style="display:none">{{$city->name}}</option>
                      @endforeach
                      </select>
                    </div>
                     <div class="form-group">  <label>@lang('home.services') </label>
                      <select multiple class="form-control" name="service_id[]">
                      
                        <option value=""> Choose Service</option>
                        @foreach($allservices as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                      </select>
                    </div>

                      <div class="form-group"> <label> Disease </label>
                        <select multiple class="form-control" name="disease_id[]">
                          <option value="">Select Disease</option>
                          @foreach($alldiseases as $disease)
                          <option value="{{ $disease->id }}">{{ $disease->name }}</option>
                          @endforeach
                        </select>
                      </div>
                     <div class="form-group">
                      <label> @lang('home.upload_file')</label>
                      <input type="file" name="customerFile" class="form-control">
                    </div>

                <div class="form-group">
                   <label> @lang('home.color') </label>
                  <input type="color" value="#FFFFFF" class="form-control" name="color">
                </div>
                
                
                <div id="allphones">
                
                <div class="form-group" id="phoneframe1">
                  
                  <input type="text" class="form-control col-xs-5" required value="{{ old('number1') }}" name="number1" placeholder="ادخل رقم الهاتف">

                  <select id="phonetypeframe1" required class="form-control col-xs-5" style="margin-right: 5px;" name="phonetype1" placeholder="ادخل رقم الهاتف">

                  <option value="">@lang('home.phone_type')</option>
                    @foreach($allphonetypes as $phtype)
                      <option value="{{ $phtype->id }}">{{ $phtype->type }}</option>
                    @endforeach
                  </select>

                  <input onclick="deletephone(1)" type="button" disabled class="form-control col-xs-1 btn btn-danger pull-left" value="@lang('home.cancel')" >
                </div>
                
                </div>
                <br>
                <br>
                <div class="form-group col-xs-4">
                  <input onclick='addphone()' type='button' class='form-control btn btn-success' value='@lang('home.add_new')'>
                </div>

                <input type="hidden" name="itrator" id="itrator" value="1">

            </div>

           <hr>
            <div id="timetable" style="display:none;">

             <div class='form-group'>
             
             <label>  @lang('home.created_at') </label> <span style="color: red;">*</span>

             <input type='date' name='created_at'    class='form-control' placeholder='ادخل تاريخ الانشاء'>

             </div>

             <div class='form-group'>
             
             <label> تاريخ الترحيل </label> <span style="color: red;">*</span>

             <input type='date' value="{{ date('Y-m-d') }}" class='form-control' name='dydate' placeholder='ادخل تاريخ الترحيل'>

             </div>

             <div class='form-group'>
             <label> @lang('home.time')</label> <span style="color: red;">*</span>
             
             <input type='time' class='form-control' name='time' placeholder='@lang('home.time')'>

             </div>

             <div class='form-group'>
              <label> @lang('home.place_meet')</label> <span style="color: red;">*</span>
             <textarea class='form-control' name='meetingplace' placeholder='@lang('home.place_meet')'></textarea>
             </div>

             <div class='form-group'>
              <label>@lang('home.notes')</label>

             <textarea class='form-control' name='timenote' placeholder=' @lang('home.notes')'></textarea>
             </div>

             <div class='form-group'>

             <select class='form-control' name='meetingstate'><option value='0'>لم تتم المقابلة بعد</option><option value='1'>تمت المقابلة</option>
             </select>

             </div>

             <input type='hidden' name='checker' value="0" id="checker"/><button onclick='deletetimetable()'  type='button' class='btn btn-danger'> @lang('home.delete') </button>
            
            </div>

           <!-- <div id="timetablebutton">
            <button onclick='addtimetable()' id='buttonaddtimetable' type='button' class='btn btn-info'>اضافة ميعاد لهذا العميل 
            </button>
            </div>-->
            

            <div class="box-footer clearfix">
            <input class="pull-left btn btn-success" type="submit" name="saveandclose" value="@lang('home.save_close')" />
              <input class="pull-left btn btn-info" type="submit" name="saveandnew" value="@lang('home.save_new')" style="margin-left: 10px;"/>
            </div>
        </div>
      </form>
     </div>
  </div>
 </section>
 <style type="text/css">
   #activity1 option.hide 
   {
    display: none;
    }
 #activity1 li.option 
    {
      display: none;
    }
 </style>
 <script type="text/javascript">

      $(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        });

   function addtimetable(){
     
$('#timetable').slideDown();
$('#buttonaddtimetable').fadeOut();
$('#checker').val('1');

   }
   function deletetimetable(){
    
    $('#timetable').slideUp(function(){
      $('#buttonaddtimetable').fadeIn();
      $('#checker').val('0');
    });
    
    
   }
   function deletephone (num) {
   $('#phoneframe'+num).remove();
   $('#phonetypeframe'+num).remove();
   }
   function addphone(){

  var itrator = $('#itrator').val();
  itrator = +itrator+1;
  var newphone = "<div class='form-group' id='phoneframe"+itrator+"'><input type='text' class='form-control col-xs-5' name='number"+itrator+"' placeholder='ادخل رقم الهاتف'><input onclick='deletephone("+itrator+")' type='button' class='form-control col-xs-1 btn btn-danger pull-left' value='الغاء' ></div><select id='phonetypeframe"+itrator+"' class='form-control col-xs-5' style='margin-right: 5px;' name='phonetype"+itrator+"' placeholder='ادخل رقم الهاتف'><option value=''>-- اختر نوع الهاتف --</option>@foreach($allphonetypes as $phtype)<option value='{{ $phtype->id }}'>{{ $phtype->type }}</option>@endforeach</select>";

  $('#itrator').val(itrator);
  $('#allphones').append(newphone);
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
 document.getElementById("activitytype").addEventListener("keyup", function(){
    // (C) GET THE SEARCH TERM
    var search = this.value.toLowerCase();

    // (D) GET ALL LIST ITEMS
    var all = document.querySelectorAll("#activity1 option");

    // (E) LOOP THROUGH LIST ITELS - ONLY SHOW ITEMS THAT MATCH SEARCH
    for (let i of all) {
      let item = i.innerHTML.toLowerCase();
      if (item.indexOf(search) == -1) { i.classList.add("hide"); }
      else { i.classList.remove("hide"); }
    }
  });
}
 </script>
@endsection