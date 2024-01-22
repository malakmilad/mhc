
<?php $__env->startSection('pagetitle'); ?> <?php echo app('translator')->getFromJson('home.operations'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
 <section class="content-header text-right">
	<!--  <h1>
	    <?php echo app('translator')->getFromJson('home.operations'); ?>
	    <small><?php echo app('translator')->getFromJson('home.operations_desc'); ?></small>
	  </h1>
	  <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i>  <?php echo app('translator')->getFromJson('home.control'); ?> </a>
      </li>
	    <li class="active"><?php echo app('translator')->getFromJson('home.operations'); ?></li>
	  </ol>-->
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
                  </div>
                </div>
                <div class="box-body table-responsive no-padding">

                <form action="<?php echo e(route('timetable.companyoperationssearch')); ?>" id="searchrame" method="post" style=" margin-top: 20px; ">
                    <?php echo e(csrf_field()); ?>

                <input type="hidden" name="menuid" value="<?php echo e($menuid); ?>">
                <?php
                      $add = "no";
                      $update = "no";
                      $delete = "no";
                    ?>
                    <?php $__currentLoopData = \Auth::user()->groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usergroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
                      <?php $__currentLoopData = $usergroup->group->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
                         <?php if($permission['menu_id'] == $menuid ): ?>
                           <?php if($permission['add'] == 1 ): ?>
                             <?php $add = "yes";?>
                           <?php endif; ?>

                           <?php if($permission['delete'] == 1 ): ?>
                             <?php $delete = "yes";?>
                           <?php endif; ?>

                           <?php if($permission['update'] == 1 ): ?>
                             <?php $update = "yes";?>
                           <?php endif; ?>

                          <?php endif; ?>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                      <th class="text-center"> Company </th>
                      <th class="text-center"> Company Revenue</th> 
                      <th class="text-center"> Paid Status</th> 
                      <th class="text-center"> options</th> 
                    </tr>
                   </thead>
                   <tbody>
                    <?php $i = 1; ?>
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
                      <td class="text-center"><?php if(isset($cat->company_name)): ?><?php echo e($cat->company_name); ?><?php endif; ?></td>
                      <td class="text-center"><?php echo e($cat->total_money); ?></td>
                      <td class="text-center"><?php if($cat->paid== 1): ?> Paid  <?php else: ?> Not Paid <?php endif; ?> </td>
                  
                      <td class="text-center">  
                      <?php if($update == "yes"): ?>
                      <a href="<?php echo e(route('timetable.edit',['timetable' => $cat['id'] , 'menuid' => $menuid ] )); ?>" class="label label-warning"><?php echo app('translator')->getFromJson('home.edit'); ?> <i class="fa fa-edit"></i></a>
                      <?php endif; ?>
                      <?php if($delete == "yes"): ?>
                      <a href="<?php echo e(route('timetable.destory',['timetable' => $cat['id'] , 'menuid' => $menuid ] )); ?>" class="label label-danger"><?php echo app('translator')->getFromJson('home.delete'); ?> <i class="fa fa-times"></i></a>
                      <?php endif; ?>
                       </td>      </tr>
                      
             
                    <?php $i = $i + 1; ?>
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
                    <th class="text-center"> Operation Status </th>
                      <th class="text-center"> Company </th>
                      <th class="text-center"> Company Revenue</th> 
                      <th class="text-center"> Paid Status</th> 
                      <th class="text-center"> options</th> 
                     
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