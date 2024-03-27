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
                        <div class="card-body">
                            <a href="<?= base_url('/admin/data-perangkat') ?>" class="btn btn-warning">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Perangkat</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <dl class="row">
                                        <dt class="col-sm-4 mb-3">Nama Perangkat</dt>
                                        <dd class="col-sm-8"><?= $data_perangkat['nama_perangkat'] ?></dd>
                                        <dt class="col-sm-4 mb-3">Merek Perangkat</dt>
                                        <dd class="col-sm-8"><?= $data_perangkat['nama_merek'] ?></dd>
                                        <dt class="col-sm-4 mb-3">Harga</dt>
                                        <dd class="col-sm-8">Rp. <?= $data_perangkat['harga'] ?></dd>
                                        <dt class="col-sm-4 mb-3">Stok</dt>
                                        <dd class="col-sm-8"><?= $data_perangkat['stok'] ?> Pcs</dd>
                                    </dl>
                                </div>
                                <div class="col-6">
                                    <?php if ($data_perangkat['gambar']) : ?>
                                        <img src="<?= base_url('public/uploads/' . $data_perangkat['gambar']) ?>" class="float-right" alt="<?= $data_perangkat['nama_perangkat'] ?>" width="120">
                                    <?php else : ?>
                                        No Image
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Spesifikasi Perangkat</h3>
                            <div class="card-tools">
                                <a href="<?= base_url('/admin/data-spesifikasi/create-spesifikasi/') . $data_perangkat['perangkat_id'] ?>" class="btn btn-primary">Add New</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th>Jenis Spesifikasi</th>
                                        <th>Nilai Spesifikasi</th>
                                        <th style="width: 15%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($data_spesifikasi as $spesifikasi) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $spesifikasi['jenis_spesifikasi'] ?></td>
                                            <td><?= $spesifikasi['nilai_spesifikasi'] ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="<?= base_url('/admin/data-spesifikasi/edit/' . $spesifikasi['spesifikasi_id']) ?>" class="btn btn-warning" title="Edit Data">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" id="delete-spesifikasi" data-id="<?= $spesifikasi['spesifikasi_id'] ?>" class="btn btn-danger" title="Delete Data">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
        $('#delete-spesifikasi').on('click', function() {
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
                        url: '<?= base_url('/admin/data-spesifikasi/delete/') ?>' + id,
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