<footer class="main-footer">
  <div class="float-right d-none d-sm-block">
    <b>Version</b> 1.0.0
  </div>
  <strong>Copyright &copy; <?= date('Y'); ?> <a href="<?= base_url(); ?>"><?= _SITENAME; ?></a>.</strong> All rights reserved.
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

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
<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>public/assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url(); ?>public/assets/plugins/chart.js/Chart.min.js"></script>
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
<!-- overlayScrollbars -->
<script src="<?= base_url(); ?>public/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url(); ?>public/assets/js/adminlte.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url(); ?>public/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>public/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>public/assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url(); ?>public/assets/plugins/select2/js/select2.full.min.js"></script>
<script>
  var Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
</script>
<?= $this->renderSection('script') ?>
<script>
  $(document).ready(function() {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
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
</body>

</html>