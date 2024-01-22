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
        <div class="col-lg-2 col-6">
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

                    <p>Operation With Vehicle Report</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="{{ route('timetable.reportvehicle', 47) }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <!-- ./col -->
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3><sup style="font-size: 20px"></sup></h3>

                    <p>Income Report</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('timetable.report', 33) }}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>

        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3><sup style="font-size: 20px"></sup></h3>

                    <p>Rate Report</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{ route('answer.report', 50) }}" class="small-box-footer">More info <i
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
                <a href="{{route('vehicle.report')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <!-- ./col -->
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
                        <h5 class="card-title"> Operations Vehicles Report</h5>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">

                        <form action="{{ route('timetable.reportsearchvehicle') }}" id="searchrame" method="post"
                            style=" margin-top: 20px; margin-left:30px;">
                            {{ csrf_field() }}
                            <input type="hidden" name="menuid" value="{{ $menuid }}">

                            <div class="row">
                                <div class="col-3">
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
                                </div>

                                <div class="col-3">
                                    <div class="form-group pull-left" style="margin-left: 5px;">
                                        <label> @lang('home.date') </label>
                                        <input type="date" name="dydate" class="col-sm-12 form-control">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label> Operation</label><span style="color: red;">*</span>
                                        <select class="form-control" name="operation">
                                            <option value="">Select Operation</option>

                                            @foreach ($alloperations as $operation)
                                                <option value="{{ $operation->id }}">{{ $operation->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label> Vehicle</label><span style="color: red;">*</span>
                                        <select class="form-control" name="vehicle">
                                            <option value="">Select Vehicle</option>
                                            @foreach ($allvehicles as $vehicle)
                                                <option value="{{ $vehicle->id }}">{{ $vehicle->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


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
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">Count</th>
                                @if (request()->input('datefrom'))
                                    <th class="text-center"> Operation From Date</th>
                                @endif
                                @if (request()->input('dateto'))
                                    <th class="text-center"> Operation To Date</th>
                                @endif
                                @if (!request()->input('dateto') && !request()->input('datefrom'))
                                    <th class="text-center"> Operation Date</th>
                                @endif


                                <th class="text-center">@lang('home.total_money')</th>
                                <th class="text-center">@lang('home.paid')</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">{{ $count1 }}</td>
                                @if (request()->input('datefrom'))
                                    <td class="text-center">{{ request()->input('datefrom') }}</td>
                                @endif
                                @if (request()->input('dateto'))
                                    <td class="text-center"> {{ request()->input('dateto') }}</td>
                                @endif
                                @if (!request()->input('dateto') && !request()->input('datefrom') && !request()->input('dydate'))
                                    <td class="text-center">{{ date('d/m/Y', strtotime($dydate)) }}</td>
                                @endif
                                @if (request()->input('dydate'))
                                    <td class="text-center">{{ request()->input('dydate') }}</td>
                                @endif

                                <!--@if (!request()->input('dateto') && !request()->input('datefrom'))
    <td class="text-center">{{ date('d/m/Y', strtotime($dydate)) }}</td>
    @endif-->
                                <td class="text-center">{{ $total_money }}</td>
                                <td class="text-center">{{ $paid }}</td>

                            </tr>
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>

    <script type="text/javascript">
        function searchcvs() {
            $('#searchrame').slideToggle();
        }
    </script>
@endsection
