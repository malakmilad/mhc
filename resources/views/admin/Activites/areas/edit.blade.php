@extends('admin.layouts.master')
@section('pagetitle')@lang('home.govs_areas') 
@endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.govs_areas') 

      <small>@lang('home.edit_govs_areas') 
      </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>  @lang('home.control')  </a></li>
      <li class="active"> @lang('home.edit_govs_areas') </li>
    </ol>
 </section>
@endsection
@section('main-content')
<section class="content">
  <div class="row">
   <!--  <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-edit"></i>
              <h3 class="box-title"> @lang('home.edit_govs_areas')</h3>
              <div class="pull-left box-tools">-->
     <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  @lang('home.edit_govs_areas')</h5>
                <div class="card-tools">
  
                <a href="{{ route('area.index',$menuid) }}" class="btn btn-info btn-sm"> @lang('home.back') <i class="fa fa-arrow-circle-left"></i></a>
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
              <form action="{{ route('area.update',$area['id']) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="menuid" value="{{ $menuid }}">
                   <div class="form-group">
      <label>@lang('home.english_name')</label>
      <input type="text" name="name" class="form-control" value="{{ $area->name }}" required>
    </div>
            <div class="form-group">
              <label> @lang('home.arabic_name')</label>
              <input type="text" name="arabicName" value="{{ $area->arabicName }}" class="form-control" required>
            </div>
            <input type="hidden" name="id" value="{{$area->id}}">
                <div class="form-group">
                         <label>@lang('home.gov')</label>
        
              <select name="parentid" class="form-control">
                  <option value="0">@lang('home.gov')</option>
                  @foreach ($govs as $gov)
                  @if ($gov->id==$area->parentid)
                    @if(Session::has("locale") && Session::get("locale")=="ar")

                   <option value="{{$gov->id}}" selected>{{$gov->arabicName}}</option>
                    @else
                    <option value="{{$gov->id}}" selected>{{$gov->name}}</option>

                    @endif
                  @else
                  @if(Session::has("locale") && Session::get("locale")=="ar")

                  <option value="{{$gov->id}}">{{$gov->arabicName}}</option>
                  @else
                  <option value="{{$gov->id}}">{{$gov->name}}</option>

                  @endif
                  @endif
                  @endforeach
              </select>
            </div>

             

            </div>
            <div class="box-footer clearfix">
              <button class="pull-left btn btn-default">@lang('home.save')<i class="fa fa-plus"></i></button>
            </div>
        </div>
      </form>
     </div>
  </div>
 </section>
@endsection