@extends('admin.layouts.master')
@section('pagetitle') @lang('home.housing') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.housing')
      <small>@lang('home.add_new')</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> @lang('home.control') </a></li>
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
                <a href="{{ route('housing.index',$menuid) }}" class="btn btn-info btn-sm">  @lang('home.back') <i class="fa fa-arrow-circle-left"></i></a>
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
              <form action="{{ route('housing.store') }}" method="post">
              <input type="hidden" name="menuid" value="{{ $menuid }}">
                {{ csrf_field() }}
                <div class="form-group">
                  <lable>  @lang('home.name') </lable> <span style="color: red;">*</span>
                  <input type="text" class="form-control" name="name" value="{{ old('name') }}" required placeholder="@lang('home.name')">
                </div>
                <div class="form-group">
                  <lable>  @lang('home.email') </lable> <span style="color: red;">*</span>
                  <input type="text" class="form-control" name="email" value="{{ old('email') }}" required placeholder="@lang('home.email')">
                </div>
                <div class="form-group">
                  <lable>  @lang('home.address') </lable> <span style="color: red;">*</span>
                  <input type="text" class="form-control" name="address" value="{{ old('address') }}" required placeholder="@lang('home.address')">
                </div>
                <div class="form-group">
                  <lable>  @lang('home.phone') </lable> <span style="color: red;">*</span>
                  <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required placeholder="@lang('home.phone')">
                </div>
               

            </div>
            <div class="box-footer clearfix">
              <button class="pull-left btn btn-default">@lang('home.save') <i class="fa fa-plus"></i></button>
            </div>
        </div>
      </form>
     </div>
  </div>
 </section>
@endsection