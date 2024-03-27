<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Upload Bukti Pembayaran</div>
                </div>
                <div class="card-body">
                    <div class="overlay-background" id="overlay-background">
                        <i class="fas fa-2x fa-sync fa-spin"></i>
                    </div>
                    <h5 class="text-muted font-weight-bold">
                        ID Pembelian <?= $data_pembelian['id'] ?>
                    </h5>
                    <div class="d-flex justify-content-between">
                        <div class="font-weight-normal">
                            Tanggal Pembelian
                        </div>
                        <div class="font-weight-bold">
                            <?= $data_pembelian['created_at'] ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div class="font-weight-normal">
                            Total Bayar
                        </div>
                        <div class="font-weight-bold">
                            <?= "Rp " . number_format($data_pembelian['total_harga'], 0, ',', '.'); ?>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="p-3 bg-light rounded">
                        <p>Untuk melanjutkan pembelian, harap segera lakukan pembayaran dengan mentransfer ke nomor rekening yang tertera.</p>
                        <ul>
                            <li><strong class="font-weight-bold">Rekening Mandiri A.n Syarif <br> 303042879123</strong></li>
                        </ul>
                    </div>
                    <hr class="my-2">
                    <form id="upload-bukti" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?= $data_pembelian['id'] ?>">
                        <div class="form-group">
                            <label for="exampleInputFile">Upload Foto Merek Baru</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="bukti_pembayaran" id="exampleInputFile1">
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
                                <a href="<?= base_url('/client/pesananku') ?>" class="btn btn-default">Kembali</a>
                            </div>
                            <div class="col-4">
                                <button id="submitButton" type="submit" class="btn btn-success float-right">Upload Bukti</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
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
        var formData = new FormData($('#upload-bukti')[0]);
        // Perform AJAX submission
        $.ajax({
            type: 'POST',
            url: '<?= base_url('/client/pesananku/do-upload') ?>',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                (response.res == "success") ?
                Toast.fire({
                        icon: 'success',
                        title: response.message
                    }):
                    Toast.fire({
                        icon: 'error',
                        title: response.message
                    });
                document.getElementById('overlay-background').style.display = 'none';
                // Redirect or other actions as neede
                setTimeout(function() {
                    // Redirect to a new page after successful form submission
                    window.location.href = '<?= base_url('/client/pesananku/') ?>';
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