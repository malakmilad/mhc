@extends('admin.layouts.master')
@section('pagetitle') الصفحة الشخصية @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      الصفحة الشخصية
      <small>يمكنك تعديل الصفحة الشخصية من هنا</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> لوحة التحكم </a></li>
      <li class="active">الصفحة الشخصية</li>
    </ol>
 </section>
@endsection
@section('main-content')
    <section class="content">

    <!--  <div class="row">
        <div class="col-md-9">
          <div class="nav-tabs-custom">-->
              <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-tools">
            <ul class="nav nav-tabs">
              <li  class="active"><a href="#settings" data-toggle="tab">الاعدادات</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="settings">
                <form class="form-horizontal" action="{{ route('updateprofile.updateprofile',\Auth::user()->id) }}" method="post">
                {{ csrf_field() }}
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label pull-right">الاسم</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" value="{{ \Auth::user()->name }}" placeholder="الاسم" name="name">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label pull-right">البريد الالكتروني</label>

                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail" placeholder="البريد الالكتروني" name="email" value="{{ \Auth::user()->email }}" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label pull-right">كلمة المرور</label>

                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName" placeholder="كلمة المرور" name="password">
                    </div>
                    <input type="hidden" name="type" value="{{ \Auth::user()->type }}">
                  </div>
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">حفظ التعديلات</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
               @if(\Auth::user()->logo == NULL)
               <img style="margin-right: 20%;" class="profile-user-img img-responsive img-circle" src="{{ asset('adminstyle/dist/img/user4-128x128.jpg') }}" alt="User profile picture">
               @else
               <img style="margin-right: 20%;height: 128px; width: 128px;" class="profile-user-img img-responsive img-circle" src="{{ asset('public/'.\Auth::user()->logo) }}" alt="User profile picture">
               @endif
                
              <h3 class="profile-username text-center">{{ \Auth::user()->name }}</h3>
              <form action="{{ route('updateprofile.log',\Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                
                {{ csrf_field() }}
              <input type="file" class="btn btn-default btn-block" name="logo" />

              <button class="btn btn-primary btn-block"><b>تغير الصورة الشخصية</b></button>
            </div>
              </form>
             
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
  @endsection