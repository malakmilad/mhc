<?php $__env->startSection('pagetitle'); ?>
    Rate Report
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?>
    <section class="content-header text-right">
        <!--	  <h1>
         <?php echo app('translator')->getFromJson('home.operations'); ?>
         <small><?php echo app('translator')->getFromJson('home.operations_desc'); ?></small>
         </h1>-->
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo e(route('home')); ?>" class="btn btn-info btn-sm"><?php echo app('translator')->getFromJson('home.control'); ?> <i
                        class="fa fa-arrow-circle-left"></i></a>

            </li>
            <li class="active">Rate Report</li>
            </li>
        </ol>
    </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
    <!--<section class="content">
           <div class="row">
                    <div class="col-xs-12">
                      <div class="box box-info">
                        <div class="box-header">
                          <h3 class="box-title"> <?php echo app('translator')->getFromJson('home.operations'); ?></h3>
                          <div class="box-tools">-->
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
                <a href="<?php echo e(route('sheet.report', 48)); ?>" class="small-box-footer">More info <i
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
                <a href="<?php echo e(route('timetable.reportvehicle', 47)); ?>" class="small-box-footer">More info <i
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
                <a href="<?php echo e(route('timetable.report', 33)); ?>" class="small-box-footer">More info <i
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
                <a href="<?php echo e(route('answer.report', 50)); ?>" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-2 col-6">
            <!-- small box -->
            <div class="small-box bg-dark">
                <div class="inner">
                    <h3><sup style="font-size: 20px"></sup></h3>
                    <p>Vehicle Report</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?php echo e(route('vehicle.report')); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <!-- ./col -->
    </div>

    <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
            <div class="card-body">
                <div class="card card-info card-outline">
                    <div class="card-header">
                        <h5 class="card-title"> Rate Report</h5>
                        </h5>
                        <div class="card-tools">
                            <div class="input-menu">
                                <!--  <a onclick="searchcvs()" style="font-size: 15px; font-weight: bold;margin-left: 5px;" class="btn btn-sm btn-info pull-right"><?php echo app('translator')->getFromJson('home.search'); ?> <i class="fa fa-search"></i></a>
        -->
                            </div>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive no-padding">

                        
                    </div>
                    <table class="table table-bordered table-hover" id="report">
                        <thead>
                            <tr>
                                <th class="text-center">Index</th>

                                <th class="text-center">Question Name</th>
                                <th class="text-center">Count of answers</th>
                                <th class="text-center">Answer Rate</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php $__currentLoopData = $allanswersgrouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $answer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="text-center"><?php echo e($i); ?></td>

                                    <td class="text-center"><?php echo e($answer->question); ?></td>
                                    <?php if($answer->question_type == 'Rating'): ?>
                                        <td class="text-center"><?php echo e($answer->ratingcount); ?></td>
                                        <td class="text-center"><?php echo e($answer->ratingvalue / $answer->ratingcount); ?></td>
                                    <?php else: ?>
                                        <td class="text-center"><?php echo e($answer->truefalsecount); ?></td>
                                        <td class="text-center"><?php echo e($answer->truefalsevalue / $answer->truefalsecount); ?>

                                        </td>
                                    <?php endif; ?>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </tbody>



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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>