<?php $__env->startSection('pagetitle'); ?> <?php echo app('translator')->getFromJson('home.operations'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
 <section class="content-header text-right">
	    <a href="<?php echo e(route('home')); ?>"  class="btn btn-info btn-sm"><?php echo app('translator')->getFromJson('home.control'); ?> <i class="fa fa-arrow-circle-left"></i></a>

 </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
 <section class="content">
      <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  <?php echo app('translator')->getFromJson('home.operations'); ?></h5>
                <div class="card-tools">
                    <div class="input-menu" >
                      <?php
                      $add = "no";
                      $update = "no";
                      $delete = "no";
                    ?>
                  </div>
                </div>
                <div class="box-body table-responsive no-padding">

                <form action="<?php echo e(route('timetable.timetablesearch')); ?>" id="searchrame" method="post" style=" margin-top: 20px; ">
                    <?php echo e(csrf_field()); ?>

                <input type="hidden" name="menuid" value="<?php echo e($menuid); ?>">
                <div class="row">
                 <div class="col-2"> 
                 <div class="form-group pull-left" style="margin-left: 5px;">
                         <label> <?php echo app('translator')->getFromJson('home.date'); ?> </label>
                   <input type="date" name="dydate" class="col-sm-12 form-control">
                 </div>
               </div>
                 <div class="col-2"> 
                 <div class="form-group pull-left" style="margin-left: 5px;">
                     <label> <?php echo app('translator')->getFromJson('home.employee'); ?> </label>
                   <select name="user_id" class="col-sm-12 form-control">
                     <option value=""><?php echo app('translator')->getFromJson('home.employee'); ?></option>
                     <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </select>
                 </div>
                  </div>
                 <div class="col-2"> 
                 <div class="form-group pull-left" style="margin-left: 5px;">
                       <label> <?php echo app('translator')->getFromJson('home.operation_created_by'); ?> </label>
                   <select name="created_by" class="col-sm-12 form-control">
                     <option value=""><?php echo app('translator')->getFromJson('home.operation_created_by'); ?></option>
                     <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </select>
                 </div>
                  </div>
                 <div class="col-2"> 
                  <div class="form-group pull-left" style="margin-left: 5px;">
                      <label> <?php echo app('translator')->getFromJson('home.client'); ?> </label>
                   <select name="client_id" class="col-sm-12 form-control">
                     <option value=""><?php echo app('translator')->getFromJson('home.client'); ?></option>
                     <?php $__currentLoopData = $allclients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($client->id); ?>"><?php echo e($client->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </select>
                 </div>
                </div>
                 <div class="col-2">  
                  <div class="form-group pull-left" style="margin-left: 5px;">
                    <label> <?php echo app('translator')->getFromJson('home.operation_type'); ?> </label>
                   <select name="operation_type" class="col-sm-12 form-control">
                     <option value=""><?php echo app('translator')->getFromJson('home.operation_type'); ?></option>
                     <?php $__currentLoopData = $alltypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </select>
                 </div>
                </div>
                <div class="col-2">  
                 <div class="form-group pull-left" style="margin-left: 5px;">
                    <label> <?php echo app('translator')->getFromJson('home.operation_status'); ?> </label>
                   <select name="operation_status" class="col-sm-12 form-control">
                     <option value=""><?php echo app('translator')->getFromJson('home.operation_status'); ?></option>
                     <?php $__currentLoopData = $allstatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($status->id); ?>"><?php echo e($status->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </select>
                 </div>
                </div>
                </div>
                <div class="row">
                   <div class="col-2">    
                       <div class="form-group pull-left" style="margin-left: 5px;">
                            <label> <?php echo app('translator')->getFromJson('home.datefrom'); ?> </label>
             
                   <input type="date" name="datefrom" class="col-sm-12 form-control" placeholder="">
                 </div>
                 </div>
                 <div class="col-2"><div class="form-group pull-left" style="margin-left: 5px;">
                     <label> <?php echo app('translator')->getFromJson('home.dateto'); ?> </label>
                 
                   <input type="date" name="dateto" class="col-sm-12 form-control" placeholder="">
                 </div>
                </div>
                <div class="col-8">  
                 <div class="form-group pull-left" style="margin-left: 5px">
                   <input type="submit" value="<?php echo app('translator')->getFromJson('home.search'); ?>" class="col-sm-12 form-control btn btn-success">
                     </div>
                </div>
                </div>
                </form>
     <br><br>
                  <table class="table table-bordered table-hover" id="report">
                   <?php if($alltimetables->count() > 0): ?>
                   <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center">  Operation number</th>
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.client'); ?></th>
                      <th class="text-center"> <?php echo app('translator')->getFromJson('home.operation_date'); ?></th>
                      <th class="text-center"> <?php echo app('translator')->getFromJson('home.time'); ?></th>
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.employee'); ?></th>
                      <th class="text-center"> From Area </th>
                      <th class="text-center"> To Area </th>
                      <th class="text-center"> Vehicle </th>
                      <th class="text-center"> Operation Status </th>
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.total_money'); ?></th> 
                      <th class="text-center">Paid Status</th> 
                    
                    <!--  <th class="text-center"> <?php echo app('translator')->getFromJson('home.operation_status'); ?></th>
                      <th class="text-center"> <?php echo app('translator')->getFromJson('home.operation_type'); ?></th>
                      <th class="text-center"> <?php echo app('translator')->getFromJson('home.operation_created_by'); ?></th>
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.refer_operation'); ?></th> 
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.repeat_operation'); ?></th> 
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.total_money'); ?></th> 
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.paid'); ?></th> 
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.remaining'); ?></th> 
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.desrved_date'); ?></th> -->


                      
                    </tr>
                   </thead>
                   <tbody>
                    <?php $i= 1;?>
                  <?php $__currentLoopData = $alltimetables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php
                    $operations=\App\Http\Controllers\TimeTableController::get_childs($cat->id);
                  ?>
                    <tr style="background-color: <?php echo e($cat['color']); ?>">
                      <td class="text-center"><?php echo e($i); ?></td>
                      <td class="text-center"><?php echo e($cat->oper_name); ?></td>
                      <td class="text-center"><?php if(isset( $cat->customer )): ?><?php echo e($cat->customer['name']); ?><?php endif; ?></td>
                      <td class="text-center"><?php echo e(date('d/m/Y',strtotime($cat['dydate']))); ?></td>
                      <td class="text-center"><?php echo e($cat->time); ?></td>
                      <td class="text-center"><?php echo e($cat->employee_name); ?></td>
                      <td class="text-center"><?php if(isset($cat->from_area_name)): ?><?php echo e($cat->from_area_name); ?><?php endif; ?></td>
                      <td class="text-center"><?php if(isset($cat->to_area_name)): ?><?php echo e($cat->to_area_name); ?><?php endif; ?></td>
                      <td class="text-center"><?php if(isset($cat->vehicle)): ?><?php echo e($cat->vehicle); ?><?php endif; ?></td>
                      <td class="text-center"><?php echo e($cat->status_name); ?></td>
                      <td class="text-center"><?php echo e($cat->total_money); ?></td>
                      <td class="text-center"><?php if($cat->paid_status== 1): ?>  Paid <?php else: ?> Not Paid <?php endif; ?> </td>
                   
                  
                     </tr>
                        <?php $j=$i+1 ;$count=0;?>
                  <?php $__currentLoopData = $operations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr style="background-color: <?php echo e($operation['color']); ?>">
                      <td class="text-center"><?php echo e($j); ?></td>
                      <td class="text-center"><?php echo e($operation->oper_name); ?></td>

                      <td class="text-center"><?php if(isset( $operation->customer)): ?><?php echo e($operation->customer['name']); ?><?php endif; ?></td></td>
                      <td class="text-center"><?php echo e(date('d/m/Y',strtotime($operation['dydate']))); ?></td>

                      <td class="text-center"><?php echo e($operation->time); ?></td>

                      <td class="text-center"><?php echo e($operation->employee_name); ?></td>
                      <td class="text-center"><?php if(isset($operation->from_area_name)): ?><?php echo e($operation->from_area_name); ?><?php endif; ?></td>
                      <td class="text-center"><?php if(isset($operation->to_area_name)): ?><?php echo e($operation->to_area_name); ?><?php endif; ?></td>
                      <td class="text-center"><?php if(isset($operation->vehicle)): ?><?php echo e($operation->vehicle); ?><?php endif; ?></td>
                      <td class="text-center"><?php echo e($operation->status_name); ?></td>
                      <td class="text-center"><?php echo e($operation->total_money); ?></td>
                      <td class="text-center"><?php if($cat->paid_status== 1): ?> Paid <?php else: ?> Not Paid <?php endif; ?> </td>
                   
                    
                    </tr>
                    <?php $count++;$j= $j + 1;?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $i= $j;?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
              
                   <tfoot>
                      <tr>
                    <th class="text-center">#</th>
                    <th class="text-center">  Operation number</th>
                    <th class="text-center"><?php echo app('translator')->getFromJson('home.client'); ?></th>
                    <th class="text-center"> <?php echo app('translator')->getFromJson('home.operation_date'); ?></th>
                    <th class="text-center"> <?php echo app('translator')->getFromJson('home.time'); ?></th>
                    <th class="text-center"><?php echo app('translator')->getFromJson('home.employee'); ?></th>
                    <th class="text-center"> From Area </th>
                    <th class="text-center"> To Area </th>
                 <th class="text-center"> Vehicle </th>
                 <th class="text-center">Paid Status</th> 
                  
                
                    </tr>
                   </tfoot>
                  <?php else: ?>
                  <h3 class="text-center" style="color: red;">
                    <br>
                    <br>
                    <br>
                      <?php echo app('translator')->getFromJson('home.empty_data'); ?>     
                    <br>
                    <br>
                    <br>
                  </h3>
                  <?php endif; ?>
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