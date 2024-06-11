<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= base_url(); ?>" class="nav-link">Frontpage</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" id="notificationDropdown">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge" id="notificationCount">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header" id="notificationHeader">0 Notifications</span>
                <div class="dropdown-divider"></div>
                <div id="notificationList">
                    <!-- Notifikasi akan dimuat di sini -->
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a href="<?= base_url('/auth/logout'); ?>" class="nav-link">
                <i class="fas fa-sign-out-alt mr-1"></i>
                Logout
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->