   <aside class="main-sidebar sidebar-dark-primary elevation-4 "   id="collapseExample">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image" style="margin-right: 30%;">
              @if(\Auth::user()->logo != NULL)
              <img src="{{ asset('public/'.\Auth::user()->logo) }}" class="img-circle" alt="User Image">
              @else
              <img src="{{ asset('adminstyle/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
              @endif
          </div>
           <p style="color:white">
                     {{ \Auth::user()->name }}
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
          <li class="nav-item menu-open">@lang("home.menu")</li>
        
       
           <!-- Optionally, you can add icons to the links -->
            <li class="nav-item menu-open">
            <a href="{{ route('home') }}" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
              @lang('home.control')
                <i class="nav-icon  fas fa-angle"></i>
              </p>
            </a>          
            </li>

             @foreach(\Auth::user()->groups as $usergroup)   <!-- user Groups -->
              @foreach($usergroup->group->permissions as $permission)   <!-- group permissions -->
              @if((($permission['add'] == 1) || ($permission['update'] == 1) || ($permission['delete'] == 1))  || ($permission['view'] == 1)  )
              @if($permission->menus->menus->count() > 0 )
                   <!-- inside menu -->
                  <?php $active = "";  ?>
                  @foreach($permission->menus->menus as $insidemenu)
                   @if(isset($menuid) && $menuid == $insidemenu['id'] )
                    <?php $active = "active";  ?>
                   @endif
                  @endforeach
              <li class="nav-item <?php if( isset($active) ){ echo $active; }?>">
                <?php $active = "";  ?>
                  @if(Session::has("locale") && Session::get("locale")=="ar")
                  <a style="font-size: 13px; font-weight: bold;" href="#"  class="nav-link">
                  <i class="{{ $permission->menus['icon'] }}"></i> <p>{{ $permission->menus['name'] }}</p>
                   <i class="nav-icon  fa  right fa-angle-left "></i></a>
                  @else
                  <a style="font-size: 13px; font-weight: bold;" href="#"  class="nav-link">
                  <i class="nav-icon   {{ $permission->menus['icon'] }}"></i> <p>{{ $permission->menus['name_en'] }}</p>
                   <i class="nav-icon fa right fa-angle-left"></i></a>
                  @endif
                  <ul class="nav nav-treeview">
                     <?php $active = "";  ?>
                   @foreach($permission->menus->menus as $insidemenu)
                      @if(isset($menuid) && $menuid == $insidemenu['id'] )
                        <?php $active = "active";  ?>
                      @endif
                      
                       <?php
                     $has_per=\App\Http\Controllers\MenuController::check_menue($insidemenu['id']);
                    ?>
                    @if($has_per==1) 
                    @if(Session::has("locale") && Session::get("locale")=="ar")
                    <li class="nav-item <?php if( isset($active) ){ echo $active; }?>">
                    <a style="font-weight: bold;font-size: 12px; margin-right: 20px;" class="nav-link" 
                    href="{{ route($insidemenu['url'],$insidemenu['id']) }}">
                    <i class="nav-icon   {{ $insidemenu['icon'] }}"></i> <p>{{ $insidemenu['name'] }}</p></a>
                    </li>
                    @else
                    <li class=" nav-item <?php if( isset($active) ){ echo $active; }?>">
                    <a class="nav-link" style="font-weight: bold;font-size: 12px; margin-right: 20px;"
                     href="{{ route($insidemenu['url'],$insidemenu['id']) }}">
                    <i class="nav-icon   {{ $insidemenu['icon'] }}"></i> <p>{{ $insidemenu['name_en'] }}</p></a>
                    </li>
                    @endif
                    @endif
                    <?php $active = "";  ?>
                    @endforeach
                </ul>
            </li>  <!-- end of comp owner requestes -->
                   <!-- end of inside menu -->
            @else
               <!-- main menu -->
                @if($permission->menus['parent_id'] == NULL && $permission->menus['url'] != NULL)
                 
                 <?php $active = "";
                   //dd($usergroup->group->permissions);
                 ?>
                  @if( isset($menuid) && $permission->menus['id'] == $menuid)
                      <?php $active = "active"; ?>
                  @endif
 
                 <li class="nav-item <?php if( isset($active) ){ echo $active; }?>">
                   <?php $active = "";?>
                   @if(Session::has("locale") && Session::get("locale")=="ar")
                   <a style="font-size: 13px; font-weight: bold; "  class="nav-link" href="{{ route($permission->menus['url'],$permission->menus['id']) }}">
                   <i class=" nav-icon   {{ $permission->menus['icon'] }}"></i> <p>{{ $permission->menus['name'] }}</p> <i class=" pull-right"></i></a>
                   @else
                   <a style="font-size: 13px; font-weight: bold;"  class="nav-link" href="{{ route($permission->menus['url'],$permission->menus['id']) }}">
                   <i class="nav-icon   {{ $permission->menus['icon'] }}"></i> <p>{{ $permission->menus['name_en'] }}</p> <i class=" pull-right"></i></a>

                   @endif
                </li>
               @endif
               <!-- end of main menu -->
            @endif <!-- endif of count of menus in permissions --> 
          @endif  <!-- end if of add or update or delete -->
            @endforeach  <!-- end of group permissions -->
          @endforeach  <!-- end of user Groups -->

           

          </ul><!-- /.sidebar-menu -->
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>