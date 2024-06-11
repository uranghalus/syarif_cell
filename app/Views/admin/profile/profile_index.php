<?= $this->extend('layouts/admin_layout') ?>

<?= $this->section('content') ?>

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
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h4>Update <?= $title ?></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="overlay-background" id="overlay-background">
                                <i class="fas fa-2x fa-sync fa-spin"></i>
                            </div>
                            <form id="update-profile" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= session()->get('id') ?>">
                                <div class="form-group">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= $user_data['nama_lengkap'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="<?= $user_data['email'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="username">Email</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?= $user_data['username'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="nomor_telpon">Telpon</label>
                                    <input type="text" class="form-control" id="nomor_telpon" name="nomor_telpon" value="<?= $user_data['nomor_telpon'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $user_data['alamat'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="old_password">Password Lama</label>
                                    <input type="password" class="form-control" id="old_password" name="old_password">
                                </div>
                                <div class="form-group">
                                    <label for="new_password">Password Baru</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password">
                                </div>
                                <div class="row mt-4">
                                    <div class="col-8">
                                        <a href="<?= base_url('/admin/dashboard') ?>" class="btn btn-default">Kembali</a>
                                    </div>
                                    <div class="col-4">
                                        <button id="submitButton" type="submit" class="btn btn-success float-right">Update Profile</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script>
    $('form').submit(function(e) {
        e.preventDefault(); // Prevent the default form submission
        // Check if the clicked button is the submit button
        document.getElementById('overlay-background').style.display = 'flex';
        // Perform your form submission logic here
        // For example, you can use AJAX to submit the form data
        var formData = new FormData($('#update-profile')[0]);
        // Perform AJAX submission
        $.ajax({
            type: 'POST',
            url: '<?= base_url('/admin/profile/update') ?>',
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
                // Redirect or other actions as needed
                setTimeout(function() {
                    // Redirect to a new page after successful form submission
                    window.location.href = '<?= base_url('/admin/profile') ?>';
                }, 2000); // 2000 milliseconds = 2 seconds
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.responseText;
                document.getElementById('overlay-background').style.display = 'none';
                console.log(errorMessage);
                Toast.fire({
                    icon: 'error',
                    title: errorMessage
                });
            }
        });
    });
</script>
<?= $this->endSection() ?>