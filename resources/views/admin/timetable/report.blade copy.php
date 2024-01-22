@extends('admin.layouts.master')
@section('pagetitle') @lang('home.tasks') @endsection
@section('contentheader') 
 <section class="content-header text-right">
	  <h1>
	    @lang('home.tasks')
	    <small>@lang('home.tasks_desc')</small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i>  @lang('home.control') </a>
      </li>
	    <li class="active">@lang('home.tasks')</li>
	  </ol>
 </section>
@endsection
@section('main-content')
 <section class="content">
   <div class="row">
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"> @lang('home.tasks')</h3>
                  <div class="box-tools">
                    <div class="input-menu" >
                  <!--  <a onclick="searchcvs()" style="font-size: 15px; font-weight: bold;margin-left: 5px;" class="btn btn-sm btn-info pull-right">@lang('home.search') <i class="fa fa-search"></i></a>
-->
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <form action="{{ route('timetable.reportsearch') }}" id="searchrame" method="post" style=" margin-top: 20px; margin-left:30px;">
                    {{ csrf_field() }}
                <input type="hidden" name="menuid" value="{{ $menuid }}">
            
                <div class="row">
                   <div class="col-4">    
                       <div class="form-group pull-left" style="margin-left: 5px;">
                         <label> @lang('home.datefrom') </label>
             
                         <input type="date" name="datefrom" class="col-sm-12 form-control" placeholder="">
                       </div>
                  </div>
                 <div class="col-4"><div class="form-group pull-left" style="margin-left: 5px;">
                     <label> @lang('home.dateto') </label>
                 
                    <input type="date" name="dateto" class="col-sm-12 form-control" placeholder="">
                 </div>
                
                  <div class="col-4">  
                    <div class="form-group pull-left" style="margin-left: 5px">
                      <input type="submit" value="@lang('home.search')" class="col-sm-12 form-control btn btn-success">
                    </div>
                  </div>
                </div>
                </div>
                </form>

                  <table class="table table-bordered table-hover" id="report">
                   @if($alltimetables->count() > 0)
                   <thead>
                    <tr>
                      <th class="text-center">#</th>
                     <!-- <th class="text-center"> @lang('home.serial')</th>
                      <th class="text-center">@lang('home.name')</th>-->
                      <th class="text-center"> @lang('home.task_date')</th>
                      <th class="text-center">@lang('home.total_money')</th> 
                      <th class="text-center">@lang('home.paid')</th> 
                    <!--  <th class="text-center">@lang('home.remaining')</th> -->
                      
                    </tr>
                   </thead>
                   <tbody>
                    <?php $i= 1;?>
               <!--   @foreach($alltimetables as $cat)-->
                  <?php
                    $tasks=\App\Http\Controllers\TimeTableController::get_childs($cat->id);
                  ?>
                    <tr style="background-color: {{ $cat['color']  }}">
                      <td class="text-center">{{ $i }}</td>
                      <!--   <th class="text-center">{{$cat->id}}</th>
                      <td class="text-center">@if(isset( $cat->name )){{ $cat->customer['name'] }}@endif</td>-->
                      <td class="text-center">{{ date('d/m/Y',strtotime($dydate)) }}</td>

                      <td class="text-center">{{ $total_money }}</td>
                      <td class="text-center">{{ $paid }}</td>
                   <!--   <td class="text-center">{{$cat->total_money-$cat->paid}}</td>   -->
                    </tr>
                        <?php $j=$i+1 ;$count=0;?>
                <!--  @foreach($tasks as $task)-->
                    <tr style="background-color: {{ $task['color']  }}">
                      <td class="text-center">{{ $j }}</td>
                   <!--   <td class="text-center">{{$task->id}}</td>

                      <td class="text-center">@if(isset( $task->name)){{ $task->name }}@endif</td>-->
                      <td class="text-center">{{ date('d/m/Y',strtotime($dydate)) }}</td>

                      <td class="text-center">{{ $total_money }}</td>
                      <td class="text-center">{{ $paid }}</td>
                    <!--  <td class="text-center">{{ $task->total_money-$task->paid }}</td>-->
                    </tr>
                    <?php $count++;$j= $j + 1;?>
               <!--   @endforeach-->
                    <?php $i= $j;?>
              <!--    @endforeach-->
                  </tbody>
              
                   <tfoot>
                  <tr>
                        <td class="text-center">{{ $count1 }}</td>
                      <!--<td class="text-center"></td>
                      <td class="text-center"></td>-->
                      <td class="text-center">{{ date('d/m/Y',strtotime($cat['dydate'])) }}</td>
                      <th class="text-center">{{$total_money}}</th>
                      <td class="text-center">{{$paid}}</td>
                      <!-- <td class="text-center"></td>-->
                  </tr>
                   </tfoot>
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