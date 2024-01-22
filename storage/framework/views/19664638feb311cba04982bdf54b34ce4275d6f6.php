   <aside class="main-sidebar sidebar-dark-primary elevation-4 "   id="collapseExample">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image" style="margin-right: 30%;">
              <?php if(\Auth::user()->logo != NULL): ?>
              <img src="<?php echo e(asset('public/'.\Auth::user()->logo)); ?>" class="img-circle" alt="User Image">
              <?php else: ?>
              <img src="<?php echo e(asset('adminstyle/dist/img/user2-160x160.jpg')); ?>" class="img-circle" alt="User Image">
              <?php endif; ?>
          </div>
           <p style="color:white">
                     <?php echo e(\Auth::user()->name); ?>

                    </p>
          <div class="image" style="margin-right: 30%;width:30px;height:30px;">
          </div>
      </div>

      <!-- SidebarSearch Form 
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>-->
<nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column"data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open"><?php echo app('translator')->getFromJson("home.menu"); ?></li>
        
       
           <!-- Optionally, you can add icons to the links -->
            <li class="nav-item menu-open">
            <a href="<?php echo e(route('home')); ?>" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              <?php echo app('translator')->getFromJson('home.control'); ?>
                <i class="nav-icon  fas fa-angle"></i>
              </p>
            </a>          
            </li>

             <?php $__currentLoopData = \Auth::user()->groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usergroup): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   <!-- user Groups -->
              <?php $__currentLoopData = $usergroup->group->permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>   <!-- group permissions -->
              <?php if((($permission['add'] == 1) || ($permission['update'] == 1) || ($permission['delete'] == 1))  || ($permission['view'] == 1)  ): ?>
              <?php if($permission->menus->menus->count() > 0 ): ?>
                   <!-- inside menu -->
                  <?php $active = "";  ?>
                  <?php $__currentLoopData = $permission->menus->menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insidemenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                   <?php if(isset($menuid) && $menuid == $insidemenu['id'] ): ?>
                    <?php $active = "active";  ?>
                   <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <li class="nav-item <?php if( isset($active) ){ echo $active; }?>">
                <?php $active = "";  ?>
                  <?php if(Session::has("locale") && Session::get("locale")=="ar"): ?>
                  <a style="font-size: 13px; font-weight: bold;" href="#"  class="nav-link">
                  <i class="<?php echo e($permission->menus['icon']); ?>"></i> <p><?php echo e($permission->menus['name']); ?></p>
                   <i class="nav-icon  fa  right fa-angle-left "></i></a>
                  <?php else: ?>
                  <a style="font-size: 13px; font-weight: bold;" href="#"  class="nav-link">
                  <i class="nav-icon   <?php echo e($permission->menus['icon']); ?>"></i> <p><?php echo e($permission->menus['name_en']); ?></p>
                   <i class="nav-icon fa right fa-angle-left"></i></a>
                  <?php endif; ?>
                  <ul class="nav nav-treeview">
                     <?php $active = "";  ?>
                   <?php $__currentLoopData = $permission->menus->menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insidemenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if(isset($menuid) && $menuid == $insidemenu['id'] ): ?>
                        <?php $active = "active";  ?>
                      <?php endif; ?>
                      
                       <?php
                     $has_per=\App\Http\Controllers\MenuController::check_menue($insidemenu['id']);
                    ?>
                    <?php if($has_per==1): ?> 
                    <?php if(Session::has("locale") && Session::get("locale")=="ar"): ?>
                    <li class="nav-item <?php if( isset($active) ){ echo $active; }?>">
                    <a style="font-weight: bold;font-size: 12px; margin-right: 20px;" class="nav-link" 
                    href="<?php echo e(route($insidemenu['url'],$insidemenu['id'])); ?>">
                    <i class="nav-icon   <?php echo e($insidemenu['icon']); ?>"></i> <p><?php echo e($insidemenu['name']); ?></p></a>
                    </li>
                    <?php else: ?>
                    <li class=" nav-item <?php if( isset($active) ){ echo $active; }?>">
                    <a class="nav-link" style="font-weight: bold;font-size: 12px; margin-right: 20px;"
                     href="<?php echo e(route($insidemenu['url'],$insidemenu['id'])); ?>">
                    <i class="nav-icon   <?php echo e($insidemenu['icon']); ?>"></i> <p><?php echo e($insidemenu['name_en']); ?></p></a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php $active = "";  ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </li>  <!-- end of comp owner requestes -->
                   <!-- end of inside menu -->
            <?php else: ?>
               <!-- main menu -->
                <?php if($permission->menus['parent_id'] == NULL && $permission->menus['url'] != NULL): ?>
                 
                 <?php $active = "";
                   //dd($usergroup->group->permissions);
                 ?>
                  <?php if( isset($menuid) && $permission->menus['id'] == $menuid): ?>
                      <?php $active = "active"; ?>
                  <?php endif; ?>
 
                 <li class="nav-item <?php if( isset($active) ){ echo $active; }?>">
                   <?php $active = "";?>
                   <?php if(Session::has("locale") && Session::get("locale")=="ar"): ?>
                   <a style="font-size: 13px; font-weight: bold; "  class="nav-link" href="<?php echo e(route($permission->menus['url'],$permission->menus['id'])); ?>">
                   <i class=" nav-icon   <?php echo e($permission->menus['icon']); ?>"></i> <p><?php echo e($permission->menus['name']); ?></p> <i class=" pull-right"></i></a>
                   <?php else: ?>
                   <a style="font-size: 13px; font-weight: bold;"  class="nav-link" href="<?php echo e(route($permission->menus['url'],$permission->menus['id'])); ?>">
                   <i class="nav-icon   <?php echo e($permission->menus['icon']); ?>"></i> <p><?php echo e($permission->menus['name_en']); ?></p> <i class=" pull-right"></i></a>

                   <?php endif; ?>
                </li>
               <?php endif; ?>
               <!-- end of main menu -->
            <?php endif; ?> <!-- endif of count of menus in permissions --> 
          <?php endif; ?>  <!-- end if of add or update or delete -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  <!-- end of group permissions -->
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  <!-- end of user Groups -->

           

          </ul><!-- /.sidebar-menu -->
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>