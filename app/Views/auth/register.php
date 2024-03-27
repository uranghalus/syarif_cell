<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= _SITENAME . " - " . $title ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><?= _SITENAME; ?></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>
                <?php if (session()->getFlashdata('error')) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php $errors = session()->getFlashdata('error'); ?>
                        <?php if (is_array($errors)) : ?>
                            <ul>
                                <?php foreach ($errors as $error) : ?>
                                    <li><?= esc($error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php else : ?>
                            <?= esc($errors) ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?= form_open('auth/storeregister') ?>
                <?= csrf_field() ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="username" placeholder="username">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="nomor_telpon" placeholder="Nomor Telpon">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3"><textarea name="alamat" class="form-control" rows="3" placeholder="Enter ..."></textarea></div>
                <div class="form-group">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" checked value="Laki-Laki">
                        <label class="form-check-label">Laki-Laki</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" value="Perempuan">
                        <label class="form-check-label">Perempuan</label>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" class="form-control" name="email" placeholder="Email">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" name="password_confirm" placeholder="Retype password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="icheck-primary">
                            <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                            <label for="agreeTerms">
                                I agree to the <a href="#">terms</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                        <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
                <?= form_close() ?>

                <a href="<?= base_url('auth/login') ?>" class="text-center">Sudah Punya Akun? Masuk Disini</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="<?= base_url(); ?>public/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url(); ?>public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url(); ?>public/assets/js/adminlte.min.js"></script>
</body>

</html>