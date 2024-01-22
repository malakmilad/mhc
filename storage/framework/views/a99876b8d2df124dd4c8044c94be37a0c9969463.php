
<?php $__env->startSection('pagetitle'); ?> Operation with vehicle <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
 <section class="content-header text-right">
<!--	  <h1>
	    <?php echo app('translator')->getFromJson('home.operations'); ?>
	    <small><?php echo app('translator')->getFromJson('home.operations_desc'); ?></small>
	  </h1>-->
	  <ol class="breadcrumb">
	    <li>
          <a href="<?php echo e(route('home')); ?>"  class="btn btn-info btn-sm"><?php echo app('translator')->getFromJson('home.control'); ?> <i class="fa fa-arrow-circle-left"></i></a>
      </li>
	   <!-- <li class="active"><?php echo app('translator')->getFromJson('home.operations'); ?></li>-->
	  </ol>
 </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
      <!-- Small boxes (Stat box) -->
        <div class="row">
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3></h3>

                <p>Customer Report</p></p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo e(route('sheet.report',48)); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
              <a href="<?php echo e(route('timetable.reportvehicle',47)); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
         
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><sup style="font-size: 20px"></sup></h3>

                <p>Income Report</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo e(route('timetable.report',33)); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

            <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><sup style="font-size: 20px"></sup></h3>

                <p>Rate Report</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo e(route('answer.report',50)); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
                  <h3 class="box-title"> <?php echo app('translator')->getFromJson('home.operations'); ?></h3>
                  <div class="box-tools">-->
      <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  Operations Vehicles Report</h5>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <form action="<?php echo e(route('timetable.reportsearchvehicle')); ?>" id="searchrame" method="post" style=" margin-top: 20px; margin-left:30px;">
                    <?php echo e(csrf_field()); ?>

                <input type="hidden" name="menuid" value="<?php echo e($menuid); ?>">
            
                <div class="row">
                  <div class="col-3">    
                       <div class="form-group pull-left" style="margin-left: 5px;">
                         <label> <?php echo app('translator')->getFromJson('home.datefrom'); ?> </label>
             
                         <input type="date" name="datefrom" class="col-sm-12 form-control" placeholder="">
                       </div>
                  </div>
                  <div class="col-3">
                   <div class="form-group pull-left" style="margin-left: 5px;">
                     <label> <?php echo app('translator')->getFromJson('home.dateto'); ?> </label>
                 
                    <input type="date" name="dateto" class="col-sm-12 form-control" placeholder="">
                   </div>
                  </div >
             
                  <div class="col-3"> 
                    <div class="form-group pull-left" style="margin-left: 5px;">
                            <label> <?php echo app('translator')->getFromJson('home.date'); ?> </label>
                      <input type="date" name="dydate" class="col-sm-12 form-control">
                    </div>
                  </div>
                  <div class="col-3"> 
                   <div class="form-group">
                      <label> Operation</label><span style="color: red;">*</span>
                      <select  class="form-control" name="operation">
                            <option value="">Select Operation</option>
                    
                          <?php $__currentLoopData = $alloperations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($operation->id); ?>"><?php echo e($operation->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                   </div>
              </div>
              <div class="row">
                  <div class="col-3"> 
                   <div class="form-group">
                      <label> Vehicle</label><span style="color: red;">*</span>
                      <select  class="form-control" name="vehicle">
                        <option value="">Select Vehicle</option>
                          <?php $__currentLoopData = $allvehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($vehicle->id); ?>"><?php echo e($vehicle->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                   </div>
             
              
                  <div class="col-3">  
                    <div class="form-group pull-left" style="margin-left: 5px">
                      <label> </label>
                      <input type="submit" value="<?php echo app('translator')->getFromJson('home.search'); ?>" class="col-sm-12 form-control btn btn-success">
                    </div>
                  </div>
                </div>
              
                </form>
              </div>
                 <table class="table table-bordered table-hover" >
                   <thead>
                    <tr>
                        <th class="text-center">Count</th>
                       <?php if(  request()->input('datefrom')): ?>
                        <th class="text-center"> Operation From Date</th>
                       <?php endif; ?>
                       <?php if(  request()->input('dateto')): ?>
                        <th class="text-center"> Operation To Date</th>
                       <?php endif; ?>
                         <?php if(!request()->input('dateto') && ! request()->input('datefrom')): ?>
                          <th class="text-center"> Operation  Date</th>
                         <?php endif; ?>
                        

                        <th class="text-center"><?php echo app('translator')->getFromJson('home.total_money'); ?></th> 
                        <th class="text-center"><?php echo app('translator')->getFromJson('home.paid'); ?></th> 
                      
                    </tr>
                   </thead>
                   <tbody>
                    <tr>
                       <td class="text-center"><?php echo e($count1); ?></td>
                      <?php if(  request()->input('datefrom')): ?>
                      <td class="text-center"><?php echo e(request()->input('datefrom')); ?></td>
                      <?php endif; ?>
                      <?php if(  request()->input('dateto')): ?>
                      <td class="text-center"> <?php echo e(request()->input('dateto')); ?></td>
                      <?php endif; ?>
                      <?php if(!request()->input('dateto') && ! request()->input('datefrom') && ! request()->input('dydate')): ?>
                    
                      <td class="text-center"><?php echo e(date('d/m/Y',strtotime($dydate))); ?></td>
                    
                      <?php endif; ?>
                      <?php if( request()->input('dydate')): ?>
                      <td class="text-center"><?php echo e(request()->input('dydate')); ?></td>
                      <?php endif; ?>
                   
                      <!--<?php if(!request()->input('dateto') && ! request()->input('datefrom')): ?>
                       <td class="text-center"><?php echo e(date('d/m/Y',strtotime($dydate))); ?></td>
                      <?php endif; ?>-->
                      <td class="text-center"><?php echo e($total_money); ?></td>
                      <td class="text-center"><?php echo e($paid); ?></td>
                     
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>