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
                            <h3 class="card-title">Create Merek</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="overlay-background" id="overlay-background">
                                <i class="fas fa-2x fa-sync fa-spin"></i>
                            </div>
                            <form id="create-merek" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nama_merek">Nama Merek</label>
                                    <input type="text" class="form-control" id="nama_merek" name="nama_merek" placeholder="Masukkan nama merek">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Upload Foto Merek</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" name="foto" id="exampleInputFile1">
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
                                        <a href="<?= base_url('/admin/data-merek') ?>" class="btn btn-default">Kembali</a>
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
        var formData = new FormData($('#create-merek')[0]);
        // Perform AJAX submission
        $.ajax({
            type: 'POST',
            url: '<?= base_url('/admin/data-merek/store') ?>',
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
                    window.location.href = '<?= base_url('/admin/data-merek') ?>';
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