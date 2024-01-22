@extends('admin.layouts.master')
@section('pagetitle') @lang('home.menus') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.menus')
      <small>@lang('home.add_menu')</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> @lang('home.control') </a></li>
      <li class="active"> @lang('home.add_menu')</li>
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
              <h3 class="box-title">@lang('home.add_menu')</h3>
              <!-- tools box -->
              <div class="pull-left box-tools">
                <a href="{{ route('menu.index',$menuid) }}" class="btn btn-info btn-sm">  @lang('home.back') <i class="fa fa-arrow-circle-left"></i></a>
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
              <form action="{{ route('menu.store') }}" method="post">
              <input type="hidden" name="menuid" value="{{ $menuid }}">
                {{ csrf_field() }}
                <div class="form-group">
                  <lable>  @lang('home.arabic_name') </lable> <span style="color: red;">*</span>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="@lang('home.arabic_name')">
                </div>

                <div class="form-group">
                  <lable> @lang('home.english_name') </lable> <span style="color: red;">*</span>
                  <input type="text" class="form-control" name="name_en" value="{{ old('name_en') }}" placeholder="@lang('home.english_name')">
                </div>

                <div class="form-group">
                  <lable> @lang('home.icon') </lable> <span style="color: red;">*</span>
                <input type="text" class="form-control" name="icon" value="{{ old('icon') }}" placeholder="@lang('home.icon')">
                </div>

                <div class="form-group">
                  <lable> @lang('home.menu_url') </lable>
                <input type="text" class="form-control" name="url" value="{{ old('url') }}" placeholder="@lang('home.menu_url')">
                </div>

                <div class="form-group"> 
                 <lable> @lang('home.parent') </lable>
                  <select class="form-control" value="{{ old('name') }}" name="parent_id">
                    <option value="">@lang('home.main_menu')</option>
                    @foreach($allmenus as $men)
                     @if(Session::has("locale") && Session::get("locale")=="ar")
                      <option value="{{ $men['id'] }}">{{ $men['name'] }}</option> 
                     @else 
                     <option value="{{ $men['id'] }}">{{ $men['name_en'] }}</option>
                     @endif
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
 </section>
@endsection