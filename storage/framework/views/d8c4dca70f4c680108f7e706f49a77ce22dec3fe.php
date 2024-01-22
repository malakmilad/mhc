<?php $__env->startSection('pagetitle'); ?> <?php echo app('translator')->getFromJson('home.Answers'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
 <section class="content-header">
	  <h1>
	    Answers
	    <small>	Answers Desc </small>
	  </h1>
	  <!-- <ol class="breadcrumb">
	    <li><a href="#"><i class="fa fa-dashboard"></i><?php echo app('translator')->getFromJson('home.control'); ?> </a>
      </li>
	    <li class="active"><?php echo app('translator')->getFromJson('home.Answers'); ?></li>
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
                  <h3 class="box-title"> <?php echo app('translator')->getFromJson('home.Answers'); ?></h3>
                  <div class="box-tools">-->
      <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  Answers</h5>
                <div class="card-tools">
 
                    <div class="input-menu" >
                      <?php
                      $add = "no";
                      $update = "no";
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
                    
               <!--     <a href="<?php echo e(route('question.create',$menuid)); ?>" class="pull-right action add"> <i class="fa fa-plus"></i> Add </a>-->
                    <?php endif; ?>  

                    </div>
                </div>
                <form action="<?php echo e(route('answer.answersearch')); ?>" id="searchrame" method="post" style=" margin-top: 20px; ">
                    <?php echo e(csrf_field()); ?>

                <input type="hidden" name="menuid" value="<?php echo e($menuid); ?>">
                <div class="row">
                 <div class="col-6"> 
                 <div class="form-group pull-left" style="margin-left: 5px;">
                     <label> <?php echo app('translator')->getFromJson('home.employee'); ?> </label>
                   <select name="customer_id" class="col-sm-12 form-control">
                     <option value=""><?php echo app('translator')->getFromJson('home.employee'); ?></option>
                     <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                   </select>
                 </div>
                  </div>
                 <div class="col-6"> 
                 <div class="form-group pull-left" style="margin-left: 5px;">
                       <label> Questions </label>
                      <select name="question_id" class="col-sm-12 form-control">
                        <option value="">Questions</option>
                        <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($question->id); ?>"><?php echo e($question->question); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                 </div>
                  </div>
                </div>
              <div class="row">
                <div class="col-2">  
                 <div class="form-group pull-left " style="margin-left: 5px">
                   <input type="submit" value="<?php echo app('translator')->getFromJson('home.search'); ?>" class="col-sm-12 form-control btn btn-success">
                 </div>
                </div>
              </div>
                </div>
                </form>

                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive">

                  <table class="display table-bordered" style="width:100%">
                      <thead>
                   <?php if($allAnswers->count() > 0): ?>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center"> Customer</th>
                      <th class="text-center">Operation</th>
                      <th class="text-center">Question</th>
                      <th class="text-center">Answer</th>
                    <!--  <th class="text-center"> Created_at</th>-->
                      <th class="text-center">Options</th>
                    </tr>
                    <?php $i= 1;?>
                    </thead>
                    <tbody>
                  <?php $__currentLoopData = $allAnswers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $act): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td class="text-center"><?php echo e($i); ?></td>
                      <td class="text-center"><?php echo e($act->customer['name']); ?></td>
                      <td class="text-center"><?php echo e($act->operation['name']); ?></td>
                      <td class="text-center"><?php if(isset($act->questions)): ?><?php echo e($act->questions['question']); ?><?php endif; ?></td>
                      <td class="text-center"><?php if($act->questions['question_type']=="True/False Question" && $act['answer']== 0): ?>False <?php elseif($act->questions['question_type']=="True/False Question" && $act['answer']== 1): ?> True <?php else: ?> <?php echo e($act['answer']); ?> <?php endif; ?></td> </td>
                      <td class="text-center"><?php echo e($act['active']); ?></td  >
                      <!--  <td class="text-center"><?php echo e(date('d/m/Y',strtotime($act['created_at']))); ?></td>-->
                      <td class="text-center">
                  
                      <?php if($delete == "yes"): ?>
                        <a href="<?php echo e(route('answer.destory',['answer' => $act['id'] , 'menuid' => $menuid ] )); ?>" class="action delete"> <i class="fa fa-times"></i> </a>
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