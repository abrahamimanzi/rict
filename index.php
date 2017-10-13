<?php   
require_once 'core/init.php'; 
require_once 'app/controller.php'; 
if(!$session_user->isLoggedIn()){ 
	Redirect::to(DN.'/login');
}
?>

<!DOCTYPE html>
<html>
  <head>
	<?php include 'incl'._.'app_head_init'.PL;?>
  </head>
  <body class="hold-transition fixed skin-if sidebar-mini">
      <div id="app_data" data-dnadmin="<?=DN?>"></div>
    <div class="wrapper">

      <!-- Main Header -->
		<header class="main-header">
			<?php include 'views'._.'app_header'.PL;?>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			<?php include 'views'._.'app_left_sidebar'.PL;?>
		</aside>

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
		    <?php include 'views/routes'.PL;?>

      </div><!-- /.content-wrapper -->

      <!-- Main Footer -->
		<footer class="main-footer">
			<?php include 'views'._.'app_footer'.PL;?>
		</footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-light">
        <?php include 'views'._.'app_right_sidebar'.PL;?>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- AdminLTE App -->
    <script src="<?=DN?>/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?=DN?>/dist/js/app.min.js"></script>
    <script src="<?=DN?>/dist/js/pages/dashboard.js"></script>
    <script src="<?=DN?>/dist/js/demo.js"></script>
      
    <script type="text/javascript" src="<?=DN?>/plugins/redactor/redactor/redactor.js"></script>
    <script type="text/javascript" src="<?=DN?>/plugins/jasny_bootstrap/js/jasny-bootstrap.min.js"></script>

      <!-- jQuery Knob -->
      <script src="<?=DN?>/plugins/knob/jquery.knob.js"></script>
      
    <!-- Optionally, you can add Slimscroll and FastClick plugins.
         Both of these plugins are recommended to enhance the
         user experience. Slimscroll is required when using the
         fixed layout. -->
  </body>
</html>
