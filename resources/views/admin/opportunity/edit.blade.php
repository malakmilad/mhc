@extends('admin.layouts.master')
@section('pagetitle') @lang('home.opportunity') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.opportunity')
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
              <form action="{{ route('opportunity.update',$opportunity['id']) }}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="menuid" value="{{ $menuid }}">
                <div class="form-group">
                   <lable> @lang('home.name') </lable> <span style="color: red;">*</span>
                  <input type="text" class="form-control" name="name" value="{{ $opportunity->name }}" required placeholder=" @lang('home.name') ">
                </div>
                <div class="form-group">
                  <lable> @lang('home.client') </lable> <span style="color: red;">*</span>
                  <select class="form-control" name="customerid" required >
                      @foreach($customers as $customer)
                      @if($customer->id==$opportunity->customerid)
                      <option value="{{ $customer->id}}" selected>{{ $customer->name}}</option>
                      @else
                      <option value="{{ $customer->id}}">{{ $customer->name}}</option>
                      @endif
                      @endforeach
                  </select>
                </div>
           
                <div class="form-group">
                  <lable> @lang('home.price') </lable> <span style="color: red;">*</span>
                  <input type="number" step="0.1" class="form-control" name="price" value="{{ $opportunity->price }}" required placeholder="@lang('home.price') ">
                </div>
                <div class="form-group">
                  <lable> @lang('home.expire_date') </lable> <span style="color: red;">*</span>
                  <input type="date" class="form-control" name="dueDate" value="{{ $opportunity->dueDate }}" required >
                </div>
                
                 <div class="form-group">
                  <lable> @lang('home.stage') </lable> <span style="color: red;">*</span>
                  <select class="form-control" name="stageid" required >
                      @foreach($stages as $stage)
                      @if($stage->id==$opportunity->stageid)
                      <option value="{{ $stage->id}}" selected>{{ $stage->name}}</option>
                      @else
                      <option value="{{ $stage->id}}">{{ $stage->name}}</option>
                      @endif
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <lable> @lang('home.probability') </lable> <span style="color: red;">*</span>
                  <input type="number" step="0.1" class="form-control" name="prop" value="{{ $opportunity->prop }}" min="0" min="100" required placeholder=" @lang('home.probability') ">
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