   <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar user panel (optional) -->
          <div class="user-panel">
         <!--   <div class="image" style="margin-right: 30%;">
              @if(\Auth::user()->logo != NULL)
              <img src="{{ asset('public/'.\Auth::user()->logo) }}" class="img-circle" alt="User Image">
              @else
              <img src="{{ asset('adminstyle/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
              @endif
            </div>-->
              <div class="image" style="margin-right: 30%;width:30px;height:30px;">
             </div>

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu" style="font-size: 15px; font-weight: bold;">
            <li style="font-size: 14px; font-weight: bold;" class="header text-center">@lang("home.menu")</li>
            <!-- Optionally, you can add icons to the links -->
            
            <li class="active">
                <a style="font-size: 13px; font-weight: bold;" href="{{ route('home') }}"><i class="fa fa-tachometer"></i> <span>@lang('home.control')</span> </a>
            </li>

             @foreach(\Auth::user()->groups as $usergroup)   <!-- user Groups -->
            @foreach($usergroup->group->permissions as $permission)   <!-- group permissions -->
            @if((($permission['add'] == 1) || ($permission['update'] == 1) || ($permission['delete'] == 1))  || ($permission['view'] == 1)  )
            @if($permission->menus->menus->count() > 0 )
                   <!-- inside menu -->
                  <?php $active = ""; ?>
                  @foreach($permission->menus->menus as $insidemenu)
                   @if(isset($menuid) && $menuid == $insidemenu['id'] )
                    <?php $active = "active"; ?>
                   @endif
                  @endforeach
              <li class="treeview <?php if (isset($active)) {
  echo $active;
}?>">
                <?php $active = ""; ?>
                  @if(Session::has("locale") && Session::get("locale")=="ar")
                  <a style="font-size: 13px; font-weight: bold;" href="#"><i class="{{ $permission->menus['icon'] }}"></i> <span>{{ $permission->menus['name'] }}</span> <i class="fa fa-angle-left pull-left"></i></a>
                  @else
                  <a style="font-size: 13px; font-weight: bold;" href="#"><i class="{{ $permission->menus['icon'] }}"></i> <span>{{ $permission->menus['name_en'] }}</span> <i class="fa fa-angle-left fa-angle-right pull-right"></i></a>
                  @endif
                  <ul class="treeview-menu">
                     <?php $active = ""; ?>
                   @foreach($permission->menus->menus as $insidemenu)
                      @if(isset($menuid) && $menuid == $insidemenu['id'] )
                        <?php $active = "active"; ?>
                      @endif
                      
                       <?php
$has_per = \App\Http\Controllers\MenuController::check_menue($insidemenu['id']);
?>
                    @if($has_per==1) 
                    @if(Session::has("locale") && Session::get("locale")=="ar")
                    <li class="<?php if (isset($active)) {
  echo $active;
}?>"><a style="font-weight: bold;font-size: 12px; margin-right: 20px;" href="{{ route($insidemenu['url'],$insidemenu['id']) }}"><i class="{{ $insidemenu['icon'] }}"></i> <span>{{ $insidemenu['name'] }}</span></a>
                    </li>
                    @else
                    <li class="<?php if (isset($active)) {
  echo $active;
}?>"><a style="font-weight: bold;font-size: 12px; margin-right: 20px;" href="{{ route($insidemenu['url'],$insidemenu['id']) }}"><i class="{{ $insidemenu['icon'] }}"></i> <span>{{ $insidemenu['name_en'] }}</span></a>
                    </li>
                    @endif
                    @endif
                    <?php $active = ""; ?>
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
 
                 <li class="<?php if (isset($active)) {
  echo $active;
}?>">
                   <?php $active = ""; ?>
                   @if(Session::has("locale") && Session::get("locale")=="ar")
                   <a style="font-size: 13px; font-weight: bold;" href="{{ route($permission->menus['url'],$permission->menus['id']) }}"><i class="{{ $permission->menus['icon'] }}"></i> <span>{{ $permission->menus['name'] }}</span> <i class=" pull-right"></i></a>
                   @else
                   <a style="font-size: 13px; font-weight: bold;" href="{{ route($permission->menus['url'],$permission->menus['id']) }}"><i class="{{ $permission->menus['icon'] }}"></i> <span>{{ $permission->menus['name_en'] }}</span> <i class=" pull-right"></i></a>

                   @endif
                </li>
               @endif
               <!-- end of main menu -->
            @endif <!-- endif of count of menus in permissions --> 
          @endif  <!-- end if of add or update or delete -->
            @endforeach  <!-- end of group permissions -->
          @endforeach  <!-- end of user Groups -->

           

          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>