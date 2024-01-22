@extends('admin.layouts.master')
@section('pagetitle')
    Car Report
@endsection
@section('contentheader')
    <section class="content-header text-right">
        <ol class="breadcrumb">
            <li>
                <a href="{{ route('home') }}" class="btn btn-info btn-sm">@lang('home.control') <i
                        class="fa fa-arrow-circle-left"></i></a>
            </li>
            <li class="active">Car Report</li>
            </li>
        </ol>
    </section>
@endsection
@section('main-content')
    <div class="row">
        <div class="col-lg-2 col-6">
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

        <div class="col-lg-2 col-6">
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
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3><sup style="font-size: 20px"></sup></h3>
                    <p>Vehicle Report</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="('vehicle.report')" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
            <div class="card-body">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h5 class="card-title">Car Report</h5>
                        </h5>
                        <div class="card-tools">
                            <div class="input-menu">
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                    </div>
                    <!-- resources/views/admin/cars/report.blade.php -->

                    <table class="table table-bordered table-hover" id="report">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Vehicle Name</th>
                                <th>Reservation Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($results as $result)
                                <tr>
                                    <td>{{ $result->user_name }}</td>
                                    <td>{{ $result->vehicle_name }}</td>
                                    <td>{{ $result->reservation_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
    </section>
@endsection
