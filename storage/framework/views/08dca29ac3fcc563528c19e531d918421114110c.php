<?php $__env->startSection('pagetitle'); ?> <?php echo app('translator')->getFromJson('home.customer'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
 <section class="content-header text-right">
    <h1>
      <?php echo app('translator')->getFromJson('home.customer'); ?>
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
              <h3 class="box-title"><?php echo app('translator')->getFromJson('home.add_new'); ?></h3>-->
        <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  </h5>
                <div class="card-tools">
              <!-- tools box -->
              <div class="pull-left box-tools">
               <!-- <a href="<?php echo e(route('sheet.index',$menuid)); ?>" class="btn btn-info btn-sm"><?php echo app('translator')->getFromJson('home.back'); ?> <i class="fa fa-arrow-circle-left"></i></a>-->
              </div><!-- /. tools -->
            </div>
           <div class="card-body">
            <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger text-center">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <P><?php echo e($error); ?></P>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
              <form action="<?php echo e(route('sheet.store')); ?>" method="post" id="AddSheet" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="menuid" value="<?php echo e($menuid); ?>">
               <?php if( \Auth::user()->type == 1 ): ?>
                <div class="form-group">
                   <label> <?php echo app('translator')->getFromJson('home.employee'); ?> </label> <span style="color: red;">*</span>

                  <select name="user_id" required class="form-control">
                    
                    <?php $__currentLoopData = $allusers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if( $userr['id']  == \Auth::user()->id ): ?>
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
                <div class="form-group">
                   <label><?php echo app('translator')->getFromJson('home.name'); ?></label> <span style="color: red;">*</span>
                  <input type="text" class="form-control" name="name"  required value="<?php echo e(old('name')); ?>" placeholder="<?php echo app('translator')->getFromJson('home.name'); ?>">
                </div>

                <div class="form-group">
                   <label><?php echo app('translator')->getFromJson('home.email'); ?></label>
                  <input type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo app('translator')->getFromJson('home.email'); ?>">
                </div>
                <div class="form-group">
                   <label><?php echo app('translator')->getFromJson('home.address'); ?></label>
                  <input type="text" class="form-control" name="address" value="<?php echo e(old('address')); ?>" placeholder="<?php echo app('translator')->getFromJson('home.address'); ?>">
                </div>
                <div class="form-group">
                   <label><?php echo app('translator')->getFromJson('home.customer_weight'); ?></label>
                  <input type="number" class="form-control" name="customer_weight" value="<?php echo e(old('customer_weight')); ?>" placeholder="<?php echo app('translator')->getFromJson('home.customer_weight'); ?>">
                </div>
                <div class="form-group">
                  <label> <?php echo app('translator')->getFromJson('home.CustomerType'); ?> </label> <span style="color: red;">*</span>
                  <select name="customer_type" required class="form-control">
                  <?php $__currentLoopData = $customerTypess; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>  Dynamic Date </label>
                  <input type="date"  name="dynmicdate" class="form-control" />
                </div>

                <!--<div class="form-group">
                  <label> ادخل تاريخ الترحيل </label>
                  <input type="date" value="<?php echo e(date('Y-m-d')); ?>" class="form-control" name="dynmicdate">
                </div>-->

              
                <!--  <div class="form-group"> 
                      <label for="activitytype"> <?php echo app('translator')->getFromJson('home.activity'); ?> </label> <span style="color: red;">*</span>
                      <input type="text"  class="form-control"  list="activity1" name ="activitytype" id="activitytype" >
                  </div>
                   <datalist id="activity1"  >
                    
                     <option value=""><?php echo app('translator')->getFromJson('home.activity'); ?></option>
                      <?php $__currentLoopData = $acivites; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($activity->name); ?>"><?php echo e($activity->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </datalist>-->
              

                    <div class="form-group">
                      <label> <?php echo app('translator')->getFromJson('home.notes'); ?></label>
                      <textarea class="form-control" name="note" placeholder="<?php echo app('translator')->getFromJson('home.notes'); ?>"><?php echo e(old('note')); ?></textarea>
                    </div>

                <!--<div class="form-group">
                   <label> ادخل حالة المتابعة </label>
                  <textarea class="form-control" name="followtype" placeholder="ادخل حالة المتابعة"><?php echo e(old('followtype')); ?></textarea>
                </div>-->

               
                <div class="form-group">
                  <label><?php echo app('translator')->getFromJson('home.client_type'); ?></label>
                <select class="form-control" name="isintrest">
                  <?php $__currentLoopData = $customerTypess; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                </div>
                
                <div class="form-group">
                  <label><?php echo app('translator')->getFromJson('home.know_from'); ?></label>
                <select class="form-control" name="socail">
                  <?php $__currentLoopData = $socails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $socail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($socail->id); ?>"><?php echo e($socail->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                </div>
                
                    <div class="form-group">
                      <label><?php echo app('translator')->getFromJson('home.gov'); ?> </label>
                      <select name="govid" id="gov" required onchange="chnage_gov()" class="form-control">
                      <option value=""><?php echo app('translator')->getFromJson('home.gov'); ?></option>
                      <?php $__currentLoopData = $govs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gov): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($gov->id); ?>"><?php echo e($gov->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                    
                    <div class="form-group">
                      <label><?php echo app('translator')->getFromJson('home.area'); ?></label>
                      <select name="areaid" id="city" required class="form-control">
                      <option value=""><?php echo app('translator')->getFromJson('home.area'); ?></option>
                      <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($city->id); ?>" parent="<?php echo e($city->parentid); ?>" style="display:none"><?php echo e($city->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>
                     <div class="form-group">  <label><?php echo app('translator')->getFromJson('home.services'); ?> </label>
                      <select multiple class="form-control" name="service_id[]">
                      
                        <option value=""> Choose Service</option>
                        <?php $__currentLoopData = $allservices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($service->id); ?>"><?php echo e($service->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                    </div>

                      <div class="form-group"> <label> Disease </label>
                        <select multiple class="form-control" name="disease_id[]">
                          <option value="">Select Disease</option>
                          <?php $__currentLoopData = $alldiseases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $disease): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($disease->id); ?>"><?php echo e($disease->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                      </div>
                     <div class="form-group">
                      <label> <?php echo app('translator')->getFromJson('home.upload_file'); ?></label>
                      <input type="file" name="customerFile" class="form-control">
                    </div>

                <div class="form-group">
                   <label> <?php echo app('translator')->getFromJson('home.color'); ?> </label>
                  <input type="color" value="#FFFFFF" class="form-control" name="color">
                </div>
                
                
                <div id="allphones">
                
                <div class="form-group" id="phoneframe1">
                  
                  <input type="text" class="form-control col-xs-5" required value="<?php echo e(old('number1')); ?>" name="number1" placeholder="ادخل رقم الهاتف">

                  <select id="phonetypeframe1" required class="form-control col-xs-5" style="margin-right: 5px;" name="phonetype1" placeholder="ادخل رقم الهاتف">

                  <option value=""><?php echo app('translator')->getFromJson('home.phone_type'); ?></option>
                    <?php $__currentLoopData = $allphonetypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $phtype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($phtype->id); ?>"><?php echo e($phtype->type); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>

                  <input onclick="deletephone(1)" type="button" disabled class="form-control col-xs-1 btn btn-danger pull-left" value="<?php echo app('translator')->getFromJson('home.cancel'); ?>" >
                </div>
                
                </div>
                <br>
                <br>
                <div class="form-group col-xs-4">
                  <input onclick='addphone()' type='button' class='form-control btn btn-success' value='<?php echo app('translator')->getFromJson('home.add_new'); ?>'>
                </div>

                <input type="hidden" name="itrator" id="itrator" value="1">

            </div>

           <hr>
            <div id="timetable" style="display:none;">

             <div class='form-group'>
             
             <label>  <?php echo app('translator')->getFromJson('home.created_at'); ?> </label> <span style="color: red;">*</span>

             <input type='date' name='created_at'    class='form-control' placeholder='ادخل تاريخ الانشاء'>

             </div>

             <div class='form-group'>
             
             <label> تاريخ الترحيل </label> <span style="color: red;">*</span>

             <input type='date' value="<?php echo e(date('Y-m-d')); ?>" class='form-control' name='dydate' placeholder='ادخل تاريخ الترحيل'>

             </div>

             <div class='form-group'>
             <label> <?php echo app('translator')->getFromJson('home.time'); ?></label> <span style="color: red;">*</span>
             
             <input type='time' class='form-control' name='time' placeholder='<?php echo app('translator')->getFromJson('home.time'); ?>'>

             </div>

             <div class='form-group'>
              <label> <?php echo app('translator')->getFromJson('home.place_meet'); ?></label> <span style="color: red;">*</span>
             <textarea class='form-control' name='meetingplace' placeholder='<?php echo app('translator')->getFromJson('home.place_meet'); ?>'></textarea>
             </div>

             <div class='form-group'>
              <label><?php echo app('translator')->getFromJson('home.notes'); ?></label>

             <textarea class='form-control' name='timenote' placeholder=' <?php echo app('translator')->getFromJson('home.notes'); ?>'></textarea>
             </div>

             <div class='form-group'>

             <select class='form-control' name='meetingstate'><option value='0'>لم تتم المقابلة بعد</option><option value='1'>تمت المقابلة</option>
             </select>

             </div>

             <input type='hidden' name='checker' value="0" id="checker"/><button onclick='deletetimetable()'  type='button' class='btn btn-danger'> <?php echo app('translator')->getFromJson('home.delete'); ?> </button>
            
            </div>

           <!-- <div id="timetablebutton">
            <button onclick='addtimetable()' id='buttonaddtimetable' type='button' class='btn btn-info'>اضافة ميعاد لهذا العميل 
            </button>
            </div>-->
            

            <div class="box-footer clearfix">
            <input class="pull-left btn btn-success" type="submit" name="saveandclose" value="<?php echo app('translator')->getFromJson('home.save_close'); ?>" />
              <input class="pull-left btn btn-info" type="submit" name="saveandnew" value="<?php echo app('translator')->getFromJson('home.save_new'); ?>" style="margin-left: 10px;"/>
            </div>
        </div>
      </form>
     </div>
  </div>
 </section>
 <style type="text/css">
   #activity1 option.hide 
   {
    display: none;
    }
 #activity1 li.option 
    {
      display: none;
    }
 </style>
 <script type="text/javascript">

      $(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        });

   function addtimetable(){
     
$('#timetable').slideDown();
$('#buttonaddtimetable').fadeOut();
$('#checker').val('1');

   }
   function deletetimetable(){
    
    $('#timetable').slideUp(function(){
      $('#buttonaddtimetable').fadeIn();
      $('#checker').val('0');
    });
    
    
   }
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
 document.getElementById("activitytype").addEventListener("keyup", function(){
    // (C) GET THE SEARCH TERM
    var search = this.value.toLowerCase();

    // (D) GET ALL LIST ITEMS
    var all = document.querySelectorAll("#activity1 option");

    // (E) LOOP THROUGH LIST ITELS - ONLY SHOW ITEMS THAT MATCH SEARCH
    for (let i of all) {
      let item = i.innerHTML.toLowerCase();
      if (item.indexOf(search) == -1) { i.classList.add("hide"); }
      else { i.classList.remove("hide"); }
    }
  });
}
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>