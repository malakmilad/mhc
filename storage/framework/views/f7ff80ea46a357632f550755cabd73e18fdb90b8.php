<?php $__env->startSection('pagetitle'); ?> <?php echo app('translator')->getFromJson('home.vehicle'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
 <section class="content-header text-right">
    <h1>
      <?php echo app('translator')->getFromJson('home.vehicle'); ?>
      <small><?php echo app('translator')->getFromJson('home.edit'); ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>  <?php echo app('translator')->getFromJson('home.control'); ?> </a></li>
      <li class="active"> <?php echo app('translator')->getFromJson('home.edit'); ?></li>
    </ol>
 </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
<section class="content">
 <!-- <div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-edit"></i>
              <h3 class="box-title"> <?php echo app('translator')->getFromJson('home.edit'); ?></h3>
          
              <div class="pull-left box-tools">-->
 <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  <?php echo app('translator')->getFromJson('home.edit'); ?></h5>
                <div class="card-tools">
      
                <a href="<?php echo e(route('menu.index',$menuid)); ?>" class="btn btn-info btn-sm">  <?php echo app('translator')->getFromJson('home.back'); ?> <i class="fa fa-arrow-circle-left"></i></a>
              </div><!-- /. tools -->
            </div>
            <div class="box-body">
            <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger text-center">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <P><?php echo e($error); ?></P>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div></div>
                    <?php endif; ?>
              <form action="<?php echo e(route('vehicle.update',$vehicle['id'])); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="menuid" value="<?php echo e($menuid); ?>">
                <div class="form-group">
                   <lable>  <?php echo app('translator')->getFromJson('home.name'); ?> </lable> <span style="color: red;">*</span>
                  <input type="text" class="form-control" name="name" value="<?php echo e($vehicle->name); ?>" required placeholder="<?php echo app('translator')->getFromJson('home.name'); ?>">
                </div>

             

            </div>
            <div class="box-footer clearfix">
              <button class="pull-left btn btn-default"><?php echo app('translator')->getFromJson('home.save'); ?> <i class="fa fa-plus"></i></button>
            </div>
        </div>
      </form>
     </div>
  </div>
 </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>