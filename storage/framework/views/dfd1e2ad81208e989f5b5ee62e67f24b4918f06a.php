<?php $__env->startSection('pagetitle'); ?> <?php echo app('translator')->getFromJson('home.task'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
 <section class="content-header text-right">
    <h1>
      <?php echo app('translator')->getFromJson('home.task'); ?>
      <small><?php echo app('translator')->getFromJson('home.edit'); ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>  <?php echo app('translator')->getFromJson('home.edit'); ?> </a></li>
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
              <h3 class="box-title"> <?php echo app('translator')->getFromJson('home.edit'); ?></h3>    <div class="pull-left box-tools">-->
       <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  <?php echo app('translator')->getFromJson('home.edit'); ?></h5>
                <div class="card-tools">
              <!-- tools box -->
          
                <a href="<?php echo e(route('timetable.index',$menuid)); ?>" class="btn btn-info btn-sm"><?php echo app('translator')->getFromJson('home.back'); ?> <i class="fa fa-arrow-circle-left"></i></a>
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
              <form action="<?php echo e(route('timetable.update',$timetable['id'])); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="menuid" value="<?php echo e($menuid); ?>">
                 <div class="form-group">
                 <lable>   Client Name </lable> <span style="color: red;">*</span>
                  <select class="form-control" name="sheet_id">
                     <option value=""> Select Client Name</option>
                     <?php $__currentLoopData = $allcustomers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cust): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($timetable->sheet_id == $cust['id']): ?>
                       <?php $selected = "selected";?>
                      <?php else: ?>
                       <?php $selected = "";?>
                      <?php endif; ?>
                      <option <?php echo e($selected); ?> value="<?php echo e($cust->id); ?>"><?php echo e($cust->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>

                <div class="form-group">
                  <lable> <?php echo app('translator')->getFromJson('home.operation_date'); ?></lable>
                  <input type="date" class="form-control" name="dydate" value="<?php echo e(date('Y-m-d' , strtotime($timetable['dydate']))); ?>" placeholder="ادخل تاريخ الانشاء">
                </div>

            <div class="form-group">
                  <label>  Operation number </label>
                    <input type="text"  class="form-control" required name="name" value="<?php echo e($timetable['name']); ?>" placeholder=" <?php echo app('translator')->getFromJson('home.name'); ?>"/>
                </div>

                <div class="form-group">
                  <lable>   Operation reservation time </lable>
                  <input type="time" class="form-control" name="time" value="<?php echo e($timetable['time']); ?>" placeholder="ادخل الوقت">
                </div>

              <div class="form-group">
                    <select  class="form-control" name="from_area">
                      <label>From (Cities) </label>
                      <option value="">From (Cities)</option>
                      <?php $__currentLoopData = $fromareas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fromarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <?php if($timetable->from_area == $fromarea['id']): ?>
                       <?php $selected = "selected";?>
                      <?php else: ?>
                       <?php $selected = "";?>
                      <?php endif; ?>
                       <option <?php echo e($selected); ?> value="<?php echo e($fromarea->id); ?>"><?php if(isset($fromarea->Gov['name']  )): ?><?php echo e($fromarea->Gov['name']); ?><?php endif; ?>/<?php echo e($fromarea->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <select  class="form-control" name="to_area">
                      <label>From (Cities) </label>
                      <option value="">To (Cities)</option>
                      <?php $__currentLoopData = $toareas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $toarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <?php if($timetable->to_area == $toarea['id']): ?>
                       <?php $selected = "selected";?>
                      <?php else: ?>
                       <?php $selected = "";?>
                      <?php endif; ?>
                      <option <?php echo e($selected); ?>

                       value="<?php echo e($toarea->id); ?>"><?php if(isset( $toarea->Gov['name'])): ?><?php echo e($toarea->Gov['name']); ?><?php endif; ?>/<?php echo e($toarea->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                <div class="form-group">
                  <select  class="form-control" name="vehicle_id[]">
                     <label>Select Vehicle </label>
                     <option value="">Vehicle</option>
                    <?php $__currentLoopData = $allvehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($vehicle1[0]->vehicle_id == $vehicle['id']): ?>
                       <?php $selected = "selected";?>
                      <?php else: ?>
                       <?php $selected = "";?>
                      <?php endif; ?>
                     
                    <option <?php echo e($selected); ?>

                       value="<?php echo e($vehicle->id); ?>"><?php echo e($vehicle->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>

                <div class="form-group">
                  <lable>  <?php echo app('translator')->getFromJson('home.notes'); ?> </lable>
                  <textarea class="form-control" name="note" placeholder=" <?php echo app('translator')->getFromJson('home.notes'); ?>"><?php echo e($timetable['note']); ?></textarea>
                </div>

                <div class="form-group">
                   <lable><?php echo app('translator')->getFromJson('home.operation_type'); ?> </lable><span style="color: red;">*</span>
                  <select  class="form-control" name="tasktype">
                      <?php $__currentLoopData = $alltypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($type->id==$timetable['taskType']): ?>
                       <option value="<?php echo e($type->id); ?>" selected><?php echo e($type->name); ?></option>

                      <?php else: ?>
                     <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                     <?php endif; ?>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                
                <div class="form-group">
                   <lable>  <?php echo app('translator')->getFromJson('home.employee'); ?>  </lable><span style="color: red;">*</span>
                  <select  class="form-control" name="employee">
                      <?php $__currentLoopData = $allusers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <?php if($user->id==$timetable['employee']): ?>
                       <option value="<?php echo e($user->id); ?>" selected><?php echo e($user->name); ?></option>

                      <?php else: ?>
                     <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                     <?php endif; ?>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>

                <div class="form-group">
                   <lable>  <?php echo app('translator')->getFromJson('home.operation_status'); ?> </lable><span style="color: red;">*</span>
                  <select  class="form-control" name="meetingstate">
                      <?php $__currentLoopData = $allstatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <?php if($status->id==$timetable['meetingstate']): ?>
                       <option value="<?php echo e($status->id); ?>" selected><?php echo e($status->name); ?></option>

                      <?php else: ?>
                     <option value="<?php echo e($status->id); ?>"><?php echo e($status->name); ?></option>
                     <?php endif; ?>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                                <div class="form-group">
                  <lable> <?php echo app('translator')->getFromJson('home.total_money'); ?> </lable> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="total_money"  min="0" value="<?php echo e($timetable['total_money']); ?>" onblur="getRemain()">
                </div>
                
                 <div class="form-group">
                  <lable> <?php echo app('translator')->getFromJson('home.paid'); ?> </lable> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="paid"  min="0" value="<?php echo e($timetable['paid']); ?>" onblur="getRemain()">
                 </div>
                 
                  <div class="form-group">
                  <lable> <?php echo app('translator')->getFromJson('home.remaining'); ?> </lable> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="remaining"  min="0" value="<?php echo e($timetable['total_money']-$timetable['paid']); ?>" readonly>
                 </div>
                 
                  <div class="form-group">
                  <lable> <?php echo app('translator')->getFromJson('home.desrved_date'); ?> </lable> <span style="color: red;"></span>
                  <input type="date" class="form-control"  name="desrved_date" value="<?php echo e($timetable['desrved_date']); ?>">
                 </div>
            <div class="box-footer clearfix">
              <button class="pull-left btn btn-default"><?php echo app('translator')->getFromJson('home.save'); ?> <i class="fa fa-plus"></i></button>
            </div>
        </div>
      </form>
     </div>
  </div>
 </section>
  <script type="text/javascript">
   function cancelmeeting(i) {
     if(i == 2){
      $('#cancelreasons').slideDown();
     }else{
      $('#cancelreasons').slideUp();
      $('#cancelreasonsfield').val("");
     }
   }
    function getRemain(){
       var total=$("input[name=total_money]").val();
       var paid=$("input[name=paid]").val();
       var remain=total-paid;
       $("input[name=remaining]").val(remain);
   }
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>