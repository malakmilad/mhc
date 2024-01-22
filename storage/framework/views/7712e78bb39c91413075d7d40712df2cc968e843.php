<?php $__env->startSection('pagetitle'); ?> <?php echo app('translator')->getFromJson('home.users'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
 <section class="content-header">
	  <h1>
	    <?php echo app('translator')->getFromJson('home.users'); ?>
	    <small><?php echo app('translator')->getFromJson('home.users_desc'); ?></small>
	  </h1>
	  <!-- <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i>  <?php echo app('translator')->getFromJson('home.control'); ?> </a></li>
	    <li class="active"><?php echo app('translator')->getFromJson('home.users'); ?></li>
	  </ol> -->
      <a href="<?php echo e(route('home')); ?>"  class="btn btn-info btn-sm"><?php echo app('translator')->getFromJson('home.control'); ?> <i class="fa fa-arrow-circle-left"></i></a>

 </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
 <section class="content">
  <!-- <div class="row">
     
            <div class="col-xs-12">
              <div class="box box-info">
                <div class="box-header">
                  <h3 class="box-title"> <?php echo app('translator')->getFromJson('home.users'); ?></h3>
                  <div class="box-tools">-->
       <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  <?php echo app('translator')->getFromJson('home.users'); ?></h5>
                <div class="card-tools">
                    <div class="input-menu">
                      <?php
                      $add = "no";
                      $update = "yes";
                      $delete = "no";
                    ?>
                    <?php $__currentLoopData = \Auth::user()->groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usergroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   <!-- user Groups -->
                      <?php $__currentLoopData = $usergroup->group->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   <!-- group permissions -->
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
                    <?php if($add == "yes"): ?>
                    <a href="<?php echo e(route('user.create',$menuid)); ?>" class="pull-right action add"> <i class="fas fa-plus"></i> Add </a>
                    <?php endif; ?>  
                      
                    </div>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive card-body">
                  <table class="display table-bordered  table-striped  table-hover table-sm " id="report" style="width:100%">
                   <thead class="thead-dark">
                   <?php if($allusers->count() > 0): ?>
                    <tr>
                      <th class="text-center"># </th>
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.name'); ?></th>
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.email'); ?></th>
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.group'); ?></th>
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.pic'); ?></th>
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.created_at'); ?></th>
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.options'); ?></th>
                    </tr>
                    <?php $i= 1;?>
                    </thead>
                    <tbody>
                  <?php $__currentLoopData = $allusers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="text-center"><?php echo e($i); ?></td>
                      <td class="text-center"><?php echo e($cat['name']); ?></td>
                      <td class="text-center"><?php echo e($cat['email']); ?></td>
                      <td class="text-center">
                        <?php $inde = 1;?>
                        <?php $__currentLoopData = $cat->groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php echo e($inde); ?> - <?php echo e($group->group['name']); ?>

                          <br>
                          <?php $inde = $inde + 1 ;?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </td>

                      <td class="text-center">
                        <?php if($cat['logo'] == NULL): ?>
                          <img style="width: 50px; height: 50px;" src="<?php echo e(asset('adminstyle/dist/img/user2-160x160.jpg')); ?>" class="img-circle" alt="User Image">
                        <?php else: ?>
                          <img style="width: 50px; height: 50px;" class="img-circle"  src="<?php echo e(asset('public/'.$cat->logo)); ?>" alt="User Image">
                        <?php endif; ?>
                      </td>
                      <td class="text-center"><?php echo e(date('H:i:s d/m/Y',strtotime($cat['created_at']))); ?></td>
                      <td class="text-center">
                          <?php if($update == "yes"): ?>
                          <a href="<?php echo e(route('user.edit',['user' => $cat['id'] , 'menuid' => $menuid ] )); ?>" class="action edit"><i class="far fa-edit"></i> </a>
                          <?php endif; ?>
                          <?php if($delete == "yes"): ?>
                          <a href="<?php echo e(route('user.destory',['user' => $cat['id'] , 'menuid' => $menuid ] )); ?>" class="action delete"> <i class="fas fa-times"></i> </a>
                          <?php endif; ?>
                      </td>
                    </tr>
                    <?php $i= $i + 1;?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <?php else: ?>
                  <h3 class="text-center" style="color: red;">
                    <br>
                    <br>
                    <br>
                    <?php echo app('translator')->getFromJson('home.empty_data'); ?>                    <br>
                    <br>
                    <br>
                  </h3>
                  <?php endif; ?>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
</div>

 </section><!-- /.content -->
 
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>