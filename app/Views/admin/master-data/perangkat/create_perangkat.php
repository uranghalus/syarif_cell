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
                            <h3 class="card-title">Tambah Perangkat</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="overlay-background" id="overlay-background">
                                <i class="fas fa-2x fa-sync fa-spin"></i>
                            </div>
                            <form id="create-perangkat" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nama_perangkat">Nama Perangkat</label>
                                    <input type="text" class="form-control" id="nama_perangkat" name="nama_perangkat" placeholder="Masukkan nama merek">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="id_merek">Merek Perangkat</label>
                                            <select class="form-control select2bs4" id="id_merek" name="id_merek" style="width: 100%;">
                                                <option selected="selected">Silahkan Pilih</option>
                                                <?php foreach ($data_merek as $merek) : ?>
                                                    <option value="<?= $merek["id_merek"]; ?>"><?= $merek["nama_merek"]; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="tahun_rilis">Tahun Rilis</label>
                                            <input type="number" class="form-control" id="tahun_rilis" name="tahun_rilis" placeholder="Masukkan Tahun Rilis">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control" rows="3" name="deskripsi" placeholder="Enter ..."></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp</span>
                                                </div>
                                                <input type="text" name="harga" class="form-control">
                                                <div class="input-group-append">
                                                    <span class="input-group-text">.00</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="stok">Stok</label>
                                            <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan jumlah stok">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Upload Foto Perangkat</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="gambar" id="exampleInputFile1">
                                            <label class="custom-file-label" for="exampleInputFile1">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    <small class="form-text text-danger">
                                        Harap pastikan bahwa file yang diunggah adalah file JPG dengan ukuran maksimum 500KB.
                                    </small>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-8">
                                        <a href="<?= base_url('/admin/data-perangkat') ?>" class="btn btn-default">Kembali</a>
                                    </div>
                                    <div class="col-4">
                                        <button id="submitButton" type="submit" class="btn btn-success float-right">Simpan Data</button>
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
        var formData = new FormData($('#create-perangkat')[0]);
        // Perform AJAX submission
        $.ajax({
            type: 'POST',
            url: '<?= base_url('/admin/data-perangkat/store') ?>',
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
                    window.location.href = '<?= base_url('/admin/data-perangkat') ?>';
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