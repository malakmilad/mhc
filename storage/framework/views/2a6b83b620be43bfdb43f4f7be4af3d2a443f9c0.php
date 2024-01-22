
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

                <p>Client Operation Report</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo e(route('timetable.clientoperationreport',61)); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
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
                <h5 class="card-title"> Client Operation Report</h5>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">

                <form action="<?php echo e(route('timetable.searchclientoperationreport')); ?>" id="searchrame" method="post" style=" margin-top: 20px; margin-left:30px;">
                    <?php echo e(csrf_field()); ?>

                <input type="hidden" name="menuid" value="<?php echo e($menuid); ?>">
            
                <div class="row">
                  <!--  <div class="col-3">    
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
                  </div >-->
             
                  <div class="col-3"> 
                    <div class="form-group pull-left" style="margin-left: 5px;">
                            <label> <?php echo app('translator')->getFromJson('home.date'); ?> </label>
                      <input type="date" name="dydate" class="col-sm-12 form-control">
                    </div>
                  </div>
               
              </div>
              <div class="row">
              
             
              
                  <div class="col-3">  
                    <div class="form-group pull-left" style="margin-left: 5px">
                      <label> </label>
                      <input type="submit" value="<?php echo app('translator')->getFromJson('home.search'); ?>" class="col-sm-12 form-control btn btn-success">
                    </div>
                  </div>
                </div>
              
                </form>
              </div>
             </div>
               
             <?php $i= 1;?>
             <table class="table table-bordered table-hover " id="report">
                  <thead>
                  <th class="col-2">Index</th>
                  <th class="col-2">Operation No</th>
                  <th class="col-2">Customer Name</th>
                  <th class="col-2">Date</th>
                  <th class="col-2">Operation Detail</th>
                  
                  </thead>
                    <tbody>
                      <?php $__currentLoopData = $alltimetables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timetable): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                     <tr>
                      <td class="col-2" ><?php echo e($i); ?></td>
                     <td class="col-2"><?php echo e($timetable->operation_name); ?></td>
                     <td class="col-2"><?php echo e($timetable->customer_name); ?></td>
                     <td class="col-2"><?php echo e($timetable->dydate); ?></td>
                    <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="<?php echo '#task'.$i?>">Operations</button></td>
                    <?php $i= $i + 1;?>
                    </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                  </table>
                    
                
                  
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
          <?php $j=1 ?>
          <?php $__currentLoopData = $alltimetables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $timetable): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
          <div id="<?php echo 'task'.$j?>" class="modal fade" role="dialog">
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
                            <th class="col-2" ></th> <th class="col-2" ></th> 
                            <th class="col-2" ></th> <th class="col-2" ></th>
                            <th class="col-2" ></th> <th class="col-2" ></th>
                          </tr>
                        </thead> 
                            <tbody>
                          <tr><th class="col-2">Customer Data</th>
                          </th> <th class="col-2" ></th> 
                            <th class="col-2" ></th> <th class="col-2" ></th>
                            <th class="col-2" ></th> <th class="col-2" ></th>
                          </tr>
                          <tr>
                          <th class="col-2">Customer Type</th>
                          <td ><?php echo e($timetable->customer_type); ?><td>
                          <td class="col-2"></td> <td class="col-2"></td> <td class="col-2"></td> <td class="col-2"></td>
                          </tr>
                          <tr>
                            <th class="col-2">Customer Name</th>
                            <td class="text-center col-2"><?php echo e($timetable->customer_name); ?></td>
                            <th class="col-2">Customer phone</th>
                            <td class="text-center col-2"><?php echo e($timetable->customer_phone); ?></td> <td class="col-2"></td> <td class="col-2"></td>
                          </tr>
                          <tr>
                            <th class="col-2">Customer Disease</th>
                            <td class="text-center col-2"><?php echo e($timetable->disease_name); ?></td>
                            <th class="col-2">Customer weight</th>
                            <td class="text-center col-2"><?php echo e($timetable->customer_weight); ?></td>
                            <td class="col-2"></td> <td class="col-2"></td>
                          </tr>
                          <tr>
                          <th class="col-2">Customer address</th>
                            <td  class="text-center col-2 "><?php echo e($timetable->address); ?></td> 
                            <td class="col-2"></td> <td class="col-2"></td> 
                            <td class="col-2"></td> <td class="col-2"></td>
                          </tr>
                        
                          <tr>
                            <th  class="col-2" >Service Data</th>
                            </th> <th class="col-2" ></th> 
                            <th class="col-2" ></th> <th class="col-2" ></th>
                            <th class="col-2" ></th> <th class="col-2" ></th>
                          </tr>
                        <tr>
                            <th class="col-2">From Area</th>
                            <td class="text-center col-2"><?php echo e($timetable->from_area); ?></td>
                            <th class="col-2">To Area</th>
                            <td class="text-center col-2"><?php echo e($timetable->to_area); ?></td> <td class="col-2"></td> <td class="col-2"></td>
                        </tr>
                        <tr>
                            <th class="col-2">Direction</th>
                            <td class="text-center "><?php echo e($timetable->direction); ?></td> <td class="col-2"></td> <td class="col-2"></td> <td class="col-2"></td> <td class="col-2"></td>
                        </tr>
                        <tr>
                            <th class="col-2">Service Cost</th>
                            <td class="text-center col-2"><?php echo e($timetable->service_cost); ?></td>
                            <th class="col-2">Wait Cost</th>
                            <td class="text-center col-2"><?php echo e($timetable->wait_cost); ?></td>
                            <th class="col-2">Total Money</th>
                            <td class="text-center col-2"><?php echo e($timetable->total_money); ?></td>
                        
                        </tr>
                    
                        <tr>
                            <th class="col-2" >Operation No</th>
                            <td class="text-center col-2"><?php echo e($timetable->operation_name); ?></td>
                            <th class="col-2">Vehicle</th>
                            <td class="text-center col-2"><?php echo e($timetable->vehicle_name); ?></td>
                            <td class="col-2"></td> <td class="col-2"></td>
                        </tr>
                        </tbody>
                 
              </table>
               
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->getFromJson('home.close'); ?></button>
            </div>
          </div>

        </div>
      </div>
      <?php $j=$j+1;?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  <script type="text/javascript">
    function searchcvs() {
      $('#searchrame').slideToggle();
    }
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>