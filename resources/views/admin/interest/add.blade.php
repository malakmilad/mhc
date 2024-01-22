@extends('admin.layouts.master')
@section('pagetitle') العميل @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      العميل
      <small>يمكنك اضافة العميل من هنا</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> لوحة التحكم </a></li>
      <li class="active">اضافة العميل</li>
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
              <h3 class="box-title">اضف العميل</h3>
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
              <form action="{{ route('interest.store') }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="menuid" value="{{ $menuid }}">
                <div class="form-group">
                  <lable> ادخل اسم العميل </lable> <span style="color: red;">*</span>
                  <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="ادخل اسم العميل">
                </div>

                <div class="form-group">
                  <lable> ادخل البريد الالكتروني للعميل </lable>
                  <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="ادخل البريد الالكتروني">
                </div>

                <div class="form-group">
                  <lable> ادخل تاريخ الترحيل </lable>
                  <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="dynmicdate">
                </div>

                <div class="form-group">
                  <lable> ادخل نوع النشاط </lable>
                  <textarea class="form-control" name="activitytype" placeholder="ادخل نوع النشاط">{{ old('activitytype') }}</textarea>
                </div>

                <div class="form-group">
                  <lable> ادخل الملاحظات </lable>
                  <textarea class="form-control" name="note" placeholder="ادخل الملاحظات">{{ old('note') }}</textarea>
                </div>

                <div class="form-group">
                   <lable> ادخل حالة المتابعة </lable>
                  <textarea class="form-control" name="followtype" placeholder="ادخل حالة المتابعة">{{ old('followtype') }}</textarea>
                </div>

                <div class="form-group">
                  <lable>اختر الخدمات </lable>
                  <select multiple class="form-control" name="service_id[]">
                     <option value="">-- اختر الخدمات --</option>
                    @foreach($allservices as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <lable> اختر حالة العميل </lable>
                <select class="form-control" name="isintrest">
                  <option value="0">هذا العميل غير مهتم</option>
                  <option value="1">هذا العميل مهتم</option>
                  <option value="2">عميل شركة</option>
                </select>
                </div>

                <div class="form-group">
                    <lable> اختر اللون المميز لهذا  العميل </lable>
                  <input type="color" value="#FFFFFF" class="form-control" name="color">
                </div>

                <input type="hidden" name="user_id" value="{{ \Auth::user()->id }}">
                <div id="allphones">
                
                <div class="form-group" id="phoneframe1">
                  <input type="text" class="form-control col-xs-5" value="{{ old('number1') }}" name="number1" placeholder="ادخل رقم الهاتف">

                  <select id="phonetypeframe1" class="form-control col-xs-5" style="margin-right: 5px;" name="phonetype1" placeholder="ادخل رقم الهاتف">

                  <option value="">-- اختر نوع الهاتف --</option>
                    @foreach($allphonetypes as $phtype)
                      <option value="{{ $phtype->id }}">{{ $phtype->type }}</option>
                    @endforeach
                  </select>

                  <input onclick="deletephone(1)" type="button" disabled class="form-control col-xs-1 btn btn-danger pull-left" value="الغاء" >
                </div>
                
                </div>
                <br>
                <br>
                <div class="form-group col-xs-4">
                  <input onclick="addphone()" type="button" class="form-control btn btn-success" value="اضف رقم هاتف جديد">
                </div>

                <input type="hidden" name="itrator" id="itrator" value="1">


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