@extends('admin.layouts.master')
@section('pagetitle')
    Operation with vehicle
@endsection
@section('contentheader')
    <section class="content-header text-right">
        <!--	  <h1>
         @lang('home.operations')
         <small>@lang('home.operations_desc')</small>
         </h1>-->
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}" class="btn btn-info btn-sm">@lang('home.control') <i
                        class="fa fa-arrow-circle-left"></i></a>
            </li>
            <!-- <li class="active">@lang('home.operations')</li>-->
        </ol>
    </section>
@endsection
@section('main-content')
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3></h3>

                    <p>Customer Report</p>
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('sheet.report', 48) }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3></h3>

                    <p>Client Operation Report</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('timetable.clientoperationreport', 61) }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3><sup style="font-size: 20px"></sup></h3>
                    <p>Veichle Report</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{route('veichle.report')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>


        <!--<section class="content">
           <div class="row">
                    <div class="col-xs-12">
                      <div class="box box-info">
                        <div class="box-header">
                          <h3 class="box-title"> @lang('home.operations')</h3>
                          <div class="box-tools">-->
        <div class="container-fluid h-100">
            <div class="card card-row card-secondary">
                <div class="card-body">
                    <div class="card card-info card-outline">
                        <div class="card-header">
                            <h5 class="card-title"> Client Operation Report</h5>
                        </div><!-- /.box-header -->
                        <div class="box-body table-responsive no-padding">

                            <form action="{{ route('timetable.searchclientoperationreport') }}" id="searchrame"
                                method="post" style=" margin-top: 20px; margin-left:30px;">
                                {{ csrf_field() }}
                                <input type="hidden" name="menuid" value="{{ $menuid }}">

                                <div class="row">
                                    <!--  <div class="col-3">
                               <div class="form-group pull-left" style="margin-left: 5px;">
                                 <label> @lang('home.datefrom') </label>
                     
                                 <input type="date" name="datefrom" class="col-sm-12 form-control" placeholder="">
                               </div>
                          </div>
                        <div class="col-3">
                           <div class="form-group pull-left" style="margin-left: 5px;">
                             <label> @lang('home.dateto') </label>
                         
                            <input type="date" name="dateto" class="col-sm-12 form-control" placeholder="">
                           </div>
                          </div >-->

                                    <div class="col-3">
                                        <div class="form-group pull-left" style="margin-left: 5px;">
                                            <label> @lang('home.date') </label>
                                            <input type="date" name="dydate" class="col-sm-12 form-control">
                                        </div>
                                    </div>

                                </div>
                                <div class="row">



                                    <div class="col-3">
                                        <div class="form-group pull-left" style="margin-left: 5px">
                                            <label> </label>
                                            <input type="submit" value="@lang('home.search')"
                                                class="col-sm-12 form-control btn btn-success">
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <?php $i = 1; ?>
                    <table class="table table-bordered table-hover " id="report">
                        <thead>
                            <th class="col-2">Index</th>
                            <th class="col-2">Operation No</th>
                            <th class="col-2">Customer Name</th>
                            <th class="col-2">Date</th>
                            <th class="col-2">Operation Detail</th>

                        </thead>
                        <tbody>
                            @foreach ($alltimetables as $timetable)
                                <tr>
                                    <td class="col-2">{{ $i }}</td>
                                    <td class="col-2">{{ $timetable->operation_name }}</td>
                                    <td class="col-2">{{ $timetable->customer_name }}</td>
                                    <td class="col-2">{{ $timetable->dydate }}</td>
                                    <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                            data-target="<?php echo '#task' . $i; ?>">Operations</button></td>
                                    <?php $i = $i + 1; ?>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>



                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>
    <?php $j = 1; ?>
    @foreach ($alltimetables as $timetable)
        <div id="<?php echo 'task' . $j; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog modal-xl ">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Operation</h4>
                    </div>
                    <div class="modal-body">

                        <table class="table table-bordered table-hover report" id="report">
                            <thead>
                                <tr>
                                    <th class="col-2"></th>
                                    <th class="col-2"></th>
                                    <th class="col-2"></th>
                                    <th class="col-2"></th>
                                    <th class="col-2"></th>
                                    <th class="col-2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="col-2">Customer Data</th>
                                    </th>
                                    <th class="col-2"></th>
                                    <th class="col-2"></th>
                                    <th class="col-2"></th>
                                    <th class="col-2"></th>
                                    <th class="col-2"></th>
                                </tr>
                                <tr>
                                    <th class="col-2">Customer Type</th>
                                    <td>{{ $timetable->customer_type }}
                                    <td>
                                    <td class="col-2"></td>
                                    <td class="col-2"></td>
                                    <td class="col-2"></td>
                                    <td class="col-2"></td>
                                </tr>
                                <tr>
                                    <th class="col-2">Customer Name</th>
                                    <td class="text-center col-2">{{ $timetable->customer_name }}</td>
                                    <th class="col-2">Customer phone</th>
                                    <td class="text-center col-2">{{ $timetable->customer_phone }}</td>
                                    <td class="col-2"></td>
                                    <td class="col-2"></td>
                                </tr>
                                <tr>
                                    <th class="col-2">Customer Disease</th>
                                    <td class="text-center col-2">{{ $timetable->disease_name }}</td>
                                    <th class="col-2">Customer weight</th>
                                    <td class="text-center col-2">{{ $timetable->customer_weight }}</td>
                                    <td class="col-2"></td>
                                    <td class="col-2"></td>
                                </tr>
                                <tr>
                                    <th class="col-2">Customer address</th>
                                    <td class="text-center col-2 ">{{ $timetable->address }}</td>
                                    <td class="col-2"></td>
                                    <td class="col-2"></td>
                                    <td class="col-2"></td>
                                    <td class="col-2"></td>
                                </tr>

                                <tr>
                                    <th class="col-2">Service Data</th>
                                    </th>
                                    <th class="col-2"></th>
                                    <th class="col-2"></th>
                                    <th class="col-2"></th>
                                    <th class="col-2"></th>
                                    <th class="col-2"></th>
                                </tr>
                                <tr>
                                    <th class="col-2">From Area</th>
                                    <td class="text-center col-2">{{ $timetable->from_area }}</td>
                                    <th class="col-2">To Area</th>
                                    <td class="text-center col-2">{{ $timetable->to_area }}</td>
                                    <td class="col-2"></td>
                                    <td class="col-2"></td>
                                </tr>
                                <tr>
                                    <th class="col-2">Direction</th>
                                    <td class="text-center ">{{ $timetable->direction }}</td>
                                    <td class="col-2"></td>
                                    <td class="col-2"></td>
                                    <td class="col-2"></td>
                                    <td class="col-2"></td>
                                </tr>
                                <tr>
                                    <th class="col-2">Service Cost</th>
                                    <td class="text-center col-2">{{ $timetable->service_cost }}</td>
                                    <th class="col-2">Wait Cost</th>
                                    <td class="text-center col-2">{{ $timetable->wait_cost }}</td>
                                    <th class="col-2">Total Money</th>
                                    <td class="text-center col-2">{{ $timetable->total_money }}</td>

                                </tr>

                                <tr>
                                    <th class="col-2">Operation No</th>
                                    <td class="text-center col-2">{{ $timetable->operation_name }}</td>
                                    <th class="col-2">Vehicle</th>
                                    <td class="text-center col-2">{{ $timetable->vehicle_name }}</td>
                                    <td class="col-2"></td>
                                    <td class="col-2"></td>
                                </tr>
                            </tbody>

                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">@lang('home.close')</button>
                    </div>
                </div>

            </div>
        </div>
        <?php $j = $j + 1; ?>
    @endforeach
    <script type="text/javascript">
        function searchcvs() {
            $('#searchrame').slideToggle();
        }
    </script>
@endsection
