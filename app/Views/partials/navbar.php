  <!-- Navbar -->
  <?php $isLoggedIn = session()->get('logged_in') ?>
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
      <div class="container">
          <a href="../../index3.html" class="navbar-brand">
              <img src="<?= base_url(); ?>public/assets/img/AdminLTELogo.png" class="brand-image img-circle elevation-3" style="opacity: .8">
              <span class="brand-text font-weight-light"><?= _SITENAME ?></span>
          </a>

          <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse order-3" id="navbarCollapse">
              <!-- Left navbar links -->
              <ul class="navbar-nav">
                  <li class="nav-item">
                      <a href="<?= base_url(); ?>" class="nav-link">Home</a>
                  </li>
                  <li class="nav-item">
                      <a href="<?= base_url('galery-smartphone'); ?>" class="nav-link">Galeri Smartphone</a>
                  </li>
                  <?php if ($isLoggedIn) : ?>
                      <li class="nav-item">
                          <a href="<?= base_url(); ?>client/pesananku" class="nav-link">Pesananku</a>
                      </li>
                  <?php endif ?>
              </ul>

              <!-- SEARCH FORM -->
              <!-- <form class="form-inline ml-0 ml-md-3">
                  <div class="input-group input-group-sm">
                      <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                      <div class="input-group-append">
                          <button class="btn btn-navbar" type="submit">
                              <i class="fas fa-search"></i>
                          </button>
                      </div>
                  </div>
              </form> -->
          </div>

          <!-- Right navbar links -->
          <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
              <?php if (!$isLoggedIn) : ?>
                  <li class="nav-item">
                      <a href="<?= base_url("auth/login"); ?>" class="nav-link">Login</a>
                  </li>
                  <li class="nav-item">
                      <a href="<?= base_url("auth/register"); ?>" class="nav-link btn btn-sm btn-success">Signup</a>
                  </li>
              <?php elseif ($isLoggedIn) : ?>
                  <!-- Messages Dropdown Menu -->
                  <li class="nav-item dropdown">
                      <a class="nav-link" data-toggle="dropdown" href="#">
                          <i class="fas fa-shopping-cart"></i>
                          <?= ($count_cart) ? '<span class="badge badge-danger navbar-badge">' . $count_cart . '</span>' : null ?>
                      </a>
                      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                          <a href="#" class="dropdown-item">
                              <!-- Message Start -->
                              <?php if (!$count_cart) : ?>
                                  <div class="media">
                                      <p class="text-gray font-weight-bold text-center">Tidak Ada Data</p>
                                  </div>
                              <?php else : ?>
                                  <?php foreach ($cart_data as $data) : ?>
                                      <div class="media">
                                          <img src="<?= base_url('public/uploads/' . $data['gambar']) ?>" alt="User Avatar" class="img-size-50 mr-3">
                                          <div class="media-body">
                                              <h3 class="dropdown-item-title">
                                                  <?= $data['nama_perangkat'] ?>
                                                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                              </h3>
                                              <p class="text-sm font-weight-bold"><?= "Rp " . number_format($data['harga'], 0, ',', '.'); ?></p>
                                              <p class="text-sm"><?= $data['quantity'] ?> Unit</p>
                                          </div>
                                      </div>
                                  <?php endforeach ?>
                              <?php endif ?>
                              <!-- Message End -->
                          </a>
                          <div class="dropdown-divider"></div>
                          <a href="<?= base_url('client/checkout') ?>" class="dropdown-item dropdown-footer">Checkout</a>
                      </div>
                  </li>
                  <!-- Notifications Dropdown Menu -->
                  <li class="nav-item dropdown">
                      <a class="nav-link" data-toggle="dropdown" href="#">
                          <i class="far fa-bell"></i>
                          <span class="badge badge-warning navbar-badge">15</span>
                      </a>
                      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                          <span class="dropdown-header">15 Notifications</span>
                          <div class="dropdown-divider"></div>
                          <a href="#" class="dropdown-item">
                              <i class="fas fa-envelope mr-2"></i> 4 new messages
                              <span class="float-right text-muted text-sm">3 mins</span>
                          </a>
                          <div class="dropdown-divider"></div>
                          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                      </div>
                  </li>
                  <li class="nav-item dropdown">
                      <a id="dropdownUser" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">

                          <img src="https://gravatar.com/avatar/avatar4.png" class="img-circle img-fluid" style="height:100%">

                      </a>
                      <ul aria-labelledby="dropdownUser" class="dropdown-menu border-0 shadow">
                          <li><a href="" class="dropdown-item">User : <strong><?= session()->get('name') ?></strong></a></li>
                          <li class="dropdown-divider"></li>
                          <li><a href="<?= base_url('client/profile'); ?>" class="dropdown-item">Profile</a></li>
                          <li><a href="<?= base_url('auth/logout'); ?>" class="dropdown-item">Logout</a></li>
                      </ul>
                  </li>
              <?php endif ?>
          </ul>
      </div>
  </nav>
  <!-- /.navbar -->