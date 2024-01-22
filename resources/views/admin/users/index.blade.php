@extends('admin.layouts.master')
@section('pagetitle') @lang('home.users') @endsection
@section('contentheader') 
 <section class="content-header">
	  <h1>
	    @lang('home.users')
	    <small>@lang('home.users_desc')</small>
	  </h1>
	  <!-- <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i>  @lang('home.control') </a></li>
	    <li class="active">@lang('home.users')</li>
	  </ol> -->
      <a href="{{ route('home') }}"  class="btn btn-info btn-sm">@lang('home.control') <i class="fa fa-arrow-circle-left"></i></a>

 </section>
@endsection
@section('main-content')
 <section class="content">
  <!-- <div class="row">
     
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"> @lang('home.users')</h3>
                  <div class="box-tools">-->
       <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  @lang('home.users')</h5>
                <div class="card-tools">
                    <div class="input-menu">
                      <?php
                      $add = "no";
                      $update = "yes";
                      $delete = "no";
                    ?>
                    @foreach(\Auth::user()->groups as $usergroup)   <!-- user Groups -->
                      @foreach($usergroup->group->permissions as $permission)   <!-- group permissions -->
                         @if($permission['menu_id'] == $menuid )
                           @if($permission['add'] == 1 )
                             <?php $add = "yes";?>
                           @endif

                           @if($permission['delete'] == 1 )
                             <?php $delete = "yes";?>
                           @endif

                           @if($permission['update'] == 1 )
                             <?php $update = "yes";?>
                           @endif

                          @endif
                       @endforeach 
                    @endforeach
                    @if($add == "yes")
                    <a href="{{ route('user.create',$menuid) }}" class="pull-right action add"> <i class="fas fa-plus"></i> Add </a>
                    @endif  
                      
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive card-body">
                  <table class="display table-bordered  table-striped  table-hover table-sm " id="report" style="width:100%">
                   <thead class="thead-dark">
                   @if($allusers->count() > 0)
                    <tr>
                      <th class="text-center"># </th>
                      <th class="text-center">@lang('home.name')</th>
                      <th class="text-center">@lang('home.email')</th>
                      <th class="text-center">@lang('home.group')</th>
                      <th class="text-center">@lang('home.pic')</th>
                      <th class="text-center">@lang('home.created_at')</th>
                      <th class="text-center">@lang('home.options')</th>
                    </tr>
                    <?php $i= 1;?>
                    </thead>
                    <tbody>
                  @foreach($allusers as $cat)
                    <tr>
                      <td class="text-center">{{ $i }}</td>
                      <td class="text-center">{{ $cat['name'] }}</td>
                      <td class="text-center">{{ $cat['email'] }}</td>
                      <td class="text-center">
                        <?php $inde = 1;?>
                        @foreach($cat->groups as $group)
                        {{ $inde }} - {{ $group->group['name'] }}
                          <br>
                          <?php $inde = $inde + 1 ;?>
                        @endforeach
                      </td>

                      <td class="text-center">
                        @if($cat['logo'] == NULL)
                          <img style="width: 50px; height: 50px;" src="{{ asset('adminstyle/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
                        @else
                          <img style="width: 50px; height: 50px;" class="img-circle"  src="{{ asset('public/'.$cat->logo) }}" alt="User Image">
                        @endif
                      </td>
                      <td class="text-center">{{ date('H:i:s d/m/Y',strtotime($cat['created_at'])) }}</td>
                      <td class="text-center">
                          @if($update == "yes")
                          <a href="{{ route('user.edit',['user' => $cat['id'] , 'menuid' => $menuid ] ) }}" class="action edit"><i class="far fa-edit"></i> </a>
                          @endif
                          @if($delete == "yes")
                          <a href="{{ route('user.destory',['user' => $cat['id'] , 'menuid' => $menuid ] ) }}" class="action delete"> <i class="fas fa-times"></i> </a>
                          @endif
                      </td>
                    </tr>
                    <?php $i= $i + 1;?>
                  @endforeach
                  </tbody>
                  @else
                  <h3 class="text-center" style="color: red;">
                    <br>
                    <br>
                    <br>
                    @lang('home.empty_data')                    <br>
                    <br>
                    <br>
                  </h3>
                  @endif
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
</div>

 </section><!-- /.content -->
 
@endsection