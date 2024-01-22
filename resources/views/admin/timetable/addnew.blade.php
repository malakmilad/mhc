@extends('admin.layouts.master')
@section('pagetitle') @lang('home.task') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.task')
      <small>@lang('home.add_new')</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>  @lang('home.control') </a></li>
      <li class="active"> @lang('home.add_new')</li>
    </ol>
 </section>
@endsection
@section('main-content')
<section class="content">
  <div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
              <div class="box-header">
                  <i class="fa fa-plus"></i>
                  <h3 class="box-title"> @lang('home.add_new')</h3>
                  <!-- tools box -->
                    <div class="pull-left box-tools">
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
              <form  action="{{ route('timetable.store') }}" method="post">
                {{ csrf_field() }}
              <input type="hidden" name="menuid" value="{{ $menuid }}">

                <div class="form-group"> 
                  <label for="the-filter"> @lang('home.client') </label> <span style="color: red;">*</span>
                   <input type="text"  class="form-control"  list="sheet_id" name ="the-filter" id="the-filter" >
           
                   <datalist name="sheet_id" id="sheet_id"  >
                    
                     <option value="">@lang('home.client')</option>
                     @foreach($allcustomers as $cust)
                      <option data-value="{{ $cust->name }}" label="{{ $cust->name }}" value="{{ $cust->id }}">{{ $cust->name }}</option>
                     @endforeach
                  </datalist>
                </div>
      
                <div class="form-group">
                  <label> @lang('home.task_date') </label> <span style="color: red;">*</span>
                  <input type="date" class="form-control" required name="created_at" value="{{ date('Y-m-d') }}" >
                </div>

                <div class="form-group">
                  <label>   @lang('home.time') </label>
                  <input type="time" class="form-control" name="time"  value="{{ old('time') }}" >
                </div>


                <div class="form-group">
                  <label>  @lang('home.notes') </label>
                  <textarea class="form-control" name="note" placeholder=" @lang('home.notes')"></textarea>
                </div>
                
                <div class="form-group">
                   <label> @lang('home.task_type') </label><span style="color: red;">*</span>
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
                     <option value="{{$user->id}}">{{$user->name}}</option>
                     @endforeach
                  </select>
                </div>

                <div class="form-group">
                   <label> @lang('home.task_status') </label><span style="color: red;">*</span>
                  <select  class="form-control" name="meetingstate">
                      @foreach($allstatus as $status)
                     <option value="{{$status->id}}">{{$status->name}}</option>
                     @endforeach
                  </select>
                </div>
                
                <div class="form-group">
                  <label> @lang('home.total_money') </label> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="total_money"  min="0" value="0" onblur="getRemain()">
                </div>
                
                 <div class="form-group">
                  <label> @lang('home.paid') </label> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="paid"  min="0" value="0" onblur="getRemain()">
                 </div>
                 
                  <div class="form-group">
                  <label> @lang('home.remaining') </label> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="remaining"  min="0" value="0" readonly>
                 </div>
                 
                  <div class="form-group">
                  <label> @lang('home.desrved_date') </label> <span style="color: red;"></span>
                  <input type="date" class="form-control"  name="desrved_date" >
                 </div>
                
                
                
                <div class="form-group">
                  <label> @lang('home.repeat_task') </label> <span style="color: red;">*</span>
                  <input type="number" class="form-control"  name="repeat" required min="1" value="1">
                </div>

            </div>
            <div class="box-footer clearfix">
             <!-- <button class="pull-left btn btn-default">@lang('home.save') <i class="fa fa-plus"></i></button>-->
               <input type="submit" value="@lang('home.save')" class=" pull-left btn btn-default" formaction="{{ route('timetable.store') }}">
            </div>
        </div>
      <!--  <meta name="csrf-token" content="{{ csrf_token() }}" />
      </form>
     </div>
  </div>
</div>
 </section>
 @endsection
 <style type="text/css">
   #sheet_id option.hide 
   {
    display: none;
    }
 #sheet_id li.option 
    {
      display: none;
    }
 </style>
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


window.addEventListener("load", function(){
  // (B) ATTACH KEY UP LISTENER TO SEARCH BOX
  document.getElementById("the-filter").addEventListener("keyup", function(){
    // (C) GET THE SEARCH TERM
    var search = this.value.toLowerCase();

    // (D) GET ALL LIST ITEMS
    var all = document.querySelectorAll("#sheet_id option");

    // (E) LOOP THROUGH LIST ITELS - ONLY SHOW ITEMS THAT MATCH SEARCH
    for (let i of all) {
      let item = i.innerHTML.toLowerCase();
      if (item.indexOf(search) == -1) { i.classList.add("hide"); }
      else { i.classList.remove("hide"); }
    }
  });
});

 </script>
