@extends('admin.layouts.master')
@section('pagetitle')
    @lang('home.population')
@endsection
@section('contentheader')
    <section class="content-header">
        <h1>
            Reports
        </h1>
        <a href="{{ route('home') }}" class="btn btn-info btn-sm">@lang('home.control') <i class="fa fa-arrow-circle-left"></i></a>

    </section>
@endsection
@section('main-content')
    <section class="content">
        <div class="container-fluid">

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
                        <a href="{{route('veichle.report')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
                <!-- ./col -->
            </div>


    </section><!-- /.content -->
    <script type="text/javascript">
        function searchcvs() {
            $('#searchrame').slideToggle();
        }
    </script>
@endsection
