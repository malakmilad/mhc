<?php $__env->startSection('pagetitle'); ?> Payment Receipt <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
<section class="content-header">
	  <h1>
    Payment Receipt
 </h1>
	   <a href="<?php echo e(route('home')); ?>"  class="btn btn-info btn-sm"><?php echo app('translator')->getFromJson('home.control'); ?> <i class="fa fa-arrow-circle-left"></i></a>

 </section>
 <?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
<div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  Payment Receipt</h5>
                <div class="card-tools">
                  
   
                   <?php $__currentLoopData = \Auth::user()->groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usergroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   <!-- user Groups -->
    <?php $__currentLoopData = $usergroup->group->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   <!-- group permissions -->
       <?php if($permission['menu_id'] == $id ): ?>
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
  <?php if($add == "yes"): ?>

        <a href="<?php echo e(route('giving_permission.add',['menuid' =>$id ])); ?>" class="pull-right action add"> <i class="fa fa-plus"></i>
           
          Add Payment Receipt   
        </a>

    <?php endif; ?>          
</div>
</div>
</div>    
     <div class="form-top">Search</div>
   
     <form action="<?php echo e(route('giving_permission.search',['id'=>$id])); ?>" method="post" class="form-out">
         <?php echo e(csrf_field()); ?>

         <div class="row">
                   <div class="col-3">    
                       <div class="form-group pull-left" style="margin-left: 5px;">
                        <label class="date-lb"> From Date</label>
                        <?php if(isset($date_from)): ?>
                        <input type="date" name="date_from" value="<?php echo e($date_from); ?>" required>
                        <?php else: ?>
                        <input type="date" name="date_from"  required class="date-input clr">
                        <?php endif; ?>
                    </div>
                  </div>
                    <div class="col-3">    
                       <div class="form-group pull-left" style="margin-left: 5px;">
                  
                      <label class="date-lb"> To Date </label>
                        <?php if(isset($date_to)): ?>
                      <input type="date" name="date_to" value="<?php echo e($date_to); ?>" required>
                      <?php else: ?>
                      <input type="date" name="date_to"  required class="date-input clr">
                      <?php endif; ?>
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
     <br><br>
               


<div class="machine">
<table class="table table-condensed table-striped " id="info-table">
 <thead>
   <tr class="table-row">
      <th class="cell-head"> Serial No</th>
      <th class="cell-head">Name</th>
      <th class="cell-head">Money</th>
      
      <th class="cell-head">Notes</th>
      <th class="cell-head">Date </th>
      <th class="cell-head">Operations</th>
   </tr>
 </thead>
 <tbody id="tbody">
    <?php 
  ?>
    <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    
       <tr class="table-row">
          <td class="cell-row"><?php echo e($item->id); ?></td>
          <td class="cell-row"><?php echo e($item->name); ?></td>
          <td class="cell-row"><?php echo e($item->money); ?></td>
          <td class="cell-row"><?php echo e($item->VarAsset->name); ?></td>
          <td class="cell-row"><?php echo e($item->notes); ?></td>
        <td class="cell-row"><?php echo e(date("Y-m-d",strtotime($item->created_at))); ?></td>
       
        <td class="cell-row">
        <?php if($update == "yes"): ?>
     
            <a href="<?php echo e(route('giving_permission.edit',['giving_permissionid' =>$item->id,'menuid' =>$id ])); ?>" class="edit"><i class="fa fa-edit"></i></a> 
      
        <?php endif; ?>
       <?php if($delete == "yes"): ?>
    
         <a href="<?php echo e(route('giving_permission.destory',['giving_permissionid' =>$item->id,'menuid'=>$id ])); ?>" onclick="return confirm('هل أنت متأكد')" class="edit">
         <i class="fa fa-times"></i></a>
     
        <?php endif; ?>
    </td>

       </tr>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 </tbody>
</table>
</div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
 </section><!-- /.content -->
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>