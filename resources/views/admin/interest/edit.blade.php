@extends('admin.layouts.master')
@section('pagetitle') العميل @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      العميل
      <small>يمكنك تعديل العميل من هنا</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> لوحة التحكم </a></li>
      <li class="active">تعديل العميل</li>
    </ol>
 </section>
@endsection
@section('main-content')
<section class="content">
  <div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-edit"></i>
              <h3 class="box-title">تعديل العميل</h3>
              <!-- tools box -->
              <div class="pull-left box-tools">
                <a href="{{ route('interest.index',$menuid) }}" class="btn btn-info btn-sm">العوده الي قائمة العميل <i class="fa fa-arrow-circle-left"></i></a>
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
              <form action="{{ route('interest.update',$interest['id']) }}" method="post">
                {{ csrf_field() }}

                @if( \Auth::user()->type == 1 )
                <div class="form-group">
                   <lable>اختر الموظف </lable> <span style="color: red;">*</span>

                  <select name="user_id" class="form-control">
                    
                    @foreach($allusers as $userr)
                    @if( $userr['id']  == $interest['user_id'] )
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
                  <lable> ادخل اسم العميل </lable> <span style="color: red;">*</span>
                  <input type="text" class="form-control" name="name" value="{{ $interest->name }}" placeholder="ادخل اسم العميل">
                </div>

                <div class="form-group">
                  <lable> ادخل البريد الالكتروني للعميل </lable>
                  <input type="email" class="form-control" name="email" value="{{ $interest->email }}" placeholder="ادخل البريد الالكتروني">
                </div>

                <div class="form-group">
                   <lable> ادخل تاريخ الترحيل </lable>
                  <input type="date" value="{{ $interest->dynmicdate }}" class="form-control" name="dynmicdate">
                </div>

                <div class="form-group">
                  <lable> ادخل نوع النشاط </lable>
                  <textarea class="form-control" name="activitytype" placeholder="ادخل نوع النشاط">{{ $interest->activitytype }}</textarea>
                </div>

                <div class="form-group">
                  <lable> ادخل الملاحظات </lable>
                  <textarea class="form-control" name="note" placeholder="ادخل الملاحظات">{{ $interest->note }}</textarea>
                </div>

                <div class="form-group">
                   <lable> ادخل حالة المتابعة </lable>
                  <textarea class="form-control" name="followtype" placeholder="ادخل حالة المتابعة">{{ $interest->followtype }}</textarea>
                </div>

                <div class="form-group">
                    <lable>اختر الخدمات </lable>
                  <select multiple class="form-control" name="service_id[]">
                     <option value="">-- اختر الخدمات --</option>
                     <?php $serviceids[] = 0;?>
                     @foreach($interest->customerservice as $cusse)

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
                 <lable> اختر حالة العميل </lable>
                <select class="form-control" name="isintrest">
                  @if($interest->isintrest == 0)
                   <?php $selected0 = "selected";$selected1 = "";$selected2 = "";?>
                  @elseif($interest->isintrest == 1)
                   <?php $selected1 = "selected";$selected0 = "";$selected2 = "";?>
                  @elseif($interest->isintrest == 2)
                   <?php $selected1 = "";$selected0 = "";$selected2 = "selected";?>
                  @endif
                  <option {{ $selected0 }} value="0">هذا العميل غير مهتم</option>
                  <option {{ $selected1 }} value="1">هذا العميل مهتم</option>

                  <option {{ $selected2 }} value="2">عميل شركة</option>
                </select>
                </div>

                <div class="form-group">
                     <lable> اختر اللون المميز لهذا  العميل </lable>
                  <input type="color" value="{{ $interest->color }}" class="form-control" name="color">
                </div>

                <div id="allphones">
                <?php $i = 1;?>
                @foreach($interest->phones as $phone)
                <div class="form-group" id="phoneframe{{ $i }}">
                  <input type="text" class="form-control col-xs-5" value="{{ $phone->phone }}" name="number{{ $i }}" placeholder="ادخل رقم الهاتف">

                  <select id="phoneframe{{ $i }}" class="form-control col-xs-5" style="margin-right: 5px;" name="phonetype{{ $i }}">

                  <option value="">-- اختر نوع الهاتف --</option>
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
                  <input onclick="addphone()" type="button" class="form-control btn btn-success" value="اضف رقم هاتف جديد">
                </div>

                <input type="hidden" name="itrator" id="itrator" value="{{ $i }}">
            </div>
            <div class="box-footer clearfix">
              <input class="pull-left btn btn-success" type="submit" name="saveandclose" value="save&close" />
              <input class="pull-left btn btn-info" type="submit" name="saveandnew" value="save&new" style="margin-left: 10px;"/>
              
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
 </script>
@endsection