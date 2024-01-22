@extends('admin.layouts.master')
@section('pagetitle') @lang('home.user') @endsection
@section('contentheader') 
 <section class="content-header text-right">
    <h1>
      @lang('home.user')
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
 <!-- <div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-edit"></i>
              <h3 class="box-title"> @lang('home.edit')</h3>-->
      <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  @lang('home.edit')</h5>
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
              <form action="{{ route('user.update',$user['id']) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <input type="hidden" name="menuid" value="{{ $menuid }}">
                <div class="form-group">
                  <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="@lang('home.name')">
                </div>

                <div class="form-group">
                  <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="@lang('home.email')">
                </div>

                <div class="form-group">
                  <input type="text" class="form-control" name="password" placeholder=" @lang('home.password')">
                </div>
                
                <div class="form-group">
                    @if($user['logo'] == NULL)
                         <img style="width: 50px; height: 50px;" src="{{ asset('adminstyle/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                      @else
                         <img style="width: 50px; height: 50px;" class="img-circle"  src="{{ asset('public/'.$user->logo) }}" alt="User Image">
                      @endif
                  <input type="file" class="form-control" name="logo">
                </div>
                 <div class="form-group">
                  <select class="form-control"  name="manager">
                    <option value=0>@lang('home.manager')</option>
                    @foreach($allusers as $user1)
                    @if($user1['id'] == $user->managerid)
                    <option value="{{ $user1['id'] }}" selected>{{ $user1['name'] }}</option>
                    @else
                    <option value="{{ $user1['id']}}">{{ $user1['name'] }} </option>
                    @endif
                    @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control" multiple name="type[]">
                    <option value="">@lang('home.group')</option>
                    @foreach($allgroups as $group)
                      
                      <?php $select = "";?>
                     @if (in_array($group->id, $groupsids)) {
                       <?php $select = "selected"; ?>
                     @endif

                    <option {{ $select }} value="{{ $group['id'] }}">{{ $group['name'] }}</option>
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