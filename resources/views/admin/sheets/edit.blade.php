@extends('admin.layouts.master')
@section('pagetitle') @lang('home.customer') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.customer')
      <small> @lang('home.edit')</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>   @lang('home.control') </a></li>
      <li class="active">  @lang('home.edit')</li>
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
              <h3 class="box-title">  @lang('home.edit')</h3>-->
        <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  @lang('home.edit')</h5>
                <div class="card-tools">
              <!-- tools box -->
              <div class="pull-left box-tools">
                <a href="{{ route('sheet.index',$menuid) }}" class="btn btn-info btn-sm"> @lang('home.back') <i class="fa fa-arrow-circle-left"></i></a>
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
              <form action="{{ route('sheet.update',$sheet['id']) }}" method="post">
                {{ csrf_field() }}

                @if( \Auth::user()->type == 1 )
                <div class="form-group">
                   <lable>  @lang('home.employee') </lable> <span style="color: red;">*</span>

                  <select name="user_id" class="form-control">
                    
                    @foreach($allusers as $userr)
                    @if( $userr['id']  == $sheet['user_id'] )
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

                <input type="hidden" name="menuid" value="{{ $menuid }}">
                <div class="form-group">
                  <lable>    @lang('home.name') </lable> <span style="color: red;">*</span>
                  <input type="text" class="form-control" name="name" value="{{ $sheet->name }}" placeholder=" @lang('home.name')">
                </div>

                <div class="form-group">
                  <lable>  @lang('home.email') </lable>
                  <input type="email" class="form-control" name="email" value="{{ $sheet->email }}" placeholder=" @lang('home.email')">
                </div>

                <div class="form-group">
                  <lable>   Dynamic Date </lable>
                  <input type="date" value="{{ date('Y-m-d' , strtotime($sheet['created_at'])) }}" class="form-control" name="dynmicdate">
                </div>

                <!--<div class="form-group">
                  <lable> ادخل تاريخ الترحيل </lable>
                  <input type="date" value="{{ $sheet->dynmicdate }}" class="form-control" name="dynmicdate">
                </div>-->

               <!-- <div class="form-group">
                   <lable>   @lang('home.activity')  </lable>
                  
                   <select name="activitytype" class="form-control">
                    
                    @foreach($acivites as $activity)
                      @if($activity->name==$sheet->activitytype)
                      <option value="{{ $activity->name }}" selected>{{ $activity->name }}</option>
                      @else
                      <option value="{{ $activity->name }}">{{ $activity->name }}</option>
                      @endif
                    @endforeach
                  </select>
                </div>-->

                <div class="form-group">
                    <lable>   @lang('home.notes') </lable>
                  <textarea class="form-control" name="note" placeholder="  @lang('home.notes')">{{ $sheet->note }}</textarea>
                </div>

                <!--<div class="form-group">
                  <lable> ادخل حالة المتابعة </lable>
                  <textarea class="form-control" name="followtype" placeholder="ادخل حالة المتابعة">{{ $sheet->followtype }}</textarea>
                </div>-->

               <!-- <div class="form-group"> <label> Disease </label>
                        <select multiple class="form-control" name="disease_id[]">
                          <option value="">Select Disease</option>
                          @foreach($alldiseases as $disease)
                          <option value="{{ $disease->id }}">{{ $disease->name }}</option>
                          @endforeach
                        </select>
                </div>-->
                  <div class="form-group">
                  <lable>  @lang('home.services') </lable>
                  <select multiple class="form-control" name="service_id[]">
                     <option value="">@lang('home.services')</option>
                     <?php $serviceids[] = 0;?>
                     @foreach($sheet->customerservice as $cusse)

                     <?php $serviceids[] = $cusse['service_id'];?>

                     @endforeach
                    @foreach($allservices as $service)
                     @if(in_array($service->id,$serviceids))
                      <?php $selected = "selected";?>
                     @else
                      <?php $selected = "";?>
                     @endif
                    <option {{ $selected }} value="{{ $service->id }}">{{ $service->name }}</option>
                      <?php $selected = "";?>
                    @endforeach
                  </select>
                </div>

                 <div class="form-group">
                  <lable>  Disease </lable>
                  <select multiple class="form-control" name="disease_id[]">
                     <option value="">Select Disease</option>
                     <?php $diseaseids[] = 0;?>
                     @foreach($sheet->diseaseservice as $cusse)

                     <?php $diseaseids[] = $cusse['disease_id'];?>

                     @endforeach
                    @foreach($alldiseases as $disease)
                     @if(in_array($disease->id,$diseaseids))
                      <?php $selected = "selected";?>
                     @else
                      <?php $selected = "";?>
                     @endif
                    <option {{ $selected }} value="{{ $disease->id }}">{{ $disease->name }}</option>
                      <?php $selected = "";?>
                    @endforeach
                  </select>
                </div>
              
                <div class="form-group">
                  <lable>  @lang('home.client_type') </lable>
                <select class="form-control" name="isintrest">
                  @foreach($customerTypess as $type)
                    @if($type->id==$sheet->isintrest)
                    <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                    
                    @else
                     <option value="{{ $type->id }}">{{ $type->name }}</option>

                    @endif
                    @endforeach
                </select>
                </div>
                
                <div class="form-group">
                  <lable>  @lang('home.know_from') </lable>
                <select class="form-control" name="socail">
                  @foreach($socails as $socail)
                    @if($socail->id==$sheet->socailid)

                    <option value="{{ $socail->id }}" selected>{{ $socail->name }}</option>
                    @else
                      
                    <option value="{{ $socail->id }}">{{ $socail->name }}</option>
                    
                    @endif
                    @endforeach
                </select>
                </div>
                
                <div class="form-group">
                  <label>@lang('home.gov') </label>
                  <select name="govid" id="gov" required onchange="chnage_gov()" class="form-control">
                  <option value=""> @lang('home.gov')</option>
                  @foreach($govs as $gov)
                    @if($gov->id==$mygov)
                    <option value="{{$gov->id}}" selected>{{$gov->name}}</option>
                    @else
                      <option value="{{$gov->id}}" >{{$gov->name}}</option>
            
                    @endif
                  @endforeach
                  </select>
                </div>
                
                <div class="form-group">
                  <label>@lang('home.area')</label>
                  <select name="areaid" id="city" required class="form-control">
                  <option value=""> @lang('home.area')</option>
                  @foreach($cities as $city)
                    @if($sheet->areaid==$city->id)
                    <option value="{{$city->id}}" parent="{{$city->parentid}}" selected>{{$city->name}}</option>
                    @else 
                       @if($city->parentid==$mygov)
                      <option value="{{$city->id}}" parent="{{$city->parentid}}" >{{$city->name}}</option>
                      @else
                      <option value="{{$city->id}}" parent="{{$city->parentid}}" style="display:none">{{$city->name}}</option>
            
                      @endif
            
                    @endif
                    
                  @endforeach
                  </select>
                </div>
                  <div class="form-group">
                      <label> @lang('home.upload_file')</label>
                      <a href="{{$sheet->file}}" width="800px" height="2100px" >  @lang('home.client_file')</a>

                      <input type="file" name="customerFile" class="form-control">
                    </div>

                <div class="form-group">
                  <input type="color" value="{{ $sheet->color }}" class="form-control" name="color">
                </div>

                <div id="allphones">
                <?php $i = 1;?>
                @foreach($sheet->phones as $phone)
                <div class="form-group" id="phoneframe{{ $i }}">
                  <input type="text" class="form-control col-xs-5" value="{{ $phone->phone }}" name="number{{ $i }}" placeholder="ادخل رقم الهاتف">

                  <select id="phonetypeframe{{ $i }}" class="form-control col-xs-5" style="margin-right: 5px;" name="phonetype{{ $i }}">

                  <option value="">@lang('home.phone_type')</option>
                    @foreach($allphonetypes as $phtype)
                      @if($phone->phonetype_id == $phtype->id)
                      <?php $selected = "selected";?>
                      @else
                      <?php $selected = "";?>
                      @endif
                      <option {{ $selected }} value="{{ $phtype->id }}">{{ $phtype->type }}</option>
                    @endforeach
                  </select>

                  <input onclick="deletephone({{ $i }})" type="button" class="form-control col-xs-1 btn btn-danger pull-left" value="الغاء" >
                </div>
                <?php $i = $i+1;?>
                @endforeach
                
                
                </div>
                <br>
                <br>
                <div class="form-group col-xs-4">
                  <input onclick="addphone()" type="button" class="form-control btn btn-success" value="@lang('home.add_new')">
                </div>

                <input type="hidden" name="itrator" id="itrator" value="{{ $i }}">
            </div>
            <div class="box-footer clearfix">
              <input class="pull-left btn btn-success" type="submit" name="saveandclose" value="@lang('home.save_close')" />
              <input class="pull-left btn btn-info" type="submit" name="saveandnew" value="@lang('home.save_new')" style="margin-left: 10px;"/>
            </div>
        </div>
      </form>
     </div>
  </div>
 </section>
 <script type="text/javascript">
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

}
 </script>
@endsection