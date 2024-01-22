@extends('admin.layouts.master')
@section('pagetitle') @lang('home.govs_areas') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.govs_areas') 
      <small>@lang('home.add_new') </small>
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
 <!-- <div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-plus"></i>
              <h3 class="box-title">@lang('home.add_new')</h3>
              <div class="pull-left box-tools">-->
     <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  @lang('home.add_new')</h5>
                <div class="card-tools">
   
                <a href="{{ route('area.index',$menuid) }}" class="btn btn-info btn-sm">@lang('home.back') <i class="fa fa-arrow-circle-left"></i></a>
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
              <form action="{{ route('area.store') }}" method="post">
              <input type="hidden" name="menuid" value="{{ $menuid }}">
                {{ csrf_field() }}
             
                <div class="form-group">
                  <label>@lang('home.english_name')</label>
                  <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                  <label>@lang('home.arabic_name')</label>
                  <input type="text" name="arabicName" class="form-control" required>
                </div>
                
                    <div class="form-group">
                             <label>@lang('home.gov')</label>
            
                  <select name="parentid" class="form-control">
                      <option value="0">@lang('home.gov')</option>
                      @foreach ($govs as $gov)
                      @if(Session::has("locale") && Session::get("locale")=="ar")
                      <option value="{{$gov->id}}">{{$gov->arabicName}}</option>
                      @else 
                      <option value="{{$gov->id}}">{{$gov->name}}</option>

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