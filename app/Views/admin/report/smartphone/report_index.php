<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm">
                    <h1><?= $title ?></h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?= $title ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="overlay-background" id="overlay-background">
                                <i class="fas fa-2x fa-sync fa-spin"></i>
                            </div>

                            <form id="create-report" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Jenis Laporan</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_laporan" id="laporan_per" value="per" checked>
                                        <label class="form-check-label" for="laporan_per">
                                            Laporan Per
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_laporan" id="laporan_rekapitulasi" value="rekapitulasi">
                                        <label class="form-check-label" for="laporan_rekapitulasi">
                                            Laporan Rekapitulasi
                                        </label>
                                    </div>
                                </div>

                                <div id="form-per" style="display:none;">
                                    <div class="form-group">
                                        <label>Merek</label>
                                        <select name="merek" class="form-control">
                                            <?php foreach ($data_merek as $merek) : ?>
                                                <option value="<?= $merek['id_merek'] ?>"><?= $merek['nama_merek'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Tahun Rilis</label>
                                        <div class="input-group date" id="tahun_rilis" data-target-input="nearest">
                                            <input type="text" name="tahun_rilis" class="form-control datetimepicker-input" data-target="#tahun_rilis" />
                                            <div class="input-group-append" data-target="#tahun_rilis" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="form-rekapitulasi" style="display:none;">
                                    <div class="form-group">
                                        <label>Tanggal Mulai</label>
                                        <input type="date" name="tanggal_mulai" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Tanggal Selesai</label>
                                        <input type="date" name="tanggal_selesai" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="ml-auto">
                                        <button id="submitButton" type="submit" class="btn btn-success float-right">Tampilkan Data</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>

<!--LINK JS -->
<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $('#tahun_rilis').datetimepicker({
            format: 'Y'
        });

        function showForm() {
            if ($('#laporan_per').is(':checked')) {
                $('#form-per').show();
                $('#form-rekapitulasi').hide();
            } else if ($('#laporan_rekapitulasi').is(':checked')) {
                $('#form-per').hide();
                $('#form-rekapitulasi').show();
            }
        }

        // Memanggil fungsi showForm saat halaman dimuat
        showForm();
        // Memeriksa perubahan pada radio button
        $('input[name="jenis_laporan"]').change(function() {
            showForm();
        });
        // LINK Submit Form
        $('form').submit(function(e) {
            e.preventDefault(); // Prevent the default form submission
            // Check if the clicked button is the submit button
            document.getElementById('overlay-background').style.display = 'flex';
            // Perform your form submission logic here
            // For example, you can use AJAX to submit the form data
            var formData = new FormData($('#create-report')[0]);
            // Perform AJAX submission
            $.ajax({
                type: 'POST',
                url: '<?= base_url('/admin/report/cetak-laporan-smartphone') ?>',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    document.getElementById('overlay-background').style.display = 'none';
                    var file = new Blob([response], {
                        type: 'application/pdf'
                    });
                    var fileURL = URL.createObjectURL(file);
                    window.open(fileURL);
                    // (response.res == "success") ?
                    // Toast.fire({
                    //         icon: 'success',
                    //         title: response.message
                    //     }):
                    //     Toast.fire({
                    //         icon: 'error',
                    //         title: response.message
                    //     });
                    // // Redirect or other actions as needed
                    // setTimeout(function() {
                    //     // Redirect to a new page after successful form submission
                    //     window.location.href = '<?= base_url('/admin/data-merek') ?>';
                    // }, 2000); // 2000 milliseconds = 2 seconds
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.responseText;
                    document.getElementById('overlay-background').style.display = 'none';
                    console.log(errorMessage);
                    toastr.error(errorMessage);
                }
            });
        });
    })
</script>

<?= $this->endSection() ?>