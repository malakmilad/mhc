@extends('admin.layouts.master')
@section('pagetitle') @lang('home.client_type') @endsection
@section('contentheader') 
 <section class="content-header">
	  <h1>
	    @lang('home.client_type')
	    <small>@lang('home.client_type_desc')</small>
	  </h1>
	 <!-- <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i> @lang('home.control') </a>
      </li>
	    <li class="active">@lang('home.client_type')</li>
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
                  <h3 class="box-title">@lang('home.client_type')</h3>
                  <div class="box-tools">-->
        <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  @lang('home.add_new')</h5>
                <div class="card-tools">
                    <div class="input-menu" >
                      <?php
                      $add = "no";
                      $update = "no";
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
                    
                    <a href="{{ route('customer.create',$menuid) }}" class="pull-right action add"> <i class="fa fa-plus"></i> Add </a>
                    @endif  

                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">

                  <table class="display table-bordered" style="width:100%">
                      <thead>
                   @if($allCustomers->count() > 0)
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center"> @lang('home.serial')</th>
                      <th class="text-center">@lang('home.name')</th>
                      <th class="text-center"> @lang('home.created_at')</th>
                      <th class="text-center">@lang('home.options')</th>
                    </tr>
                    <?php $i= 1;?>
                    </thead>
                    <tbody>
                  @foreach($allCustomers as $customer)
                    <tr>
                      <td class="text-center">{{ $i }}</td>
                    <td class="text-center">{{ $customer['id'] }}</td>

                      <td class="text-center">{{ $customer['name'] }}</td>
                      <td class="text-center">{{ date('d/m/Y',strtotime($customer['created_at'])) }}</td>
                      <td class="text-center">
                      @if($update == "yes")
                      <a href="{{ route('customer.edit',['customer' => $customer['id'] , 'menuid' => $menuid ] ) }}" class="action edit"><i class="fa fa-edit"></i> </a>
                      @endif
                      @if($delete == "yes")
                      <a href="{{ route('customer.destory',['customer' => $customer['id'] , 'menuid' => $menuid ] ) }}" class="action delete"> <i class="fa fa-times"></i> </a>
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
                     @lang('home.empty_data')
                    <br>
                    <br>
                    <br>
                  </h3>
                  @endif
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
 </section><!-- /.content -->
  <script type="text/javascript">
    function searchcvs() {
      $('#searchrame').slideToggle();
    }
 </script>
@endsection