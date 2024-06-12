<?php $role = session()->get('role'); ?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="<?= base_url(); ?>public/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light"><?= _SITENAME; ?></span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="https://gravatar.com/avatar/avatar4.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="<?= base_url('/admin/profile') ?>" class="d-block"><?= session()->email ?></a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="<?= ($role == "admin") ? base_url('/admin/dashboard') : base_url('/client/dashboard') ?>" class="nav-link <?= $pagetitle == 'Dashboard Admin' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <?php if ($role == "admin") : ?>
          <li class="nav-item <?= $pagetitle == 'Master Data' ? 'menu-open' : '' ?> ">
            <a href="#" class="nav-link <?= $pagetitle == 'Master Data' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-database"></i>
              <p>
                Master Data
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url(); ?>admin/data-merek" class="nav-link <?= $title == 'Master Data Merek' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Merek</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>admin/data-perangkat" class="nav-link <?= $title == 'Master Data Perangkat' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Perangkat</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="<?= base_url(); ?>admin/order-data" class="nav-link <?= $pagetitle == 'Data Pembelian' ? 'active' : '' ?>">
              <i class="nav-icon far fa-hourglass"></i>
              <p>
                Data Pembelian
              </p>
            </a>
          </li>
          <li class="nav-item <?= $pagetitle == 'Report' ? 'menu-open' : '' ?> ">
            <a href="#" class="nav-link <?= $pagetitle == 'Report' ? 'active' : '' ?>">
              <i class="nav-icon fas fa-file"></i>
              <p>
                Report
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= base_url(); ?>admin/report/data-smartphone" class="nav-link <?= $title == 'Report Smartphone' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Smartphone</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url(); ?>admin/report/data-pembelian" class="nav-link <?= $title == 'Report Pembelian' ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Data Pembelian</p>
                </a>
              </li>
            </ul>
          </li>
        <?php elseif ($role == "client") : ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Pembelian Ku
              </p>
            </a>
          </li>
        <?php endif ?>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>