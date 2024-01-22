<?php $__env->startSection('pagetitle'); ?> <?php echo app('translator')->getFromJson("home.clients"); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 

 <section class="content-header text-right">
	 <!-- <h1>
        <?php echo app('translator')->getFromJson("home.clients"); ?>
	    <small><?php echo app('translator')->getFromJson('home.clients_desc'); ?> </small>
	  </h1>-->
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
                  <h3 class="box-title"> <?php echo app('translator')->getFromJson('home.clients_menu'); ?></h3>
                  <div class="box-tools">-->
       <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  <?php echo app('translator')->getFromJson('home.clients_menu'); ?></h5>
                <div class="card-tools">
     
                    <div class="input-group" >

                     
                       <!--<a onclick="searchcvs()" style="font-size: 15px; font-weight: bold;margin-left: 5px;" class="btn btn-sm btn-info pull-right"><?php echo app('translator')->getFromJson('home.search'); ?> <i class="fa fa-search"></i></a>

                      <a href="<?php echo e(route('sheet.allsheets',$menuid)); ?>" style="font-size: 15px; font-weight: bold;margin-left: 5px;" class="btn btn-sm btn-success pull-right"> <?php echo app('translator')->getFromJson('home.all_clients'); ?> <i class="fa fa-users"></i></a>


                      <?php
                      $add = "no";
                      $update = "no";
                      $delete = "no";
                    ?>
                    <?php $__currentLoopData = \Auth::user()->groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usergroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
                      <?php $__currentLoopData = $usergroup->group->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   
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
                    <a href="<?php echo e(route('sheet.create',$menuid)); ?>" style="font-size: 15px; font-weight: bold;display: inline;" class="btn btn-sm btn-primary pull-right"> <?php echo app('translator')->getFromJson('home.add_new'); ?> <i class="fa fa-plus"></i></a>
                    <a href="<?php echo e(route('uploadsheet',$menuid)); ?>" style="font-size: 15px; font-weight: bold;display: inline;" class="btn btn-sm btn-primary pull-right"> <?php echo app('translator')->getFromJson('home.upload_file'); ?><i class="fa fa-plus"></i></a>
                    <?php endif; ?> --> 
                    <?php if($delete == "yes"): ?>
                    <div class="pull-right" style="margin-right: 10px;"> 
                    <input type="checkbox"  onClick="setAllCheckboxes('actors', this);" /> <?php echo app('translator')->getFromJson('home.select_all_delete'); ?> <br/>
                    </div>
                    <?php endif; ?> 

                    </div>
                  </div>
                </div><!-- /.box-header -->
                 <div class="card-body table-responsive no-padding">

                 <form action="<?php echo e(route('search.sheatsearch')); ?>" id="searchrame" method="post" style=" margin-top: 20px; ">
                <?php echo e(csrf_field()); ?>

                   <input type="hidden" name="menuid" value="<?php echo e($menuid); ?>">
               
                 
                <div class="row" style="margin-left: 5px;">
                  <div class="col-2">
                    <div class="form-group pull-left" style="margin-left: 5px;">
                    <label> <?php echo app('translator')->getFromJson('home.name'); ?> </label>
                      <input type="text" name="name" class="col-sm-12 form-control" placeholder="<?php echo app('translator')->getFromJson('home.name'); ?>">
                  
                    </div>
                 </div>
                <div class="col-2">
                <div class="form-group pull-left" style="margin-left: 5px;">
                  <label> <?php echo app('translator')->getFromJson('home.client_type'); ?> </label>
                  <select class="col-sm-12 form-control" name="isintrest">
                    <option value=""> <?php echo app('translator')->getFromJson('home.client_type'); ?></option>
                  <?php $__currentLoopData = $customerTypess; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                </div>
                <!--  <div class="col-2">

                <div class="form-group pull-left" style="margin-left: 5px;">
                   <label> <?php echo app('translator')->getFromJson('home.activity_type'); ?> </label>
                  
                   <select name="activitytype" class="form-control col-sm-12">
                                 <option value=""><?php echo app('translator')->getFromJson('home.activity_type'); ?></option>

                    <?php $__currentLoopData = $acivites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                      <option value="<?php echo e($activity->name); ?>"><?php echo e($activity->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                  </div>-->
                 <div class="col-2">
                    <div class="form-group pull-left" style="margin-left: 5px;">
                      <label><?php echo app('translator')->getFromJson('home.gov'); ?> </label>
                      <select name="govid" id="gov" onchange="chnage_gov()" class="form-control col-sm-12">
                      <option value=""> <?php echo app('translator')->getFromJson('home.gov'); ?></option>
                      <?php $__currentLoopData = $govs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($gov->id); ?>"><?php echo e($gov->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                      </div>
                 <div class="col-2">
                    <div class="form-group pull-left" style="margin-left: 5px;">
                      <label><?php echo app('translator')->getFromJson('home.area'); ?></label>
                      <select name="areaid" id="city" class="form-control col-sm-12">
                      <option value=""><?php echo app('translator')->getFromJson('home.area'); ?></option>
                      <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($city->id); ?>" parent="<?php echo e($city->parentid); ?>" style="display:none"><?php echo e($city->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                      </div>
              <!--   <div class="col-2">
                <div class="form-group pull-left" style="margin-left: 5px;">
                  <label> <?php echo app('translator')->getFromJson('home.services'); ?> </label>
                  <select  class="form-control col-sm-12" name="service_id">
                    
                     <option value=""><?php echo app('translator')->getFromJson('home.services'); ?></option>
                    <?php $__currentLoopData = $allservices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($service->id); ?>"><?php echo e($service->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              </div>
            </div>
  <div class="row" style="margin-left: 5px;">
                 <div class="col-2" style="margin-left: 5px;">
                     <div class="form-group pull-left" style="margin-left: 5px;">
                    <label> <?php echo app('translator')->getFromJson('home.email'); ?> </label>
               
                   <input type="email" name="email" class="col-sm-12 form-control" placeholder="<?php echo app('translator')->getFromJson('home.email'); ?>">
                 </div>
                 </div>
                  <div class="col-2" style="margin-left: 5px;">
                  
                 <div class="form-group pull-left" style="margin-left: 5px;">
                    <label> <?php echo app('translator')->getFromJson('home.phone'); ?> </label>
                   <input type="text" name="phone" class="col-sm-12 form-control" placeholder="<?php echo app('translator')->getFromJson('home.mobile'); ?>">
                 </div>
                </div>-->
                 
                  <div class="col-2" style="margin-left: 5px;">
                     <div class="form-group pull-left" style="margin-left: 5px;">
                      <label> <?php echo app('translator')->getFromJson('home.date'); ?> </label>
              
                   <input type="date" name="dynmicdate" class="col-sm-12 form-control" placeholder="">
                 </div>
                 </div>
               
               <!--  <?php if(\Auth::user()->type == 1): ?>
                    <div class="col-2">
                            <div class="form-group pull-left" style="margin-left: 5px;">
                            <label> <?php echo app('translator')->getFromJson('home.employee'); ?> </label>
           
                   <select name="user_id" class="col-sm-12 form-control">
                     <option value=""><?php echo app('translator')->getFromJson('home.employee'); ?></option>
                     <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                   </select>
                 </div>
                  </div>
                 <?php endif; ?>-->
                     <div class="col-2">    <div class="form-group pull-left" style="margin-left: 5px;">
                            <label> <?php echo app('translator')->getFromJson('home.datefrom'); ?> </label>
             
                   <input type="date" name="datefrom" class="col-sm-12 form-control" placeholder="">
                 </div>
                 </div>
                     <div class="col-2"><div class="form-group pull-left" style="margin-left: 5px;">
                            <label> <?php echo app('translator')->getFromJson('home.dateto'); ?> </label>
                 
                   <input type="date" name="dateto" class="col-sm-12 form-control" placeholder="">
                 </div>
                </div>
                </div>
                <div class="row">
                 <div class="form-group pull-left" style="margin-left: 5px">
                   <input type="submit" value="<?php echo app('translator')->getFromJson('home.search'); ?>" class="col-sm-12 form-control btn btn-success">
                 </div>
                 </div>
                </form>
                <br><br>
               <table class="table table-bordered table-hover table-striped" id="report">
                
                   <?php if($allsheets->count() > 0): ?>
                   <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.name'); ?></th>
                      <th class="text-center"> <?php echo app('translator')->getFromJson('home.client_type'); ?></th>
                      <th class="text-center"> Dynamic Date</th>
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.mobile'); ?></th>
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.employee'); ?></th>
                      <th class="text-center">Know Us</th>
                      <th class="text-center">Area (gov/city)  </th>
                      <th class="text-center">Operation</th>
                
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.options'); ?></th>
                    </tr>
                   </thead>  
                   <tbody> 
                    <?php $i= 1;?>
                  <?php $__currentLoopData = $allsheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   
                    <tr style="background-color: <?php echo e($cat['color']); ?>">
                      <td class="text-center"> <?php echo e($i); ?> </td>
                      <td class="text-center"> <?php echo e($cat['name']); ?> </td>
                        <td class="text-center"> <?php echo e($cat['customer_type']); ?> </td>
                      <td class="text-center"> <?php echo e($cat['dynmicdate']); ?> </td>
                      <td class="text-center">
                       <?php if($cat->phones->count() > 0): ?> 
                       <?php $__currentLoopData = $cat->phones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phonenumber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>.
                        <?php echo e($phonenumber['phone']); ?><br>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                       <?php else: ?>
                       <?php echo app('translator')->getFromJson('home.no_mobile'); ?>
                       <?php endif; ?>
                      </td>
                      <td class="text-center"><?php echo e($cat->userfun['name']); ?></td>
                      
                      <td class="text-center"><?php if(isset($cat->social)): ?><?php echo e($cat->social['name']); ?><?php endif; ?></td>

                      <td class="text-center"><?php if(isset($cat->area)): ?><?php echo e($cat->area['name']); ?><?php endif; ?></td>
                     <td><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="<?php echo '#task'.$i?>">Operations</button></td>
                
                      <td class="text-center">
                      <?php if($update == "yes"): ?>
                      <a href="<?php echo e(route('sheet.edit',['sheet' => $cat['id'] , 'menuid' => $menuid ] )); ?>" class="label label-warning"><?php echo app('translator')->getFromJson('home.edit'); ?> <i class="fa fa-edit"></i></a>
                      <?php endif; ?>
                      <?php if($delete == "yes"): ?>
                      <a href="<?php echo e(route('sheet.destory',['sheet' => $cat['id'] , 'menuid' => $menuid ] )); ?>" class="label label-danger"><?php echo app('translator')->getFromJson('home.delete'); ?> <i class="fa fa-times"></i></a>
                      <?php endif; ?>
                      </td>
                    </tr>
                   
                    <?php $i= $i + 1;?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.name'); ?></th>
                      <th class="text-center"> <?php echo app('translator')->getFromJson('home.client_type'); ?></th>
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.mobile'); ?></th>
                      <?php if(\Auth::user()->type == 1): ?>
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.employee'); ?></th>
                      <?php endif; ?>
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.created_at'); ?></th>
                      <th class="text-center"> <?php echo app('translator')->getFromJson('home.activity_type'); ?> </th>
                      <th class="text-center"> Operation</th>
                     <!-- <th class="text-center"><?php echo app('translator')->getFromJson('home.opportunity'); ?></th>
                      <?php if($delete == "yes"): ?>
                      <th class="text-center"> <?php echo app('translator')->getFromJson('home.select_to_delete'); ?></th>
                      <?php endif; ?>-->
                      <th class="text-center"><?php echo app('translator')->getFromJson('home.options'); ?></th>
                    </tr>
                  </tfoot>
                  <?php else: ?>
                  <h3 class="text-center" style="color: red;">
                    <br>
                    <br>
                    <br>
                        <?php echo app('translator')->getFromJson('home.clients_empty'); ?>
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

          

          <?php $i= 1;?>
          <?php $__currentLoopData = $allsheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <!-- Modal -->
<div id="<?php echo 'ops'.$i?>" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo app('translator')->getFromJson('home.opportunity'); ?></h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered table-hover " >
          <thead>
           <tr>
            <th class="text-center"> <?php echo app('translator')->getFromJson('home.serial'); ?></th>
            <th class="text-center"><?php echo app('translator')->getFromJson('home.name'); ?></th>
            <th class="text-center"><?php echo app('translator')->getFromJson('home.client'); ?></th>
            <th class="text-center"><?php echo app('translator')->getFromJson('home.price'); ?></th>
            <th class="text-center"> <?php echo app('translator')->getFromJson('home.expire_date'); ?></th>
            <th class="text-center"><?php echo app('translator')->getFromJson('home.stage'); ?></th>
            <th class="text-center"><?php echo app('translator')->getFromJson('home.probability'); ?></th>
            <th class="text-center"> <?php echo app('translator')->getFromJson('home.created_at'); ?></th>                      
           </tr>
          </thead>
          <tbody>
              <?php $__currentLoopData = $cat->allOpportunitys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opportunity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <tr>
              <td class="text-center"><?php echo e($opportunity['id']); ?></td>
              <td class="text-center"><?php echo e($opportunity['name']); ?></td>
              <td class="text-center"><?php echo e($opportunity['customer_name']); ?></td>
              <td class="text-center"><?php echo e($opportunity['price']); ?></td>
              <td class="text-center"><?php echo e($opportunity['dueDate']); ?></td>
              <td class="text-center"><?php echo e($opportunity['stage_name']); ?></td>
              <td class="text-center"><?php echo e($opportunity['prop']); ?></td>
              <td class="text-center"><?php echo e(date('d/m/Y',strtotime($opportunity['created_at']))); ?></td>
              </tr>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo app('translator')->getFromJson('home.close'); ?></button>
      </div>
    </div>

  </div>
</div>

          <div id="<?php echo 'task'.$i?>" class="modal fade" role="dialog">
            <div class="modal-dialog modal-xl ">
          
              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Operation</h4>
                </div>
                <div class="modal-body">
                  <div class="col-12">
                      <?php $__currentLoopData = \Auth::user()->groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usergroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   <!-- user Groups -->
                      <?php $__currentLoopData = $usergroup->group->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   <!-- group permissions -->
                         <?php if($permission['menu_id'] == $menuid ): ?>
                           <?php if($permission['add'] == 1 ): ?>
                             <?php $add = "yes";?>
                           <?php endif; ?>
                          <?php endif; ?>
                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php if($add == "yes"): ?>
                     
                    <a href="<?php echo e(route('timetable.create',$menuid  )); ?>" style="font-size: 15px; font-weight: bold;display: inline;" class="btn btn-sm btn-primary pull-left"> 
                      <?php echo app('translator')->getFromJson('home.add_new'); ?> <i class="fa fa-plus"></i></a>
                    <?php endif; ?>
                  </div>
                   <br>
                      <br>
                    
                <div class="col-12">
                  <table class="table table-bordered table-hover " >
                    <thead>
                     <tr>
                       <th> <?php echo app('translator')->getFromJson('home.serial'); ?></th>
                       <th> <?php echo app('translator')->getFromJson('home.client'); ?></th>
                       <th> Operation Date</th>
                       <th> <?php echo app('translator')->getFromJson('home.time'); ?></th>
                       <th> <?php echo app('translator')->getFromJson('home.employee'); ?></th>
                       <th> Operation Status</th>
                       <th> Operation Type</th>
                       <th> Operation Created By</th>
                      <!-- <th class="text-center"><?php echo app('translator')->getFromJson('home.refer_task'); ?></th>    -->                   
                     </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $cat->alltimetables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr style="background-color: <?php echo e($task['color']); ?>">
                            <td class="text-center"><?php echo e($task->id); ?></td>
                            <td class="text-center"><?php echo e($task->customer['name']); ?></td>
                            <td class="text-center"><?php echo e(date('d/m/Y',strtotime($task['created_at']))); ?></td>
      
                            <td class="text-center"><?php echo e($task->time); ?></td>
      
                            <td class="text-center"><?php echo e($task->employee_name); ?></td>
      
                            <td class="text-center"><?php echo e($task->status_name); ?></td>
                            <td class="text-center"><?php echo e($task->type_name); ?></td>
                            <td class="text-center"><?php echo e($task->user['name']); ?></td>
                        <!--    <td class="text-center"><?php echo e($task->timeid); ?></td>-->
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                 
                    </tbody>
                  </table>
                 </div> 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
             
               </div>
            </div>
          </div>
          <?php $i++?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

 </section><!-- /.content -->
  <script type="text/javascript">
    function searchcvs() {
      $('#searchrame').slideToggle();
    }
 </script>


 <script type="text/javascript">
   function setAllCheckboxes(divId, sourceCheckbox) {
    
    divElement = document.getElementById(divId);
    
    inputElements = divElement.getElementsByTagName('input');
    for (i = 0; i < inputElements.length; i++) {
        if (inputElements[i].type != 'checkbox')
            continue;
        inputElements[i].checked = sourceCheckbox.checked;
    }
}

 function chnage_gov(){
    var valueSelected = $('#gov').val();
    if(valueSelected !="")
    {
        $("#city").val("");

    $("[parent]").hide();
    $("[parent="+valueSelected+"]").show();
    }
    else
    {
          $("[parent]").show();

    }

}


 </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>