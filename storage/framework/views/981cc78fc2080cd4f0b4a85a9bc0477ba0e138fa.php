
<?php $__env->startSection('pagetitle'); ?> <?php echo app('translator')->getFromJson('home.operations'); ?> <?php $__env->stopSection(); ?>
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
	    <li class="active">Income Report</li></li>
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
           <div class="col-lg-2 col-2">
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
         
          <div class="col-lg-4 col-4">
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
          <div class="col-lg-2 col-2">
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
          <div class="col-lg-2 col-2">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><sup style="font-size: 20px"></sup></h3>

                <p>Company Income Report</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo e(route('timetable.companyreport',53)); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

            <div class="col-lg-2 col-2">
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

      <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">Company Income Report</h5>
                <div class="card-tools">
                    <div class="input-menu" >
                  <!--  <a onclick="searchcvs()" style="font-size: 15px; font-weight: bold;margin-left: 5px;" class="btn btn-sm btn-info pull-right"><?php echo app('translator')->getFromJson('home.search'); ?> <i class="fa fa-search"></i></a>
-->
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <form action="<?php echo e(route('timetable.companyreportsearch')); ?>" id="searchrame" method="post" style=" margin-top: 20px; margin-left:30px;">
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
                  <div class="form-group pull-left" style="margin-left: 5px;">
                     <label> Company </label>
                   <select name="company_id" class="col-sm-12 form-control">
                     <option value="">Select Company</option>
                     <?php $__currentLoopData = $companies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($company->id); ?>"><?php echo e($company->name); ?></option>
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
                  <table class="table table-bordered table-hover" id="report">
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
                   <!--   <th class="text-center"> Ma3k Revenue</th> -->
                      <th class="text-center">Ma3k Company </th>
                      <th class="text-center">other Company Revenue</th> 
                      
                    </tr>
                   </thead>
                   <tbody>
                 
                     
                     <tr>
                      <td class="text-center"><?php echo e($count1); ?></td>
                      <?php if(  request()->input('datefrom')): ?>
                      <td class="text-center"><?php echo e(request()->input('datefrom')); ?></td>
                      <?php endif; ?>
                        <?php if(  request()->input('dateto')): ?>
                      <td class="text-caenter"> <?php echo e(request()->input('dateto')); ?></td>
                      <?php endif; ?>
                     <?php if(!request()->input('dateto') && ! request()->input('datefrom') && ! request()->input('dydate')): ?>
                    
                      <td class="text-center"><?php echo e(date('d/m/Y',strtotime($dydate))); ?></td>
                    
                     <?php endif; ?>
                     <?php if( request()->input('dydate')): ?>
                      <td class="text-center"><?php echo e(request()->input('dydate')); ?></td>
                      <?php endif; ?>
                    <!--  <th class="text-center"><?php echo e($ma3krevnue); ?></th>-->
                      <th class="text-center"><?php echo e($ma3krevnue); ?></th>
                      <td class="text-center"><?php echo e($deduct_value); ?></td>
                      </tr>
                   
               
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