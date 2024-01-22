<?php $__env->startSection('pagetitle'); ?>
    Car Report
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <section class="content-header text-right">
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(route('home')); ?>" class="btn btn-info btn-sm"><?php echo app('translator')->getFromJson('home.control'); ?> <i
                        class="fa fa-arrow-circle-left"></i></a>
            </li>
            <li class="active">Car Report</li>
            </li>
        </ol>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
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
                <a href="<?php echo e(route('sheet.report', 48)); ?>" class="small-box-footer">More info <i
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
                <a href="<?php echo e(route('timetable.reportvehicle', 47)); ?>" class="small-box-footer">More info <i
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
                <a href="<?php echo e(route('timetable.report', 33)); ?>" class="small-box-footer">More info <i
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
                <a href="<?php echo e(route('answer.report', 50)); ?>" class="small-box-footer">More info <i
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
                            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($result->user_name); ?></td>
                                    <td><?php echo e($result->vehicle_name); ?></td>
                                    <td><?php echo e($result->reservation_count); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>