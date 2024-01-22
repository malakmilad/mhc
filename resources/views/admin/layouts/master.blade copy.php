<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title> دي سي اس | @yield('pagetitle')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
   <!-- Bootstrap 3.3.4 -->
    @if(Session::has("locale") && Session::get("locale")=="ar")
    
    <link rel="stylesheet" href="{{ asset('adminstyle/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminstyle/dist/css/bootstrap-rtl.min.css') }}">
    
    @else
    <link rel="stylesheet" href="{{ asset('adminstyle/bootstrap/css/bootstrap.min.css') }}">
     
     @endif
      <link href="{{ asset('adminstyle/fontawesome/css/all.css') }}" rel="stylesheet">
    <!-- Data Table -->
    <link rel="stylesheet" href="{{ asset('adminstyle/plugins/datatables/jquery.dataTables.css') }}">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminstyle/dist/css/AdminLTE.css') }}">
    
    <link rel="stylesheet" href="{{ asset('adminstyle/dist/css/skins/skin-blue.min.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('adminstyle/dist/css/bootstrap-rtl.min.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('adminstyle/plugins/datatables/dataTables.bootstrap.css') }}">
    
    <!-- Custom Style -->
    @if(Session::has("locale") && Session::get("locale")=="ar")
    
    <link rel="stylesheet" href="{{ asset('adminstyle/dist/css/customstylertl.css') }}">
    
    @else
    
    <link rel="stylesheet" href="{{ asset('adminstyle/dist/css/customstyle.css') }}">
    
    @endif
    
    <link rel="stylesheet" href="{{ asset('adminstyle/dist/css/custom-style.css') }}">
    
     <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
    <script src="{{ asset('adminstyle/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
     <!-- Data Tables -->
    <script src="{{ asset('adminstyle/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <!-- Bootstrap 3.3.4 -->
    <script src="{{ asset('adminstyle/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminstyle/dist/js/app.min.js') }}"></script>


 <script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
      
      
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.4.1/js/buttons.print.min.js"></script>

<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.50/pdfmake.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.50/vfs_fonts.js"></script>

  
      
  </head>
  
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">

      @include('admin.adminPartials.topheader')
      <!-- Left side column. contains the logo and sidebar -->
   
      @include('admin.adminPartials.sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('contentheader')
        <!-- Main content -->
        @yield('main-content')
        
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer text-center">
        <!-- Default to the left -->
        <strong>@lang('home.copy_right')&copy; {{ date('Y') }} <a href="#">@lang('home.company_name')</a>.</strong> @lang('home.all_rights')
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity
            </h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class="control-sidebar-menu">
              <li>
                <a href="javascript::;">
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked>
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    
    <script>
      $(function () {
      
       // CKEDITOR.replace('content_en');
       // CKEDITOR.replace('content_ar');

       // $(".textarea").wysihtml5();
        $('#report').DataTable( {
            dom: 'lBfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            aLengthMenu: [
            [5, 10, 15, 20,25, -1],
            [5, 10, 15, 20,25, "All"]
        ],
        iDisplayLength: 10
        } );
        $('.report').DataTable( {
            dom: 'lBfrtip',
            
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ],
            aLengthMenu: [
            [5, 10, 15, 20,25, -1],
            [5, 10, 15, 20,25, "All"]
        ],
        iDisplayLength: 10
        } );
        $('#actors').DataTable({
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": false,
          "autoWidth": false
         });

        $('table').DataTable(); 
      });
    </script>


  </body>
</html>
