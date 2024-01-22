@extends('admin.layouts.master')
@section('pagetitle') @lang('home.population') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.population')
      <small>@lang('home.edit')</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>  @lang('home.control') </a></li>
      <li class="active"> @lang('home.edit')</li>
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
              <h3 class="box-title"> @lang('home.edit')</h3>
              <!-- tools box -->
              <div class="pull-left box-tools">
                <a href="{{ route('population.index',$menuid) }}" class="btn btn-info btn-sm">  @lang('home.back') <i class="fa fa-arrow-circle-left"></i></a>
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
              <form action="{{ route('population.update',$Population['id']) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="menuid" value="{{ $menuid }}">
          
               
               <div class="form-group">
                <lable> @lang('home.housing') </lable> <span style="color: red;">*</span>
                <select class="form-control" name="housingid" required >
                    @foreach($allHousings as $housing)
                    @if($housing->id==$Population->housingid)
                    <option value="{{ $housing->id }}" selected>{{ $housing->name}}</option>
                    @else
                    <option value="{{ $housing->id }}">{{ $housing->name}}</option>
                    @endif
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <lable>  @lang('home.floor') </lable> <span style="color: red;">*</span>
                <input type="number" class="form-control" name="floor" value="{{ $Population->floor }}" required placeholder="@lang('home.floor')">
              </div>
              <div class="form-group">
                <lable>  @lang('home.area_unit') </lable> <span style="color: red;">*</span>
                <input type="number" min="0" step="0.1" class="form-control" name="area" value="{{ $Population->area }}" required placeholder="@lang('home.area_unit')">
              </div>
              <div class="form-group">
                <lable>  @lang('home.address_unit') </lable> <span style="color: red;">*</span>
                <input type="text" class="form-control" name="address" value="{{ $Population->address }}" required placeholder="@lang('home.address_unit')">
              </div>
             
              <div class="form-group">
                <lable>  @lang('home.rooms') </lable> <span style="color: red;">*</span>
                <input type="number" min="1" class="form-control" name="rooms" value="{{ $Population->rooms }}" required placeholder="@lang('home.rooms')">
              </div>
              <div class="form-group">
                <lable>  @lang('home.price') </lable> <span style="color: red;">*</span>
                <input type="number" min="1" class="form-control" name="price" value="{{ $Population->price }}" required placeholder="@lang('home.price')">
              </div>
              <div class="form-group">
                <lable>  @lang('home.commission') </lable> <span style="color: red;">*</span>
                <input type="number" min="1" class="form-control" name="commission" value="{{ $Population->commission }}" required placeholder="@lang('home.commission')">
              </div>
              <div class="form-group">
                <lable> @lang('home.client') </lable>
                <select class="form-control" name="clientid" >
                    <option value="">@lang('home.client')</option>

                    @foreach($sheets as $sheet)
                    @if($sheet->id==$Population->clientid)
                    <option value="{{ $sheet->id }}" selected>{{ $sheet->name}}</option>
                    @else
                    <option value="{{ $sheet->id }}">{{ $sheet->name}}</option>
                    @endif
                    @endforeach
                </select>
              </div>
              <div class="form-group">
                <lable>  @lang('home.description') </lable> 
                <textarea  class="form-control" name="description"  placeholder="@lang('home.description')">
                  {{ $Population->description }}
                </textarea>
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