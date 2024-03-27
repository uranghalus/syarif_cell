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
                            <h3 class="card-title font-weight-bold">Data <?= $title ?></h3>
                            <div class="card-tools">
                                <a href="<?= base_url('/admin/data-perangkat/create') ?>" class="btn btn-primary">Add New</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th>Name</th>
                                        <th>Merek</th>
                                        <th>Tahun Rilis</th>
                                        <th>Stok</th>
                                        <th style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($data_perangkat as $perangkat) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $perangkat['nama_perangkat'] ?></td>
                                            <td><?= $perangkat['nama_merek'] ?></td>
                                            <td><?= $perangkat['tahun_rilis'] ?></td>
                                            <td><?= $perangkat['stok'] ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                                        </button>
                                                        <div class="dropdown-menu">
                                                            <a class="dropdown-item" href="<?= base_url('/admin/data-perangkat/detail/' . $perangkat['perangkat_id']) ?>">Detail Data</a>
                                                            <a class="dropdown-item" href="<?= base_url('/admin/data-spesifikasi/' . $perangkat['perangkat_id']) ?>">Data Spesifikasi</a>
                                                        </div>
                                                    </div>
                                                    <a href="<?= base_url('/admin/data-perangkat/edit/' . $perangkat['perangkat_id']) ?>" class="btn btn-warning" title="Edit Data">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" id="delete-perangkat" data-id="<?= $perangkat['perangkat_id'] ?>" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
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
        $('#delete-perangkat').on('click', function() {
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
                        url: '<?= base_url('/admin/data-perangkat/delete/') ?>' + id,
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