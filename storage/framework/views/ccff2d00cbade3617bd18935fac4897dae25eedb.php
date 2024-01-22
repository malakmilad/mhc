<?php $__env->startSection('pagetitle'); ?> <?php echo app('translator')->getFromJson('home.client_type'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
 <section class="content-header text-right">
    <h1>
      <?php echo app('translator')->getFromJson('home.client_type'); ?>
      <small><?php echo app('translator')->getFromJson('home.add_new'); ?></small>
    </h1>
    <ol class="breadcrumb">
     <!--    <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> <?php echo app('translator')->getFromJson('home.control'); ?> </a></li>-->
    <a href="<?php echo e(route('home')); ?>"  class="btn btn-info btn-sm"><?php echo app('translator')->getFromJson('home.control'); ?> <i class="fa fa-arrow-circle-left"></i></a>

    <!--  <li class="active"><?php echo app('translator')->getFromJson('home.add_new'); ?></li>-->
   </ol>
 </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
<section class="content">
 <!-- <div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-plus"></i>
              <h3 class="box-title"><?php echo app('translator')->getFromJson('home.add_new'); ?></h3>
              
              <div class="pull-left box-tools">-->
                 <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  <?php echo app('translator')->getFromJson('home.add_new'); ?></h5>
                <div class="card-tools">
                <a href="<?php echo e(route('customer.index',$menuid)); ?>" class="btn btn-info btn-sm"><?php echo app('translator')->getFromJson('home.back'); ?>   <i class="fa fa-arrow-circle-left"></i></a>
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
              <form action="<?php echo e(route('customer.store')); ?>" method="post">
              <input type="hidden" name="menuid" value="<?php echo e($menuid); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                  <lable> <?php echo app('translator')->getFromJson('home.name'); ?> </lable> <span style="color: red;">*</span>
                  <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" required placeholder=" <?php echo app('translator')->getFromJson('home.name'); ?> ">
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