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
                            <h3 class="card-title font-weight-bold">Daftar <?= $title ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th>Nama Pembeli</th>
                                        <th>Total Pembelian</th>
                                        <th>Tanggal Pembelian</th>
                                        <th>Status Pembayaran</th>
                                        <th style="width: 20%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($data_pembelian as $data) : ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $data['nama_lengkap'] ?></td>
                                            <td><?= "Rp " . number_format($data['total_harga'], 0, ',', '.'); ?></td>
                                            <td><?= $data['tanggal_pembelian'] ?></td>
                                            <td><span class="badge <?= (($data['status_pembayaran'] == "Proses Kirim") || $data['status_pembayaran'] == "Barang Diterima") ? 'badge-success' : 'badge-danger' ?>"><?= $data['status_pembayaran'] ?></span></td>
                                            <td>
                                                <div class="btn-group ml-auto">
                                                    <a href="<?= base_url('/admin/order-data/detail/' . $data['checkout_id']) ?>" class="btn btn-primary">
                                                        <i class="fas fa-search"></i>
                                                    </a>
                                                    <?php if ($data['status_pembayaran'] == "Menunggu Verifikasi Admin") : ?>
                                                        <button type="button" data-id="<?= $data['checkout_id'] ?>" data-jenis="tolak" class="verifikasi-pembelian btn btn-danger">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                        <button type="button" data-id="<?= $data['checkout_id'] ?>" data-jenis="terima" class="verifikasi-pembelian btn btn-success">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    <?php endif ?>
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
        $('.verifikasi-pembelian').on('click', function() {
            var id = $(this).data('checkout_id');
            var jenis = $(this).data('jenis');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan tindakan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Verifikasi Data data!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url('/admin/order-data/verif/') ?>' + id + '?jenis=' + jenis,
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