@extends('admin.layouts.master')
@section('pagetitle') @lang('home.user') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.user')
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
  <!--<div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-plus"></i>
              <h3 class="box-title"> @lang('home.add_new')</h3>-->
       <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title"> @lang('home.add_new')</h5>
                <div class="card-tools">
      
              <!-- tools box -->
              <div class="pull-left box-tools">
                <a href="{{ route('user.index',$menuid) }}" class="btn btn-info btn-sm">@lang('home.back') <i class="fa fa-arrow-circle-left"></i></a>
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
              <form action="{{ route('user.store') }}" method="post" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="menuid" value="{{ $menuid }}">
                <div class="form-group">
                  <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="@lang('home.name')">
                </div>

                <div class="form-group">
                  <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="@lang('home.email')">
                </div>

                <div class="form-group">
                  <input value="{{ old('password') }}" type="text" class="form-control" name="password" placeholder="@lang('home.password')">
                </div>

                <div class="form-group">
                  <input type="file" class="form-control" name="logo">
                </div>
                  <div class="form-group">
                  <select class="form-control"  name="manager">
                    <option value=0>@lang('home.manager')</option>
                    @foreach($allusers as $user)
                    <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control" multiple name="type[]">
                    <option value="">@lang('home.group')</option>
                    @foreach($allgroups as $group)
                    <option value="{{ $group['id'] }}">{{ $group['name'] }}</option>
                    @endforeach
                  </select>
                </div>

            </div>
            <div class="box-footer clearfix">
              <button class="pull-left btn btn-default">@lang('home.save') <i class="fa fa-plus"></i></button>
            </div>
        </div>
      </form>
     </div>
  </div>
</div>
 </section>
@endsection