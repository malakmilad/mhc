<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
  <head>
    <meta charset="UTF-8">
    <title> دي سي اس | <?php echo $__env->yieldContent('pagetitle'); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo e(asset('adminstylenew/plugins/fontawesome-free/css/all.min.css')); ?>">
 <!-- <link rel="stylesheet" href="<?php echo e(asset('adminstylenew/plugins/fontawesome-free/css/font-awesome.css')); ?>">-->
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo e(asset('adminstylenew/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')); ?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo e(asset('adminstylenew/plugins/icheck-bootstrap/icheck-bootstrap.min.css')); ?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo e(asset('adminstylenew/plugins/jqvmap/jqvmap.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('adminstylenew/dist/css/adminlte.min.css')); ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo e(asset('adminstylenew/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')); ?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo e(asset('adminstylenew/plugins/daterangepicker/daterangepicker.css')); ?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo e(asset('adminstylenew/plugins/summernote/summernote-bs4.min.css')); ?>">
  <!-- jQuery -->
 <script src="<?php echo e(asset('adminstyle/plugins/jQuery/jQuery-2.1.4.min.js')); ?>"></script>
 <!--<script src="<?php echo e(asset('adminstylenew/plugins/jquery/jquery.min.js')); ?>"></script>-->
 
 <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

  <script src="<?php echo e(asset('adminstylenew/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
  
  
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('adminstyle/plugins/jQueryUI/jquery-ui.min.js')); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<!--<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>-->
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('adminstylenew/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo e(asset('adminstylenew/plugins/chart.js/Chart.min.js')); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo e(asset('adminstylenew/plugins/sparklines/sparkline.js')); ?>"></script>
<!-- JQVMap -->
<script src="<?php echo e(asset('adminstylenew/plugins/jqvmap/jquery.vmap.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminstylenew/plugins/jqvmap/maps/jquery.vmap.usa.js')); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo e(asset('adminstylenew/plugins/jquery-knob/jquery.knob.min.js')); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo e(asset('adminstylenew/plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('adminstylenew/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo e(asset('adminstylenew/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
<!-- Summernote -->
<script src="<?php echo e(asset('adminstylenew/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo e(asset('adminstylenew/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('adminstylenew/dist/js/adminlte.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="<?php echo e(asset('adminstylenew/dist/js/pages/dashboard.js')); ?>"></script>
 <link rel="stylesheet" href="<?php echo e(asset('adminstyle/plugins/datatables/jquery.dataTables.css')); ?>">
  
 <link rel="stylesheet" href="<?php echo e(asset('adminstyle/plugins/datatables/dataTables.bootstrap.css')); ?>">
     <script src="<?php echo e(asset('adminstyle/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>-->
 
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.1/css/buttons.dataTables.min.css">
<script type="text/javascript" language="javascript" src="<?php echo e(asset('adminstylenew/plugins/datatables-buttons/js/dataTables.buttons.min.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('adminstylenew/plugins/jszip/jszip.min.js')); ?>"></script>

<script type="text/javascript" language="javascript" src="<?php echo e(asset('adminstylenew/plugins/datatables-buttons/js/buttons.flash.min.js')); ?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo e(asset('adminstylenew/plugins/datatables-buttons/js/buttons.html5.min.js')); ?>"></script>
<script type="text/javascript" language="javascript" src="<?php echo e(asset('adminstylenew/plugins/datatables-buttons/js/buttons.print.min.js')); ?>"></script>

<script type="text/javascript" language="javascript" src="<?php echo e(asset('adminstylenew/plugins/pdfmake/pdfmake.min.js')); ?>"></script>
<script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.50/vfs_fonts.js')}}"></script>
   
</head>
  
  <body class="hold-transition sidebar-mini layout-fixed sidebar-collapse">
    

      <?php echo $__env->make('admin.adminPartials.topheader', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <!-- Left side column. contains the logo and sidebar -->
   
      <?php echo $__env->make('admin.adminPartials.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <?php echo $__env->yieldContent('contentheader'); ?>
        <!-- Main content -->
        <?php echo $__env->yieldContent('main-content'); ?>
        
      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
      <footer class="main-footer text-center">
        <!-- Default to the left -->
        <strong><?php echo app('translator')->getFromJson('home.copy_right'); ?>&copy; <?php echo e(date('Y')); ?> <a href="#"><?php echo app('translator')->getFromJson('home.company_name'); ?></a>.</strong> <?php echo app('translator')->getFromJson('home.all_rights'); ?>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark elevation-4">
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


    
    <script>
      $(function () {
        $('#report').DataTable( {
            dom: 'lBfrtip',
          //  'bSort': false,
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
          "paging": true,
          "lengthChange": false,
          "searching": false,
          'bSort': false,
         // "ordering": true,
          "info": false,
          "autoWidth": false
         });

        $('table').DataTable(); 
      });
    </script>
<script>
  $(function () {
    $(".reportorder").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#reportorder .col-md-6:eq(0)');
    $('#reportorder').DataTable({
     "paging": true,
      "lengthChange": false,
      "searching": false,
     // "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

  </body>
</html>
