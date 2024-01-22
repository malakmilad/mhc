<?php $__env->startSection('pagetitle'); ?> <?php echo app('translator')->getFromJson('home.user'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
 <section class="content-header text-right">
    <h1>
      <?php echo app('translator')->getFromJson('home.user'); ?>
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
  <!--<div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-plus"></i>
              <h3 class="box-title"> <?php echo app('translator')->getFromJson('home.add_new'); ?></h3>-->
       <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title"> <?php echo app('translator')->getFromJson('home.add_new'); ?></h5>
                <div class="card-tools">
      
              <!-- tools box -->
              <div class="pull-left box-tools">
                <a href="<?php echo e(route('user.index',$menuid)); ?>" class="btn btn-info btn-sm"><?php echo app('translator')->getFromJson('home.back'); ?> <i class="fa fa-arrow-circle-left"></i></a>
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
              <form action="<?php echo e(route('user.store')); ?>" method="post" method="post" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="menuid" value="<?php echo e($menuid); ?>">
                <div class="form-group">
                  <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" placeholder="<?php echo app('translator')->getFromJson('home.name'); ?>">
                </div>

                <div class="form-group">
                  <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo app('translator')->getFromJson('home.email'); ?>">
                </div>

                <div class="form-group">
                  <input value="<?php echo e(old('password')); ?>" type="text" class="form-control" name="password" placeholder="<?php echo app('translator')->getFromJson('home.password'); ?>">
                </div>

                <div class="form-group">
                  <input type="file" class="form-control" name="logo">
                </div>
                  <div class="form-group">
                  <select class="form-control"  name="manager">
                    <option value=0><?php echo app('translator')->getFromJson('home.manager'); ?></option>
                    <?php $__currentLoopData = $allusers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user['id']); ?>"><?php echo e($user['name']); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                <div class="form-group">
                  <select class="form-control" multiple name="type[]">
                    <option value=""><?php echo app('translator')->getFromJson('home.group'); ?></option>
                    <?php $__currentLoopData = $allgroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($group['id']); ?>"><?php echo e($group['name']); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>

            </div>
            <div class="box-footer clearfix">
              <button class="pull-left btn btn-default"><?php echo app('translator')->getFromJson('home.save'); ?> <i class="fa fa-plus"></i></button>
            </div>
        </div>
      </form>
     </div>
  </div>
</div>
 </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>