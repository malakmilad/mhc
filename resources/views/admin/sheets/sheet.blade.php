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
  <!--<div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-plus"></i>
              <h3 class="box-title">اضف العميل</h3>-->
       <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title"> اضف العميل </h5>
                <div class="card-tools">
              <!-- tools box -->
              <div class="pull-left box-tools">
                <a href="{{ route('sheet.index',$menuid) }}" class="btn btn-info btn-sm">العوده الي قائمة العميل <i class="fa fa-arrow-circle-left"></i></a>
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
                <form action="{{route('savesheet')}}" method="post" enctype="multipart/form-data" >
              {{ csrf_field() }}
                 <input type="hidden" name="menuid" value="{{ $menuid }}">

                <div class="form-group">
                  <label>ملف العملاء</label>
                  <input type="file" name="file" class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" required>
                </div>
                <div class="form-group">
                  <input type="submit" name="submit" class="form-control" value="store">
                </div>
              </form>
     </div>
  </div>
 </section>
 
     

@endsection