<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-lg-12 mt-5">
            <?php foreach ($order_data as $data) : ?>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title font-weight-bold text-primary">ID Pemesanan <?= $data['id'] ?></h3>
                    </div>
                    <div class="card-body">
                        <?php foreach ($data['perangkat'] as $perangkat) : ?>
                            <div class="media d-flex align-items-center">
                                <img src="<?= base_url('public/uploads/' . $perangkat['gambar']) ?>" alt="User Avatar" class="img-size-50 mr-2 ml-0">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        <?= $perangkat['nama_perangkat'] ?>
                                        <span class="float-right text-sm text-muted font-weight-bold">
                                            <?= "Rp " . number_format($perangkat['harga'], 0, ',', '.'); ?>
                                        </span>
                                    </h3>
                                    <p class="text-sm badge badge-warning">
                                        <?= $perangkat['quantity'] ?> Unit
                                    </p>
                                </div>
                            </div>
                            <?php if ($data['perangkat'] !== end($perangkat)) : ?>
                                <hr class="mb-2">
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <div>
                            <small class="text-muted">Tanggal Pemesanan : <?= $data['created_at'] ?></small> <br>
                            <span class="badge <?= (($data['status_pembayaran'] == "Proses Kirim") || $data['status_pembayaran'] == "Barang Diterima") ? 'badge-success' : 'badge-danger' ?>"><?= $data['status_pembayaran'] ?></span>
                        </div>
                        <div class="btn-group ml-auto">
                            <?php if ($data['status_pembayaran'] == 'Proses Kirim') : ?>
                                <button type="button" id="konfirmasi-penerima" data-id="<?= $data['id'] ?>" class="btn btn-success">Konfirmasi Penerima</button>
                            <?php endif; ?>
                            <?php if (($data['metode_pembayaran'] == 'Transfer') && ($data['status_pembayaran'] == 'Belum Dibayar')) : ?>
                                <a href="<?= base_url('client/pesananku/upload-bukti/') . $data['id'] ?>" class="btn btn-info">
                                    Upload Bukti Transfer
                                </a>
                            <?php endif; ?>
                            <?php if ($data['metode_pembayaran'] == 'Transfer' && $data['status_pembayaran'] != 'Belum Dibayar' && $data['status_pembayaran'] != 'Barang Diterima') : ?>
                                <a href="<?= base_url('client/pesananku/bukti-pembayaran/') . $data['id'] ?>" class="btn btn-default">
                                    Lihat Bukti Transfer
                                </a>
                            <?php endif; ?>

                            <?php if ($data['status_pembayaran'] == 'Belum Dibayar') : ?>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#" id="hapus-pembelian" data-id="<?= $data['id'] ?>">Hapus Pesanan</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>


                    </div>
                </div>

            <?php endforeach ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<!--LINK JS -->
<?= $this->section('script') ?>
<script>
    $(document).ready(function() {
        $('#konfirmasi-penerima').on('click', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan tindakan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Konfirmasi Penerima!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url('/client/pesananku/konfirmasi/') ?>' + id,
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
        // LINK Hapus Pembelian
        $('#hapus-pembelian').on('click', function() {
            var id = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda tidak akan dapat mengembalikan tindakan ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus Pesanan!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url('/client/pesananku/delete/') ?>' + id,
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