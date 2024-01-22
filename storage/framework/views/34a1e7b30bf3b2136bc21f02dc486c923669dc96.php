<?php $__env->startSection('pagetitle'); ?> <?php echo app('translator')->getFromJson('home.operation'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
 <section class="content-header text-right">
    <h1>
      <?php echo app('translator')->getFromJson('home.operation'); ?>
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
<script>
  function CalculateRemaining(){
  //  let total_money = $("#total_money").val();
    var total=$("input[name=total_money]").val();
      $("input[name=paid]").val(total);
       var paid=$("input[name=paid]").val();
       var remain=total-paid;
       $("input[name=remaining]").val(remain);
  }
  function CalculateTotalMoney(){
  //  let total_money = $("#total_money").val();
  var service_cost=$("input[name=service_cost]").val();
    var wait_cost=$("input[name=wait_cost]").val();
    var total=parseFloat(wait_cost)+parseFloat(service_cost);
      $("input[name=total_money]").val(total);
       var paid=$("input[name=paid]").val();
       var remain=total-paid;
       $("input[name=remaining]").val(remain);
  }
 function getRemain(){
       var total=$("input[name=total_money]").val();
       var paid=$("input[name=paid]").val();
       var remain=total-paid;
       $("input[name=remaining]").val(remain);
   }
 function myFunction() {
                var checkBox = document.getElementById("CompanyAccount");
                var div = document.getElementById("companydiv");
                if (checkBox.checked == true) {
                    div.style.display = "block";
                } else {
                    div.style.display = "none";
                }
            }
  function viewValue()
  {
    var select = document.getElementById("accounttype");
     var div = document.getElementById("dealvalue");
     var value = select.options[select.selectedIndex].value;

    if(value=="value")
    {
       div.style.display = "block";
    } 
    else {
        div.style.display = "none";
    }
    
  }

</script>
<section class="content">
 <!-- <div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
                <i class="fa fa-plus"></i>
                <h3 class="box-title"> <?php echo app('translator')->getFromJson('home.add_new'); ?></h3>   <div class="pull-left box-tools">-->

                <!-- tools box -->
       <div class="container-fluid h-100">
        <div class="card card-row card-secondary">
          <div class="card-body">
            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">  <?php echo app('translator')->getFromJson('home.add_new'); ?></h5>
                <div class="card-tools">
             
              <!--      <a href="<?php echo e(route('timetable.index',$menuid)); ?>" class="btn btn-info btn-sm"><?php echo app('translator')->getFromJson('home.back'); ?> <i class="fa fa-arrow-circle-left"></i></a>-->
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
              <form method="post"  >
                <?php echo e(csrf_field()); ?>

              <input type="hidden" name="menuid" value="<?php echo e($menuid); ?>">

        <!--     <div class="form-group"> 
                  <label>  <?php echo app('translator')->getFromJson('home.client'); ?> </label> <span style="color: red;">*</span>
                  <select class="form-control" name="sheet_id1" required>
                     <option value=""><?php echo app('translator')->getFromJson('home.client'); ?></option>
                     <?php $__currentLoopData = $allcustomers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cust): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($cust->id); ?>"><?php echo e($cust->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>-->

                <div class="form-group"> 
                  <label for="sheet_id"> Client Name </label> <span style="color: red;">*</span>
                   <input type="text"  class="form-control"  list="sheet_id1" name ="sheet_id" id="sheet_id" >
                </div>
                    <datalist id="sheet_id1"  >
                     <option value=""><?php echo app('translator')->getFromJson('home.client'); ?></option>
                     <?php $__currentLoopData = $allcustomers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cust): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option data-value="<?php echo e($cust->name); ?>"  value="<?php echo e($cust->id); ?>---<?php echo e($cust->name); ?>"><?php echo e($cust->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </datalist>
                
                <div class="form-group">
                  <label> <?php echo app('translator')->getFromJson('home.operation_date'); ?> </label> <span style="color: red;">*</span>
                  <input type="date" class="form-control" required name="dydate" value="<?php echo e(date('Y-m-d')); ?>" >
                </div>
                <div class="form-group">
                  <label> Operation number</label>
                    <input type="text"  class="form-control" required name="name" placeholder="Operation number"/>
                </div>
                
                <div class="form-group">
                  <label>   Operation reservation time </label>
                  <input type="time" class="form-control" name="time"  value="<?php echo e(old('time')); ?>" >
                </div>
              <!-- <div class="form-group"> 
                  <label for="sheet_id"> From (Cities) </label> <span style="color: red;">*</span>
                   <input type="text"  class="form-control"  list="from_area" name ="from_area" id="from_area" >
                </div>
                <datalist id="from_area"  >
                     <option value="">From (Cities)</option>
                     <?php $__currentLoopData = $fromareas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fromarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option data-value="<?php echo e($fromarea->name); ?>"  value="<?php echo e($fromarea->name); ?>"><?php echo e($fromarea->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
               </datalist>-->
                   <div class="form-group">
                    <select  class="form-control" name="from_area">
                      <label>From (Cities) </label>
                      <option value="">From (Cities)</option>
                      <?php $__currentLoopData = $fromareas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fromarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                       <option value="<?php echo e($fromarea->id); ?>"><?php if(isset($fromarea->Gov['name']  )): ?><?php echo e($fromarea->Gov['name']); ?><?php endif; ?>/<?php echo e($fromarea->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
                <!--<div class="form-group"> 
                  <label for="to_area"> To (Cities) </label> <span style="color: red;">*</span>
                   <input type="text"  class="form-control"  list="to_area" name ="to_area" id="to_area" >
                </div>
                <datalist id="to_area"  >
                  <option value="">To (Cities)</option>
                  <?php $__currentLoopData = $toareas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $toarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option data-value="<?php echo e($toarea->name); ?>"  value="<?php echo e($toarea->id); ?>/<?php if(isset($toarea->parent)): ?><?php echo e($toarea->parent); ?><?php endif; ?>/<?php echo e($toarea->name); ?>">
                    <?php if(isset($toarea->parent)): ?><?php echo e($toarea->parent); ?><?php endif; ?>/<?php echo e($toarea->name); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </datalist>-->
                 <div class="form-group">
                    <select  class="form-control" name="to_area">
                      <label>لإخ (Cities) </label>
                      <option value="">To (Cities)</option>
                      <?php $__currentLoopData = $toareas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $toarea): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($toarea->id); ?>"><?php if(isset( $toarea->Gov['name'])): ?><?php echo e($toarea->Gov['name']); ?><?php endif; ?>/<?php echo e($toarea->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                  </div>
              

               <div class="form-group">
                  <select  class="form-control" required name="vehicle_id[]">
                     <label>Select Vehicle </label>
                     <option value="">Vehicle</option>
                    <?php $__currentLoopData = $allvehicles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $vehicle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($vehicle->id); ?>"><?php echo e($vehicle->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                <div class="form-group">
                  <label> <?php echo app('translator')->getFromJson('home.direction'); ?> </label> <span style="color: red;">*</span>
                  <select name="direction" required class="form-control">
                      <option value="">Select direction</option>
                      <option value="one way">one way</option>
                      <option value="Round trip">Round trip</option>
                      <option value="Wait">Wait</option>
                  </select>
                </div>

                <div class="form-group">
                  <label>  <?php echo app('translator')->getFromJson('home.notes'); ?> </label>
                  <textarea class="form-control" name="note" placeholder=" <?php echo app('translator')->getFromJson('home.notes'); ?>"></textarea>
                </div>
                
                <div class="form-group">
                   <label> <?php echo app('translator')->getFromJson('home.operation_type'); ?> </label><span style="color: red;">*</span>
                  <select  class="form-control" name="tasktype">
                      <?php $__currentLoopData = $alltypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($type->id); ?>"><?php echo e($type->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                
                <div class="form-group">
                   <label> <?php echo app('translator')->getFromJson('home.employee'); ?> </label><span style="color: red;">*</span>
                  <select  class="form-control" name="employee">
                      <?php $__currentLoopData = $allusers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if(isset($user_id) && $user_id==$user->id): ?>
                         <option value="<?php echo e($user->id); ?>" selected><?php echo e($user->name); ?></option>
                         <?php else: ?>
                     <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                     <?php endif; ?>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>

                <div class="form-group">
                   <label> <?php echo app('translator')->getFromJson('home.operation_status'); ?> </label><span style="color: red;">*</span>
                  <select  class="form-control" name="meetingstate">
                      <?php $__currentLoopData = $allstatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                     <option value="<?php echo e($status->id); ?>"><?php echo e($status->name); ?></option>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                <div class="form-group">
                  <label> <?php echo app('translator')->getFromJson('home.service_cost'); ?> </label> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="service_cost"  onkeyup="CalculateTotalMoney()" min="0" value="0" onblur="CalculateTotalMoney()">
                </div>
                <div class="form-group">
                  <label> <?php echo app('translator')->getFromJson('home.wait_cost'); ?> </label> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="wait_cost"  onkeyup="CalculateTotalMoney()" min="0" value="0" onblur="CalculateTotalMoney()">
                </div>
                <div class="form-group">
                  <label> <?php echo app('translator')->getFromJson('home.total_money'); ?> </label> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="total_money"  onkeyup="CalculateRemaining()" min="0" value="0" onblur="getRemain()">
                </div>
                
                 <div class="form-group">
                  <label> <?php echo app('translator')->getFromJson('home.paid'); ?> </label> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="paid"  min="0" value="0" onblur="getRemain()" onkeyup="getRemain()">
                 </div>
                 
                  <div class="form-group">
                  <label> <?php echo app('translator')->getFromJson('home.remaining'); ?> </label> <span style="color: red;"></span>
                  <input type="number" class="form-control"  name="remaining"  min="0" value="0" readonly>
                 </div>
                 
                  <div class="form-group">
                  <label> <?php echo app('translator')->getFromJson('home.desrved_date'); ?> </label> <span style="color: red;"></span>
                  <input type="date" class="form-control"  name="desrved_date" >
                 </div>
                
                
                
            

                <input type="checkbox" id="CompanyAccount" name="CompanyAccount"  onclick="myFunction()">
                <label for="CompanyAccount"> Company Account</label><br>
               <!--  <fieldset>
                 <legend>Company Account:</legend>-->
                 <div class="thumbnail"  id="companydiv" style="display:none">
                 <div class="form-group">
                   <label> Company Name </label>
                      <select  class="form-control" name="company_id">
                          <option value="">Select company</option>
                          <?php $__currentLoopData = $allcompanies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $company): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($company->id); ?>"><?php echo e($company->name); ?></option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                </div>
                <div class="form-group">
                   <label> Select Account Type  </label>
                      <select  class="form-control"  onchange="viewValue()" id="accounttype" name="accounttype">
                          <option value=""> Select Account Type </option>
                            <option value="perc" > Percentage </option>
                              <option value="value"   > Value </option>
                      </select>
                </div>
                <input type="radio" id="add" name="Deal" value="add">
                <label for="add">Add</label><br>
                <input type="radio" id="deduct" name="Deal" value="deduct">
                <label for="deduct">Deduct</label><br>
                <div class="form-group" id="dealvalue" style="display:none">
                  <label> Deal Value </label>
                  <input type="number" class="form-control"  name="dealvalue"  required min="1" value="1">
                </div>
                </div>
               <!--  </fieldset>-->


         
            <div class="box-footer clearfix">
             <input class="pull-left btn btn-success" type="submit" name="saveandclose" value="<?php echo app('translator')->getFromJson('home.save_close'); ?>" formaction="<?php echo e(route('timetable.store1')); ?>"/>
             <input class="pull-left btn btn-info" type="submit" name="saveandnew" value="<?php echo app('translator')->getFromJson('home.save_new'); ?>" formaction="<?php echo e(route('timetable.store1')); ?>" style="margin-left: 10px;"/>
     
                   
            </div>
      
      </form>
      <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
         </div>
           </div>
     </div>
  </div>
  </section>
<?php $__env->stopSection(); ?>
 <style type="text/css">
   #sheet_id1 option.hide 
   {
    display: none;
    }
 #sheet_id1 li.option 
    {
      display: none;
    }
 </style>
 <?php $__env->startPush('scripts'); ?>
 <script type="text/javascript">
       $(document).ready(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
             
        });

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
  
 //  window.addEventListener("load", function(){
  // (B) ATTACH KEY UP LISTENER TO SEARCH BOX
  document.getElementById("sheet_id").addEventListener("keyup", function(){
    // (C) GET THE SEARCH TERM
    var search = this.value.toLowerCase();

    // (D) GET ALL LIST ITEMS
    var all = document.querySelectorAll("#sheet_id1 option");

    // (E) LOOP THROUGH LIST ITELS - ONLY SHOW ITEMS THAT MATCH SEARCH
    for (let i of all) {
      let item = i.innerHTML.toLowerCase();
      if (item.indexOf(search) == -1) { i.classList.add("hide"); }
      else { i.classList.remove("hide"); }
    }
  });
//});
function CalculateRemaining(){
  //  let total_money = $("#total_money").val();
    var total=$("input[name=total_money]").val();
      $("input[name=paid]").val(total);
       var paid=$("input[name=paid]").val();
       var remain=total-paid;
       $("input[name=remaining]").val(remain);
  }
   $(function() {
    $('#CompanyAccount').change(function() {
      //  $('#companydiv').toggle($(this).is(':checked'));
        $('#companydiv').toggle( this.checked);
    });
});

function CalculateTotalMoney(){
  //  let total_money = $("#total_money").val();
    var service_cost=$("input[name=service_cost]").val();
    var wait_cost=$("input[name=wait_cost]").val();
    var total=parseFloat(wait_cost)+parseFloat(service_cost);
      $("input[name=total_money]").val(total);
       var paid=$("input[name=paid]").val();
       var remain=total-paid;
       $("input[name=remaining]").val(remain);
  }
 </script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>