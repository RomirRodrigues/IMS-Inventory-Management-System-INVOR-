<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo base_url('') ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>Inv</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Inventory System</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Multi-Language Switcher -->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-globe"></i> Language <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url('language/switchLang/english'); ?>">🇬🇧 English</a></li>
              <li><a href="<?php echo base_url('language/switchLang/spanish'); ?>">🇪🇸 Español</a></li>
              <li><a href="<?php echo base_url('language/switchLang/french'); ?>">🇫🇷 Français</a></li>
              <li><a href="<?php echo base_url('language/switchLang/hindi'); ?>">🇮🇳 हिन्दी</a></li>
            </ul>
          </li>
          <!-- Notifications: Low Stock -->
          <li class="dropdown notifications-menu">
            <a href="<?php echo base_url('products'); ?>" title="Low Stock Alerts">
              <i class="fa fa-bell-o"></i>
              <?php if(isset($low_stock_count) && $low_stock_count > 0): ?>
                <span class="label label-warning"><?php echo $low_stock_count; ?></span>
              <?php endif; ?>
            </a>
          </li>
          <li>
            <a href="<?php echo base_url('auth/logout'); ?>" title="Logout">
              <i class="glyphicon glyphicon-log-out"></i> Logout
            </a>
          </li>
        </ul>
      </div>

    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  