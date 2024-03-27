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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title font-weight-bold">Daftar Merek</h3>
                            <div class="card-tools">
                                <a href="<?= base_url('/admin/data-merek/create') ?>" class="btn btn-primary">Add New</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th style="width: 20%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($data_merek as $merek) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $merek['nama_merek'] ?></td>
                                            <td>
                                                <?php if ($merek['foto']) : ?>
                                                    <img src="<?= base_url('public/uploads/' . $merek['foto']) ?>" alt="<?= $merek['nama_merek'] ?>" class="img-thumbnail" width="100">
                                                <?php else : ?>
                                                    No Image
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('/admin/data-merek/edit/' . $merek['id_merek']) ?>" class="btn btn-warning">Edit</a>
                                                <button class="btn btn-danger" id="delete-merek" data-id="<?= $merek['id_merek'] ?>">Hapus</button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
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
        $('#delete-merek').on('click', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan tindakan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus data!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url('/admin/data-merek/delete/') ?>' + id,
                        method: 'GET',
                        success: function(response) {
                            var data = response;
                            (data.res == "success") ?
                            Toast.fire({
                                    icon: 'success',
                                    title: data.message
                                }).then(() => {
                                    location.reload();
                                }):
                                Toast.fire({
                                    icon: 'error',
                                    title: data.message
                                }).then(() => {
                                    location.reload();
                                });
                        }
                    });
                }
            });
        });
    });
</script>
<?= $this->endSection() ?>