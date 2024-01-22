<?php $__env->startSection('pagetitle'); ?> Banks <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
 <section class="content-header">
	  <h1>
      Banks
     </h1>
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
                <h5 class="card-title"> Banks</h5>
                <div class="card-tools">
      
                    <div class="input-menu" >
                      <?php
                      $add = "no";
                      $update = "no";
                      $delete = "no";
                    ?>
                    <?php $__currentLoopData = \Auth::user()->groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usergroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   <!-- user Groups -->
                      <?php $__currentLoopData = $usergroup->group->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   <!-- group permissions -->
                         <?php if($permission['id'] == $id ): ?>
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
                    
                    <a href="<?php echo e(route('var_assets.add',['menuid' =>$id ])); ?>"> Add Cash</a>
                        <a href="<?php echo e(route('var_assets.addbank',['menuid' =>$id ])); ?>">  Add Bank</a>
                         
</div></div></div>                          <div class="form-top">بحث</div>
<form action="<?php echo e(route('var_assets.search',['id'=>$id])); ?>" method="post" class="form-out">
    <?php echo e(csrf_field()); ?>

    <div class="form-group from date">
        <label  class="date-lb">من تاريخ</label>
        <?php if(isset($date_from)): ?>
            <input type="date" name="date_from" value="<?php echo e($date_from); ?>" required>
        <?php else: ?>
            <input type="date" name="date_from"  required class="date-input clr">
        <?php endif; ?>
    </div>
    <div class=" form-group date">
        <label  class="date-lb">الي تاريخ </label>
        <?php if(isset($date_to)): ?>
            <input type="date" name="date_to" value="<?php echo e($date_to); ?>" required>
        <?php else: ?>
            <input type="date" name="date_to"  required class="date-input clr">
        <?php endif; ?>
    </div>
    <div class="">
        <button  class="btn-search" >
            <i class="fa fa-search"></i>
            <input type="submit" value="بحث"  class="in-style">
        </button>
    </div>
</form>
    

            
<div class="row">
    <div class="col-md-6">
        <label>أجمالي المدين : <?php echo e($total_debit); ?></label>
    </div>
   
</div>
 <br>

<table class="display table-bordered" style="width:100%">
 <thead>
   <tr>
   <th class="text-center">الرقم التسلسلي</th>
   <th class="text-center">الاسم</th>

   <th class="text-center">النوع</th>
   <th class="text-center">الأجمالي</th>
   <th class="text-center">التاريخ</th>
   <th class="text-center">عمليات</th>
   </tr>
 </thead>
 <tbody id="tbody">
   <?php $__currentLoopData = $varAssets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <tr>
        <td class="text-center"><a href="<?php echo e(route('var_assets.show',[$item->id ,$id])); ?>"><?php echo e($item->id); ?></a></td>
        <td class="text-center"><?php echo e($item->name); ?></td>
        <td class="text-center"><?php echo e($item->type); ?></td>
        <td class="text-center"><?php echo e($item->sum); ?></td>
        <td class="text-center"><?php echo e(date("Y-m-d",strtotime($item->created_at))); ?></td>

        <td>
         

<?php if($permission['update'] == 1 ): ?>
                           
        <a href="<?php echo e(route('var_assets.edit',['var_asset_id' =>$item->id,'menuid'=>$id ])); ?>">تعديل</a
        >
    <?php endif; ?>
    <?php if($permission['delete'] == 1 ): ?>
                         
     <a href="<?php echo e(route('var_assets.destory',['var_asset_id' =>$item->id,'menuid'=>$id ])); ?>" onclick="return confirm('هل أنت متأكد')">مسح</a>
    <?php endif; ?>

     </td>

    </tr>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
 </tbody>
</table>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>