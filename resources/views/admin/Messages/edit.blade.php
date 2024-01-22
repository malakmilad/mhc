@extends('admin.layouts.master')
@section('pagetitle') @lang('home.client_group') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.client_group')
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
                <a href="{{ route('client_message.index',$menuid) }}" class="btn btn-info btn-sm">  @lang('home.back') <i class="fa fa-arrow-circle-left"></i></a>
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
              <form  method="post">
                {{ csrf_field() }}
                <input type="hidden" name="menuid" value="{{ $menuid }}">
                
                <div class="form-group">
                  <lable>  @lang('home.content') </lable> <span style="color: red;">*</span>
                  <textarea class="form-control" name="content"  required placeholder="@lang('home.content')">
                    {{ $Message->content }}
                  </textarea>
                </div>
                <div class="form-group">
                  <label>@lang('home.client_group')</label>
                  <select name="groups[]"  required class="form-control" multiple>
                  <option value="" disabled>@lang('home.client_group')</option>
                  @foreach($allclientGroups as $group)
                    @if(in_array($group->id, $sheetMessages_group))
                    <option value="{{$group->id}}" selected>{{$group->name}}</option>
                    @else
                    <option value="{{$group->id}}" >{{$group->name}}</option>

                    @endif
                  @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label>@lang('home.sms_email')</label>
                  <select name="type"  class="form-control">
                    @if($Message->type==1)
                    <option value="1"  selected>@lang('home.email')</option>
                    <option value="2" >@lang('home.sms')</option>
                    <option value="3" >@lang('home.both')</option>
                    @elseif($Message->type==2)
                    <option value="1" >@lang('home.email')</option>
                    <option value="2" selected>@lang('home.sms')</option>
                    <option value="3" >@lang('home.both')</option>
                    @else
                    <option value="1" >@lang('home.email')</option>
                    <option value="2" >@lang('home.sms')</option>
                    <option value="3" selected>@lang('home.both')</option>
                    @endif


                  </select>
                </div>

                <div class="form-group">
                  <label>@lang('home.client')</label>
                  <select name="clients[]"  required class="form-control" multiple>
                  <option value="" disabled>@lang('home.client')</option>
                  @foreach($clients as $client)
                    @if(in_array($client->id, $sheetMessages_client))
                    <option value="{{$client->id}}" selected>{{$client->name}}</option>
                    @else
                    <option value="{{$client->id}}" >{{$client->name}}</option>

                    @endif
                  @endforeach
                  </select>
                </div>
             

            </div>
          
        </div>
      </form>
     </div>
  </div>
 </section>
@endsection