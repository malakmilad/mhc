@extends('admin.layouts.master')
@section('pagetitle') @lang('home.opportunity') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.opportunity')
      <small>@lang('home.add_new')</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>  @lang('home.control') </a></li>
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
              <h3 class="box-title">  @lang('home.add_new') </h3>
              <!-- tools box -->
              <div class="pull-left box-tools">
                <a href="{{ route('opportunity.index',$menuid) }}" class="btn btn-info btn-sm">@lang('home.back') <i class="fa fa-arrow-circle-left"></i></a>
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
              <form action="{{ route('opportunity.store') }}" method="post">
              <input type="hidden" name="menuid" value="{{ $menuid }}">
                {{ csrf_field() }}
                <div class="form-group">
                  <lable> @lang('home.name') </lable> <span style="color: red;">*</span>
                  <input type="text" class="form-control" name="name" value="{{ old('name') }}" required placeholder=" @lang('home.name') ">
                </div>
                <div class="form-group">
                  <lable> @lang('home.client') </lable> <span style="color: red;">*</span>
                  <select class="form-control" name="customerid" required >
                      @foreach($customers as $customer)
                      <option value="{{ $customer->id}}">{{ $customer->name}}</option>
                      @endforeach
                  </select>
                </div>
           
                <div class="form-group">
                  <lable> @lang('home.price') </lable> <span style="color: red;">*</span>
                  <input type="number" step="0.1" class="form-control" name="price" value="{{ old('price') }}" required placeholder="@lang('home.price') ">
                </div>
                <div class="form-group">
                  <lable> @lang('home.expire_date') </lable> <span style="color: red;">*</span>
                  <input type="date" class="form-control" name="dueDate" value="{{ old('dueDate') }}" required >
                </div>
                
                 <div class="form-group">
                  <lable> @lang('home.stage') </lable> <span style="color: red;">*</span>
                  <select class="form-control" name="stageid" required >
                      @foreach($stages as $stage)
                      <option value="{{ $stage->id}}">{{ $stage->name}}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <lable> @lang('home.probability') </lable> <span style="color: red;">*</span>
                  <input type="number" step="0.1" class="form-control" name="prop" value="{{ old('prop') }}" min="0" min="100" required placeholder="@lang('home.probability') ">
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