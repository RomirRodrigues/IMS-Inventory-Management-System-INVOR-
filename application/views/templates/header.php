<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $page_title; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->  
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap/dist/css/bootstrap.min.css') ?>">
  <!-- Font Awesome -->  
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/font-awesome/css/font-awesome.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/Ionicons/css/ionicons.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css') ?>">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/skins/_all-skins.min.css') ?>">
  <!-- Morris chart -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/morris.js/morris.css') ?>">
  <!-- jvectormap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/jvectormap/jquery-jvectormap.css') ?>">
  <!-- Date Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>">
  <!-- Daterange picker -->  
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css') ?>">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') ?>">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/bower_components/select2/dist/css/select2.min.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/fileinput/fileinput.min.css') ?>">

  <!-- icheck -->
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/iCheck/all.css') ?>">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- 21st.dev Inter Font & Iconify -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

  <!-- 21st.dev High-Tech Dark Theme Overlay -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/21stdev-theme.css') ?>">
  <!-- 21st.dev Live Hot-Sync & Motion Engine -->
  <script src="<?php echo base_url('assets/js/21stdev-live-sync.js') ?>"></script>

  <!-- jQuery 3 -->
  <script src="<?php echo base_url('assets/bower_components/jquery/dist/jquery.min.js') ?>"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="<?php echo base_url('assets/bower_components/jquery-ui/jquery-ui.min.js') ?>"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.7 -->
  <script src="<?php echo base_url('assets/bower_components/bootstrap/dist/js/bootstrap.min.js') ?>"></script>
  <!-- Morris.js charts -->
  <script src="<?php echo base_url('assets/bower_components/raphael/raphael.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/bower_components/morris.js/morris.min.js') ?>"></script>
  <!-- Sparkline -->
  <script src="<?php echo base_url('assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') ?>"></script>
  <!-- jvectormap -->
  <script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') ?>"></script>
  <!-- jQuery Knob Chart -->
  <script src="<?php echo base_url('assets/bower_components/jquery-knob/dist/jquery.knob.min.js') ?>"></script>
  <!-- daterangepicker -->
  <script src="<?php echo base_url('assets/bower_components/moment/min/moment.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js') ?>"></script>
  <!-- datepicker -->
  <script src="<?php echo base_url('assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') ?>"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="<?php echo base_url('assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') ?>"></script>
  <!-- Slimscroll -->
  <script src="<?php echo base_url('assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') ?>"></script>
  <!-- FastClick -->
  <script src="<?php echo base_url('assets/bower_components/fastclick/lib/fastclick.js') ?>"></script>
  <!-- Select2 -->
  <script src="<?php echo base_url('assets/bower_components/select2/dist/js/select2.full.min.js') ?>"></script>
  <!-- AdminLTE App -->  
  <script src="<?php echo base_url('assets/dist/js/adminlte.min.js') ?>"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="<?php echo base_url('assets/dist/js/pages/dashboard.js') ?>"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?php echo base_url('assets/dist/js/demo.js') ?>"></script>
  <script src="<?php echo base_url('assets/plugins/fileinput/fileinput.min.js') ?>"></script>

  <!-- ChartJS -->
  <script src="<?php echo base_url('assets/bower_components/Chart.js/Chart.js') ?>"></script>

  <!-- icheck -->
  <script src="<?php echo base_url('assets/plugins/iCheck/icheck.min.js') ?>"></script>

  <!-- DataTables -->
<script src="<?php echo base_url('assets/bower_components/datatables.net/js/jquery.dataTables.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') ?>"></script>



</head>
<body class="hold-transition skin-blue sidebar-mini">

<!-- 21st.dev High-Tech Welcome Loader Animation -->
<div id="nexus-welcome-overlay" style="position: fixed; inset: 0; z-index: 99999; background: #000000; display: flex; flex-direction: column; align-items: center; justify-content: center; transition: opacity 0.8s ease, transform 0.8s ease; pointer-events: auto;">
  <div style="position: absolute; inset: 0; opacity: 0.15; pointer-events: none; background-image: url('data:image/svg+xml,%3Csvg%20viewBox%3D%220%200%202%202%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%3E%3Crect%20width%3D%221%22%20height%3D%221%22%20fill%3D%22%23ffffff%22%2F%3E%3Crect%20x%3D%221%22%20y%3D%221%22%20width%3D%221%22%20height%3D%221%22%20fill%3D%22%23ffffff%22%2F%3E%3C%2Fsvg%3E'); background-size: 2px 2px;"></div>
  <div style="position: relative; margin-bottom: 24px;">
    <div style="width: 72px; height: 72px; border-radius: 20px; background: rgba(10,10,10,0.9); border: 1px solid rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: center; box-shadow: 0 0 35px rgba(56, 189, 248, 0.25);">
      <iconify-icon icon="solar:cpu-bolt-linear" width="36" height="36" style="color: #38bdf8;"></iconify-icon>
    </div>
    <div style="position: absolute; inset: -8px; border-radius: 24px; border: 1px solid rgba(56, 189, 248, 0.35); animation: nexusPulse 2s infinite ease-in-out;"></div>
  </div>
  <h2 id="nexus-loader-text" style="font-family: 'Inter', sans-serif; font-size: 18px; font-weight: 200; color: #ffffff; letter-spacing: 2.5px; text-transform: uppercase; margin: 0 0 16px 0;">
    INITIALIZING NEXUS GATEWAY...
  </h2>
  <div style="width: 240px; height: 3px; background: rgba(255, 255, 255, 0.1); border-radius: 4px; overflow: hidden; position: relative;">
    <div id="nexus-loader-bar" style="width: 0%; height: 100%; background: linear-gradient(90deg, #38bdf8, #34d399); transition: width 1.2s cubic-bezier(0.4, 0, 0.2, 1);"></div>
  </div>
  <p style="font-family: 'Inter', sans-serif; font-size: 11px; font-weight: 300; color: #64748b; letter-spacing: 1.5px; text-transform: uppercase; margin-top: 16px;">
    Inventory Intelligence Framework v2.0
  </p>
</div>

<style>
@keyframes nexusPulse {
  0%, 100% { transform: scale(1); opacity: 0.3; }
  50% { transform: scale(1.08); opacity: 0.7; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
  var overlay = document.getElementById('nexus-welcome-overlay');
  var bar = document.getElementById('nexus-loader-bar');
  var text = document.getElementById('nexus-loader-text');

  if (overlay && bar) {
    setTimeout(function() { bar.style.width = '60%'; }, 100);
    setTimeout(function() {
      if (text) text.innerText = 'LOADING INVENTORY INTELLIGENCE...';
      bar.style.width = '100%';
    }, 500);
    setTimeout(function() {
      if (text) text.innerText = 'SYSTEM READY';
      overlay.style.opacity = '0';
      overlay.style.transform = 'scale(1.03)';
      overlay.style.pointerEvents = 'none';
      setTimeout(function() { overlay.style.display = 'none'; }, 800);
    }, 1100);
  }
});
</script>

<div class="wrapper">

  