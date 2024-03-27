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
                            <h3 class="card-title">Update Spesfikasi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="overlay-background" id="overlay-background">
                                <i class="fas fa-2x fa-sync fa-spin"></i>
                            </div>
                            <form id="update-spesifikasi" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="spesifikasi_id" value="<?= $data_spesifikasi['spesifikasi_id'] ?>">
                                <div class="form-group">
                                    <label for="id_merek">Jenis Spesifikasi</label>
                                    <select class="form-control select2bs4" name="jenis_spesifikasi" id="jenis_spesifikasi" style="width: 100%;">
                                        <option selected="selected">Pilih Jenis Spesifikasi</option>
                                        <option value="RAM" <?= ($data_spesifikasi['jenis_spesifikasi'] == "RAM") ? "selected" : null ?>>RAM</option>
                                        <option value="ROM" <?= ($data_spesifikasi['jenis_spesifikasi'] == "ROM") ? "selected" : null ?>>ROM</option>
                                        <option value="Kamera" <?= ($data_spesifikasi['jenis_spesifikasi'] == "Kamera") ? "selected" : null ?>>Kamera</option>
                                        <option value="Baterai" <?= ($data_spesifikasi['jenis_spesifikasi'] == "Baterai") ? "selected" : null ?>>Baterai</option>
                                        <option value="Chipset" <?= ($data_spesifikasi['jenis_spesifikasi'] == "Chipset") ? "selected" : null ?>>Chipset</option>
                                        <option value="Fitur Tambahan" <?= ($data_spesifikasi['jenis_spesifikasi'] == "Fitur Tambahan") ? "selected" : null ?>>Fitur Tambahan</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama_merek">Nilai Spesifikasi</label>
                                    <input type="text" class="form-control" id="nilai_spesifikasi" name="nilai_spesifikasi" value="<?= $data_spesifikasi['nilai_spesifikasi'] ?>">
                                </div>
                                <div class="row mt-4">
                                    <div class="col-8">
                                        <a href="<?= base_url('/admin/data-perangkat') ?>" class="btn btn-default">Kembali</a>
                                    </div>
                                    <div class="col-4">
                                        <button id="submitButton" type="submit" class="btn btn-success float-right">Update Data</button>
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
    // LINK another function
    $(document).ready(function() {
        bsCustomFileInput.init();
    })
    // LINK Submit Form
    $('form').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission
        // Check if the clicked button is the submit button
        document.getElementById('overlay-background').style.display = 'flex';
        // Perform your form submission logic here
        // For example, you can use AJAX to submit the form data
        var formData = new FormData($('#update-spesifikasi')[0]);
        // Perform AJAX submission
        $.ajax({
            type: 'POST',
            url: '<?= base_url('/admin/data-spesifikasi/update-spesifikasi') ?>',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                document.getElementById('overlay-background').style.display = 'none';
                (response.res == "success") ?
                Toast.fire({
                        icon: 'success',
                        title: response.message
                    }):
                    Toast.fire({
                        icon: 'error',
                        title: response.message
                    });
                // Redirect or other actions as needed
                setTimeout(function() {
                    // Redirect to a new page after successful form submission
                    window.location.href = '<?= base_url('/admin/data-spesifikasi/') . $data_spesifikasi['perangkat_id'] ?>';
                }, 2000); // 2000 milliseconds = 2 seconds
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.responseText;
                document.getElementById('overlay-background').style.display = 'none';
                console.log(errorMessage);
                toastr.error(errorMessage);
            }
        });
    });
</script>

<?= $this->endSection() ?>