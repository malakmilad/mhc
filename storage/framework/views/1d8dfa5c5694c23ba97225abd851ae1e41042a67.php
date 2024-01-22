<?php $__env->startSection('pagetitle'); ?> <?php echo app('translator')->getFromJson('home.menus'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
 <section class="content-header text-right">
    <h1>
      <?php echo app('translator')->getFromJson('home.menus'); ?>
      <small><?php echo app('translator')->getFromJson('home.add_menu'); ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo e(route('home')); ?>"><i class="fa fa-dashboard"></i> <?php echo app('translator')->getFromJson('home.control'); ?> </a></li>
      <li class="active"> <?php echo app('translator')->getFromJson('home.add_menu'); ?></li>
    </ol>
 </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
<section class="content">
  <div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-plus"></i>
              <h3 class="box-title"><?php echo app('translator')->getFromJson('home.add_menu'); ?></h3>
              <!-- tools box -->
              <div class="pull-left box-tools">
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
              <form action="<?php echo e(route('menu.store')); ?>" method="post">
              <input type="hidden" name="menuid" value="<?php echo e($menuid); ?>">
                <?php echo e(csrf_field()); ?>

                <div class="form-group">
                  <lable>  <?php echo app('translator')->getFromJson('home.arabic_name'); ?> </lable> <span style="color: red;">*</span>
                <input type="text" class="form-control" name="name" value="<?php echo e(old('name')); ?>" placeholder="<?php echo app('translator')->getFromJson('home.arabic_name'); ?>">
                </div>

                <div class="form-group">
                  <lable> <?php echo app('translator')->getFromJson('home.english_name'); ?> </lable> <span style="color: red;">*</span>
                  <input type="text" class="form-control" name="name_en" value="<?php echo e(old('name_en')); ?>" placeholder="<?php echo app('translator')->getFromJson('home.english_name'); ?>">
                </div>

                <div class="form-group">
                  <lable> <?php echo app('translator')->getFromJson('home.icon'); ?> </lable> <span style="color: red;">*</span>
                <input type="text" class="form-control" name="icon" value="<?php echo e(old('icon')); ?>" placeholder="<?php echo app('translator')->getFromJson('home.icon'); ?>">
                </div>

                <div class="form-group">
                  <lable> <?php echo app('translator')->getFromJson('home.menu_url'); ?> </lable>
                <input type="text" class="form-control" name="url" value="<?php echo e(old('url')); ?>" placeholder="<?php echo app('translator')->getFromJson('home.menu_url'); ?>">
                </div>

                <div class="form-group"> 
                 <lable> <?php echo app('translator')->getFromJson('home.parent'); ?> </lable>
                  <select class="form-control" value="<?php echo e(old('name')); ?>" name="parent_id">
                    <option value=""><?php echo app('translator')->getFromJson('home.main_menu'); ?></option>
                    <?php $__currentLoopData = $allmenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $men): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php if(Session::has("locale") && Session::get("locale")=="ar"): ?>
                      <option value="<?php echo e($men['id']); ?>"><?php echo e($men['name']); ?></option> 
                     <?php else: ?> 
                     <option value="<?php echo e($men['id']); ?>"><?php echo e($men['name_en']); ?></option>
                     <?php endif; ?>
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
 </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>