<?php $__env->startSection('pagetitle'); ?><?php echo app('translator')->getFromJson('home.govs_areas'); ?> 
<?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
 <section class="content-header text-right">
    <h1>
      <?php echo app('translator')->getFromJson('home.govs_areas'); ?> 

      <small><?php echo app('translator')->getFromJson('home.edit_govs_areas'); ?> 
      </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>  <?php echo app('translator')->getFromJson('home.control'); ?>  </a></li>
      <li class="active"> <?php echo app('translator')->getFromJson('home.edit_govs_areas'); ?> </li>
    </ol>
 </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
<section class="content">
  <div class="row">
   <!--  <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-edit"></i>
              <h3 class="box-title"> <?php echo app('translator')->getFromJson('home.edit_govs_areas'); ?></h3>
              <div class="pull-left box-tools">-->
     <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  <?php echo app('translator')->getFromJson('home.edit_govs_areas'); ?></h5>
                <div class="card-tools">
  
                <a href="<?php echo e(route('area.index',$menuid)); ?>" class="btn btn-info btn-sm"> <?php echo app('translator')->getFromJson('home.back'); ?> <i class="fa fa-arrow-circle-left"></i></a>
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
              <form action="<?php echo e(route('area.update',$area['id'])); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="menuid" value="<?php echo e($menuid); ?>">
                   <div class="form-group">
      <label><?php echo app('translator')->getFromJson('home.english_name'); ?></label>
      <input type="text" name="name" class="form-control" value="<?php echo e($area->name); ?>" required>
    </div>
            <div class="form-group">
              <label> <?php echo app('translator')->getFromJson('home.arabic_name'); ?></label>
              <input type="text" name="arabicName" value="<?php echo e($area->arabicName); ?>" class="form-control" required>
            </div>
            <input type="hidden" name="id" value="<?php echo e($area->id); ?>">
                <div class="form-group">
                         <label><?php echo app('translator')->getFromJson('home.gov'); ?></label>
        
              <select name="parentid" class="form-control">
                  <option value="0"><?php echo app('translator')->getFromJson('home.gov'); ?></option>
                  <?php $__currentLoopData = $govs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <?php if($gov->id==$area->parentid): ?>
                    <?php if(Session::has("locale") && Session::get("locale")=="ar"): ?>

                   <option value="<?php echo e($gov->id); ?>" selected><?php echo e($gov->arabicName); ?></option>
                    <?php else: ?>
                    <option value="<?php echo e($gov->id); ?>" selected><?php echo e($gov->name); ?></option>

                    <?php endif; ?>
                  <?php else: ?>
                  <?php if(Session::has("locale") && Session::get("locale")=="ar"): ?>

                  <option value="<?php echo e($gov->id); ?>"><?php echo e($gov->arabicName); ?></option>
                  <?php else: ?>
                  <option value="<?php echo e($gov->id); ?>"><?php echo e($gov->name); ?></option>

                  <?php endif; ?>
                  <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
            </div>

             

            </div>
            <div class="box-footer clearfix">
              <button class="pull-left btn btn-default"><?php echo app('translator')->getFromJson('home.save'); ?><i class="fa fa-plus"></i></button>
            </div>
        </div>
      </form>
     </div>
  </div>
 </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>