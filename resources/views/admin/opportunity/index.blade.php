@extends('admin.layouts.master')
@section('pagetitle') @lang('home.opportunity') @endsection
@section('contentheader') 
 <section class="content-header">
	  <h1>
	    @lang('home.opportunity')
	    <small>@lang('home.opportunity_desc')</small>
	  </h1>
	  <!-- <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i>  @lang('home.control') </a>
      </li>
	    <li class="active">@lang('home.opportunity')</li>
	  </ol> -->
      <a href="{{ route('home') }}"  class="btn btn-info btn-sm">@lang('home.control') <i class="fa fa-arrow-circle-left"></i></a>

 </section>
@endsection
@section('main-content')
 <section class="content">
   <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"> @lang('home.opportunity')</h3>
                  <div class="box-tools">
                    <div class="input-menu" >
                      <div class="input-group" >

                      <a onclick="searchcvs()" style="font-size: 15px; font-weight: bold;margin-left: 5px;" class="btn btn-sm btn-info pull-right">@lang('home.search') <i class="fa fa-search"></i></a>
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
                    
                    <a href="{{ route('opportunity.create',$menuid) }}" class="pull-right action add"> <i class="fa fa-plus"></i> Add </a>
                    @endif  
                    </div>
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">
                                  <form action="{{ route('search.opportunitysearch') }}" id="searchrame" method="post" style="display: none; margin-top: 20px; ">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="menuid" value="{{ $menuid }}">

                                   
                        
                                         <div class="form-group pull-left" style="margin-left: 5px;">
                                          <label>@lang('home.created_at')</label>
                                           <input type="date" name="created_at" class="col-sm-12 form-control" placeholder="">
                                         </div>
                                         
                                                                 
                                         <div class="form-group pull-left" style="margin-left: 5px;">
                                           <input type="text" name="name" class="col-sm-12 form-control" placeholder="@lang('home.name')">
                                         </div>
                                         
                                    <div class="form-group pull-left">
                                      <lable> @lang('home.client') </lable>
                                    <select class="col-sm-12 form-control" name="client">
                                        <option value=""> @lang('home.client')</option>
                                      @foreach($sheets as $sheet)
                                        <option value="{{ $sheet->id }}">{{ $sheet->name }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                        
                                        <div class="form-group pull-left" style="margin-left: 5px;">
                                           <input type="number" step="0.1" name="price" class="col-sm-12 form-control" placeholder="@lang('home.price')">
                                         </div>
                                        
                                              <div class="form-group pull-left" style="margin-left: 5px;">
                                          <label>@lang('home.expire_date')</label>
                                           <input type="date" name="expire_date" class="col-sm-12 form-control" placeholder="">
                                         </div>
                                   <div class="form-group pull-left">
                                      <lable> @lang('home.stage') </lable>
                                    <select class="col-sm-12 form-control" name="stage">
                                        <option value=""> @lang('home.stage')</option>
                                      @foreach($stages as $stage)
                                        <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                    
                                    <div class="form-group pull-left" style="margin-left: 5px;">
                                           <input type="number" step="0.1" name="probability" class="col-sm-12 form-control" placeholder="@lang('home.probability')">
                                         </div>
                                         <div class="form-group pull-left" style="margin-left: 5px">
                                           <input type="submit" value="@lang('home.search')" class="col-sm-12 form-control btn btn-success">
                                         </div>
                                </form>
                  <table class="display table-bordered" style="width:100%" id="report">
                      <thead>
                   @if($allOpportunitys->count() > 0)
                                         
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center"> @lang('home.serial')</th>
                      <th class="text-center">@lang('home.name')</th>
                      <th class="text-center">@lang('home.client')</th>
                      <th class="text-center">@lang('home.price')</th>
                      <th class="text-center"> @lang('home.expire_date')</th>
                      <th class="text-center">@lang('home.stage')</th>
                      <th class="text-center">@lang('home.probability')</th>
                      <th class="text-center"> @lang('home.created_at')</th>
                      <th class="text-center">@lang('home.options')</th>
                    </tr>
                    </thead>
                    <?php $i= 1;?>
                    </thead>
                    <tbody>
                  @foreach($allOpportunitys as $opportunity)
                    <tr>
                      <td class="text-center">{{ $i }}</td>
                      <td class="text-center">{{ $opportunity['id'] }}</td>
                      <td class="text-center">{{ $opportunity['name'] }}</td>
                      <td class="text-center">{{ $opportunity['customer_name'] }}</td>
                      <td class="text-center">{{ $opportunity['price'] }}</td>
                      <td class="text-center">{{ $opportunity['dueDate'] }}</td>
                      <td class="text-center">{{ $opportunity['stage_name'] }}</td>
                      <td class="text-center">{{ $opportunity['prop'] }}</td>
                      <td class="text-center">{{ date('d/m/Y',strtotime($opportunity['created_at'])) }}</td>
                      <td class="text-center">
                      @if($update == "yes")
                      <a href="{{ route('opportunity.edit',['opportunity' => $opportunity['id'] , 'menuid' => $menuid ] ) }}" class="action edit"><i class="fa fa-pencil"></i> </a>
                      @endif
                      @if($delete == "yes")
                      <a href="{{ route('opportunity.destory',['opportunity' => $opportunity['id'] , 'menuid' => $menuid ] ) }}" class="action delete"> <i class="fa fa-times"></i> </a>
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