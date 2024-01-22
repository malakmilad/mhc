@extends('admin.layouts.master')
@section('pagetitle') @lang('home.client_group') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.client_group')
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
                <a href="{{ route('client_groups.index',$menuid) }}" class="btn btn-info btn-sm">  @lang('home.back') <i class="fa fa-arrow-circle-left"></i></a>
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
              <form action="{{ route('client_groups.store') }}" method="post">
              <input type="hidden" name="menuid" value="{{ $menuid }}">
                {{ csrf_field() }}
                <div class="form-group">
                  <lable>  @lang('home.name') </lable> <span style="color: red;">*</span>
                  <input type="text" class="form-control" name="name" value="{{ old('name') }}" required placeholder="@lang('home.name')">
                </div>
                <div class="form-group">
                  <label>@lang('home.client')</label>
                  <select name="clients[]"  required class="form-control" multiple>
                  <option value="" disabled>@lang('home.client')</option>
                  @foreach($clients as $client)
                    <option value="{{$client->id}}" >{{$client->name}}</option>
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