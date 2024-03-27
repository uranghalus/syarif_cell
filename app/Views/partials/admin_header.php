<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= _SITENAME . " - " . $title; ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- flag icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lipis/flag-icons@7.0.0/css/flag-icons.min.css" />
    <!-- end of flag icon -->
    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/assets/plugins/toastr/toastr.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/assets/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/assets/plugins/daterangepicker/daterangepicker.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>public/assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>public/assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>public/assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>public/assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <?= $this->renderSection('style') ?>
    <style>
        /* Tambahkan ini di dalam tag <style> atau file CSS terpisah */
        .overlay-background {
            position: absolute;
            border-radius: 5px;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 999;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
    <div class="wrapper">