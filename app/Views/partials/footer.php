<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->

<footer class="bg-gray">
    <div class="container m-3 p-3">
        <div class="row">
            <!-- Kolom 1 -->
            <div class="col-lg-8">
                <h5 class="text-white">Lorem Ipsum</h5>
                <p class="text-white">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </p>
            </div>

            <!-- Kolom 2 -->
            <div class="col-lg-2">
                <h5 class="text-white">Company</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">Home</a></li>
                    <li><a href="#" class="text-white">About</a></li>
                    <li><a href="#" class="text-white">Contact</a></li>
                </ul>
            </div>

            <!-- Kolom 3 -->
            <div class="col-lg-2">
                <h5 class="text-white">Support</h5>
                <ul class="list-unstyled">
                    <li><a href="#" class="text-white">Home</a></li>
                    <li><a href="#" class="text-white">About</a></li>
                    <li><a href="#" class="text-white">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
        Carpe Diem
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?= date('Y'); ?> <a href="<?= base_url(); ?>">AHP</a>.</strong> All rights reserved.
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?= base_url(); ?>public/assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url(); ?>public/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url(); ?>public/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url(); ?>public/assets/plugins/toastr/toastr.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url(); ?>public/assets/plugins/chart.js/Chart.min.js"></script>
<!-- ionic -->
<script src="https://unpkg.com/ionicons@latest/dist/ionicons.js"></script>
<!-- Sparkline -->
<script src="<?= base_url(); ?>public/assets/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?= base_url(); ?>public/assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url(); ?>public/assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url(); ?>public/assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url(); ?>public/assets/plugins/moment/moment.min.js"></script>
<script src="<?= base_url(); ?>public/assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url(); ?>public/assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url(); ?>public/assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url(); ?>public/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>public/assets/js/adminlte.min.js"></script>
<!-- BS-Stepper -->
<script src="<?= base_url(); ?>public/assets/plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url(); ?>public/assets/plugins/select2/js/select2.full.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url(); ?>public/assets/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url(); ?>public/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>public/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>public/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
</script>
<script>
    $(function() {
        bsCustomFileInput.init();
        //Date picker
        $('#reservationdatestart').datetimepicker({
            format: 'L'
        });
        $('#reservationdateend').datetimepicker({
            format: 'L'
        });
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
    });
</script>

<?= $this->renderSection('script') ?>
</body>

</html>