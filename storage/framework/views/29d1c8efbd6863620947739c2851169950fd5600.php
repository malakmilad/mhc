<?php $__env->startSection('pagetitle'); ?> <?php echo app('translator')->getFromJson('home.customer'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
 <section class="content-header text-right">
    <h1>
      <?php echo app('translator')->getFromJson('home.customer'); ?>
      <small> <?php echo app('translator')->getFromJson('home.edit'); ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>   <?php echo app('translator')->getFromJson('home.control'); ?> </a></li>
      <li class="active">  <?php echo app('translator')->getFromJson('home.edit'); ?></li>
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
              <h3 class="box-title">  <?php echo app('translator')->getFromJson('home.edit'); ?></h3>-->
        <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  <?php echo app('translator')->getFromJson('home.edit'); ?></h5>
                <div class="card-tools">
              <!-- tools box -->
              <div class="pull-left box-tools">
                <a href="<?php echo e(route('sheet.index',$menuid)); ?>" class="btn btn-info btn-sm"> <?php echo app('translator')->getFromJson('home.back'); ?> <i class="fa fa-arrow-circle-left"></i></a>
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
              <form action="<?php echo e(route('sheet.update',$sheet['id'])); ?>" method="post">
                <?php echo e(csrf_field()); ?>


                <?php if( \Auth::user()->type == 1 ): ?>
                <div class="form-group">
                   <lable>  <?php echo app('translator')->getFromJson('home.employee'); ?> </lable> <span style="color: red;">*</span>

                  <select name="user_id" class="form-control">
                    
                    <?php $__currentLoopData = $allusers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if( $userr['id']  == $sheet['user_id'] ): ?>
                    <?php $selected = "selected"; ?>
                    <?php else: ?>
                    <?php $selected = ""; ?>
                    <?php endif; ?>
                      <option <?php echo e($selected); ?> value="<?php echo e($userr['id']); ?>"><?php echo e($userr['name']); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                <?php elseif(\Auth::user()->type == 0): ?>
                <input type="hidden" name="user_id" value="<?php echo e(\Auth::user()->id); ?>">
               <?php endif; ?>

                <input type="hidden" name="menuid" value="<?php echo e($menuid); ?>">
                <div class="form-group">
                  <lable>    <?php echo app('translator')->getFromJson('home.name'); ?> </lable> <span style="color: red;">*</span>
                  <input type="text" class="form-control" name="name" value="<?php echo e($sheet->name); ?>" placeholder=" <?php echo app('translator')->getFromJson('home.name'); ?>">
                </div>

                <div class="form-group">
                  <lable>  <?php echo app('translator')->getFromJson('home.email'); ?> </lable>
                  <input type="email" class="form-control" name="email" value="<?php echo e($sheet->email); ?>" placeholder=" <?php echo app('translator')->getFromJson('home.email'); ?>">
                </div>

                <div class="form-group">
                  <lable>   Dynamic Date </lable>
                  <input type="date" value="<?php echo e(date('Y-m-d' , strtotime($sheet['created_at']))); ?>" class="form-control" name="dynmicdate">
                </div>

                <!--<div class="form-group">
                  <lable> ادخل تاريخ الترحيل </lable>
                  <input type="date" value="<?php echo e($sheet->dynmicdate); ?>" class="form-control" name="dynmicdate">
                </div>-->

               <!-- <div class="form-group">
                   <lable>   <?php echo app('translator')->getFromJson('home.activity'); ?>  </lable>
                  
                   <select name="activitytype" class="form-control">
                    
                    <?php $__currentLoopData = $acivites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($activity->name==$sheet->activitytype): ?>
                      <option value="<?php echo e($activity->name); ?>" selected><?php echo e($activity->name); ?></option>
                      <?php else: ?>
                      <option value="<?php echo e($activity->name); ?>"><?php echo e($activity->name); ?></option>
                      <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>-->

                <div class="form-group">
                    <lable>   <?php echo app('translator')->getFromJson('home.notes'); ?> </lable>
                  <textarea class="form-control" name="note" placeholder="  <?php echo app('translator')->getFromJson('home.notes'); ?>"><?php echo e($sheet->note); ?></textarea>
                </div>

                <!--<div class="form-group">
                  <lable> ادخل حالة المتابعة </lable>
                  <textarea class="form-control" name="followtype" placeholder="ادخل حالة المتابعة"><?php echo e($sheet->followtype); ?></textarea>
                </div>-->

               <!-- <div class="form-group"> <label> Disease </label>
                        <select multiple class="form-control" name="disease_id[]">
                          <option value="">Select Disease</option>
                          <?php $__currentLoopData = $alldiseases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disease): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($disease->id); ?>"><?php echo e($disease->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                </div>-->
                  <div class="form-group">
                  <lable>  <?php echo app('translator')->getFromJson('home.services'); ?> </lable>
                  <select multiple class="form-control" name="service_id[]">
                     <option value=""><?php echo app('translator')->getFromJson('home.services'); ?></option>
                     <?php $serviceids[] = 0;?>
                     <?php $__currentLoopData = $sheet->customerservice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cusse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                     <?php $serviceids[] = $cusse['service_id'];?>

                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $allservices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php if(in_array($service->id,$serviceids)): ?>
                      <?php $selected = "selected";?>
                     <?php else: ?>
                      <?php $selected = "";?>
                     <?php endif; ?>
                    <option <?php echo e($selected); ?> value="<?php echo e($service->id); ?>"><?php echo e($service->name); ?></option>
                      <?php $selected = "";?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>

                 <div class="form-group">
                  <lable>  Disease </lable>
                  <select multiple class="form-control" name="disease_id[]">
                     <option value="">Select Disease</option>
                     <?php $diseaseids[] = 0;?>
                     <?php $__currentLoopData = $sheet->diseaseservice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cusse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                     <?php $diseaseids[] = $cusse['disease_id'];?>

                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $alldiseases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disease): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <?php if(in_array($disease->id,$diseaseids)): ?>
                      <?php $selected = "selected";?>
                     <?php else: ?>
                      <?php $selected = "";?>
                     <?php endif; ?>
                    <option <?php echo e($selected); ?> value="<?php echo e($disease->id); ?>"><?php echo e($disease->name); ?></option>
                      <?php $selected = "";?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
              
                <div class="form-group">
                  <lable>  <?php echo app('translator')->getFromJson('home.client_type'); ?> </lable>
                <select class="form-control" name="isintrest">
                  <?php $__currentLoopData = $customerTypess; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($type->id==$sheet->isintrest): ?>
                    <option value="<?php echo e($type->id); ?>" selected><?php echo e($type->name); ?></option>
                    
                    <?php else: ?>
                     <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>

                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                </div>
                
                <div class="form-group">
                  <lable>  <?php echo app('translator')->getFromJson('home.know_from'); ?> </lable>
                <select class="form-control" name="socail">
                  <?php $__currentLoopData = $socails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($socail->id==$sheet->socailid): ?>

                    <option value="<?php echo e($socail->id); ?>" selected><?php echo e($socail->name); ?></option>
                    <?php else: ?>
                      
                    <option value="<?php echo e($socail->id); ?>"><?php echo e($socail->name); ?></option>
                    
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                </div>
                
                <div class="form-group">
                  <label><?php echo app('translator')->getFromJson('home.gov'); ?> </label>
                  <select name="govid" id="gov" required onchange="chnage_gov()" class="form-control">
                  <option value=""> <?php echo app('translator')->getFromJson('home.gov'); ?></option>
                  <?php $__currentLoopData = $govs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($gov->id==$mygov): ?>
                    <option value="<?php echo e($gov->id); ?>" selected><?php echo e($gov->name); ?></option>
                    <?php else: ?>
                      <option value="<?php echo e($gov->id); ?>" ><?php echo e($gov->name); ?></option>
            
                    <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                
                <div class="form-group">
                  <label><?php echo app('translator')->getFromJson('home.area'); ?></label>
                  <select name="areaid" id="city" required class="form-control">
                  <option value=""> <?php echo app('translator')->getFromJson('home.area'); ?></option>
                  <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($sheet->areaid==$city->id): ?>
                    <option value="<?php echo e($city->id); ?>" parent="<?php echo e($city->parentid); ?>" selected><?php echo e($city->name); ?></option>
                    <?php else: ?> 
                       <?php if($city->parentid==$mygov): ?>
                      <option value="<?php echo e($city->id); ?>" parent="<?php echo e($city->parentid); ?>" ><?php echo e($city->name); ?></option>
                      <?php else: ?>
                      <option value="<?php echo e($city->id); ?>" parent="<?php echo e($city->parentid); ?>" style="display:none"><?php echo e($city->name); ?></option>
            
                      <?php endif; ?>
            
                    <?php endif; ?>
                    
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                  <div class="form-group">
                      <label> <?php echo app('translator')->getFromJson('home.upload_file'); ?></label>
                      <a href="<?php echo e($sheet->file); ?>" width="800px" height="2100px" >  <?php echo app('translator')->getFromJson('home.client_file'); ?></a>

                      <input type="file" name="customerFile" class="form-control">
                    </div>

                <div class="form-group">
                  <input type="color" value="<?php echo e($sheet->color); ?>" class="form-control" name="color">
                </div>

                <div id="allphones">
                <?php $i = 1;?>
                <?php $__currentLoopData = $sheet->phones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="form-group" id="phoneframe<?php echo e($i); ?>">
                  <input type="text" class="form-control col-xs-5" value="<?php echo e($phone->phone); ?>" name="number<?php echo e($i); ?>" placeholder="ادخل رقم الهاتف">

                  <select id="phonetypeframe<?php echo e($i); ?>" class="form-control col-xs-5" style="margin-right: 5px;" name="phonetype<?php echo e($i); ?>">

                  <option value=""><?php echo app('translator')->getFromJson('home.phone_type'); ?></option>
                    <?php $__currentLoopData = $allphonetypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($phone->phonetype_id == $phtype->id): ?>
                      <?php $selected = "selected";?>
                      <?php else: ?>
                      <?php $selected = "";?>
                      <?php endif; ?>
                      <option <?php echo e($selected); ?> value="<?php echo e($phtype->id); ?>"><?php echo e($phtype->type); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>

                  <input onclick="deletephone(<?php echo e($i); ?>)" type="button" class="form-control col-xs-1 btn btn-danger pull-left" value="الغاء" >
                </div>
                <?php $i = $i+1;?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                
                </div>
                <br>
                <br>
                <div class="form-group col-xs-4">
                  <input onclick="addphone()" type="button" class="form-control btn btn-success" value="<?php echo app('translator')->getFromJson('home.add_new'); ?>">
                </div>

                <input type="hidden" name="itrator" id="itrator" value="<?php echo e($i); ?>">
            </div>
            <div class="box-footer clearfix">
              <input class="pull-left btn btn-success" type="submit" name="saveandclose" value="<?php echo app('translator')->getFromJson('home.save_close'); ?>" />
              <input class="pull-left btn btn-info" type="submit" name="saveandnew" value="<?php echo app('translator')->getFromJson('home.save_new'); ?>" style="margin-left: 10px;"/>
            </div>
        </div>
      </form>
     </div>
  </div>
 </section>
 <script type="text/javascript">
   function deletephone (num) {
   $('#phoneframe'+num).remove();
   $('#phonetypeframe'+num).remove();
   }
  function addphone(){

  var itrator = $('#itrator').val();
  itrator = +itrator+1;
  var newphone = "<div class='form-group' id='phoneframe"+itrator+"'><input type='text' class='form-control col-xs-5' name='number"+itrator+"' placeholder='ادخل رقم الهاتف'><input onclick='deletephone("+itrator+")' type='button' class='form-control col-xs-1 btn btn-danger pull-left' value='الغاء' ></div><select id='phonetypeframe"+itrator+"' class='form-control col-xs-5' style='margin-right: 5px;' name='phonetype"+itrator+"' placeholder='ادخل رقم الهاتف'><option value=''>-- اختر نوع الهاتف --</option><?php $__currentLoopData = $allphonetypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value='<?php echo e($phtype->id); ?>'><?php echo e($phtype->type); ?></option><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></select>";

  $('#itrator').val(itrator);
  $('#allphones').append(newphone);
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