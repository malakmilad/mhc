
<?php $__env->startSection('pagetitle'); ?> <?php echo app('translator')->getFromJson('home.group'); ?> <?php $__env->stopSection(); ?>
<?php $__env->startSection('contentheader'); ?> 
 <section class="content-header text-right">
    <h1>
      <?php echo app('translator')->getFromJson('home.group'); ?>
      <small><?php echo app('translator')->getFromJson('home.edit'); ?></small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>  <?php echo app('translator')->getFromJson('home.control'); ?> </a></li>
      <li class="active"> <?php echo app('translator')->getFromJson('home.edit'); ?></li>
    </ol>
 </section>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
<section class="content">
  <div class="row">
     <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-edit"></i>
              <h3 class="box-title"> <?php echo app('translator')->getFromJson('home.edit'); ?></h3>
              <!-- tools box -->
              <div class="pull-left box-tools">
                <a href="<?php echo e(route('group.index',$menuid)); ?>" class="btn btn-info btn-sm"><?php echo app('translator')->getFromJson('home.back'); ?> <i class="fa fa-arrow-circle-left"></i></a>
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
              <form action="<?php echo e(route('group.update',$group['id'])); ?>" method="post">
                <?php echo e(csrf_field()); ?>

              <input type="hidden" name="menuid" value="<?php echo e($menuid); ?>">

                <div class="form-group">
                  <input type="text" class="form-control" name="name" value="<?php echo e($group->name); ?>" placeholder="<?php echo app('translator')->getFromJson('home.name'); ?>">
                </div>

                <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col"><?php echo app('translator')->getFromJson('home.page'); ?></th>
                      <th scope="col"><?php echo app('translator')->getFromJson('home.permissions'); ?></th>
                      <th scope="col"><?php echo app('translator')->getFromJson('home.select_all'); ?> <input type="checkbox" onClick="setAllCheckboxes('actors', this);"> </th>
                    </tr>
                  </thead>
                  <tbody id="actors">
                      <?php $itrator = 0 ; ?>
                      <?php $__currentLoopData = $allmenus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $men): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <?php $itrator = $itrator + 1 ;?>
                          <th scope="row"><?php echo e($itrator); ?></th>
                          <td><?php echo e($men->name_en); ?></td>
                          <input type="hidden" name="menu_id<?php echo e($itrator); ?>" value="<?php echo e($men->id); ?>">
                          <td>
                            <div class="form-check" style="display: inline;">
                              <?php
                                $addcheck     = "";
                                $updatecheck  = "";
                                $deletecheck  = "";
                                $viewcheck  = "";
                              ?>
                              <?php $__currentLoopData = $group->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permiss): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($permiss['menu_id'] == $men['id']): ?>
                                    <!-- add -->
                                  <?php if($permiss['add'] == 1): ?>
                                     <?php $addcheck = "checked";?>
                                  <?php elseif($permiss['add'] == 0): ?> 
                                  <?php $addcheck = "";?>
                                  <?php endif; ?>  
                                  <!-- end of add  -->

                                  <!-- view -->
                                  <?php if($permiss['view'] == 1): ?>
                                     <?php $viewcheck = "checked";?>
                                  <?php elseif($permiss['view'] == 0): ?> 
                                  <?php $viewcheck = "";?>
                                  <?php endif; ?>  
                                  <!-- end of view  -->

                                   <!-- update -->
                                  <?php if($permiss['update'] == 1): ?>
                                     <?php $updatecheck = "checked";?>
                                  <?php elseif($permiss['add'] == 0): ?> 
                                  <?php $updatecheck = "";?>
                                  <?php endif; ?>  
                                  <!-- end of update  -->

                                  <!-- update -->
                                  <?php if($permiss['delete'] == 1): ?>
                                     <?php $deletecheck = "checked";?>
                                  <?php elseif($permiss['add'] == 0): ?> 
                                  <?php $deletecheck = "";?>
                                  <?php endif; ?>  
                                  <!-- end of update  -->
                                <?php endif; ?>
                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <input class="form-check-input" type="checkbox" <?php echo e($addcheck); ?> name="add<?php echo e($itrator); ?>" value="1">
                                <label class="form-check-label"><?php echo app('translator')->getFromJson('home.add'); ?></label>
                            </div> |

                            <div class="form-check" style="display: inline;">
                            
                              <input class="form-check-input" type="checkbox" name="update<?php echo e($itrator); ?>" <?php echo e($updatecheck); ?> value="1">
                            <label class="form-check-label"><?php echo app('translator')->getFromJson('home.edit'); ?></label>
                          </div>|

                            <div class="form-check" style="display: inline;">
                            
                              <input class="form-check-input" type="checkbox" name="delete<?php echo e($itrator); ?>" <?php echo e($deletecheck); ?> value="1">
                            <label class="form-check-label"><?php echo app('translator')->getFromJson('home.delete'); ?></label>
                          </div>

                          |

                            <div class="form-check" style="display: inline;">
                            
                              <input class="form-check-input" type="checkbox" name="view<?php echo e($itrator); ?>" <?php echo e($viewcheck); ?> value="1">
                            <label class="form-check-label"><?php echo app('translator')->getFromJson('home.view'); ?></label>
                          </div>

                          </td>
                        </tr>
                        <?php
                          $addcheck     = "";
                          $updatecheck  = "";
                          $deletecheck  = "";
                          $viewcheck  = "";
                        ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </tbody>
                </table>

                <input type="hidden" name="itrator" id="itrator" value="<?php echo e($itrator); ?>">
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
   function setAllCheckboxes(divId, sourceCheckbox) {
    divElement = document.getElementById(divId);
    inputElements = divElement.getElementsByTagName('input');
    for (i = 0; i < inputElements.length; i++) {
        if (inputElements[i].type != 'checkbox')
            continue;
        inputElements[i].checked = sourceCheckbox.checked;
    }
}
 </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>