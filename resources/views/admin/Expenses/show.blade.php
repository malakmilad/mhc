@extends('admin.layouts.master')
@section('pagetitle') السنوات @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      السنوات
      <small>يمكنك تعديل السنوات من هنا</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> لوحة التحكم </a></li>
      <li class="active">تعديل السنوات</li>
    </ol>
 </section>
@endsection
@section('main-content')
<section class="content">
  <!--<div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-edit"></i>
              <h3 class="box-title">تعديل السنوات</h3>
              <div class="pull-left box-tools">-->
      <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  @lang('home.Diseases')</h5>
                <div class="card-tools">
 
                <a href="{{ route('years.index') }}" class="btn btn-info btn-sm">العوده الي قائمة السنوات <i class="fa fa-arrow-circle-left"></i></a>
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
              <form action="{{ route('years.update',$years['id']) }}" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                  <input type="text" class="form-control" name="year" value="{{ $years->year }}" placeholder="ادخل السنة">
                </div>
            </div>
            <div class="box-footer clearfix">
              <button class="pull-left btn btn-default">حفظ <i class="fa fa-plus"></i></button>
            </div>
        </div>
      </form>
     </div>
  </div>
 </section>
@endsection