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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <a href=" <?= base_url('admin/order-data/') ?>" class="btn btn-default">Kembali</a>
                            <!-- <button id="submitButton" type="submit" class="ml-auto btn btn-success float-right">Simpan Data</button> -->
                        </div>
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-4 mb-3">Nama Pembeli</dt>
                                <dd class="col-sm-8"><?= $data_pembelian['nama_lengkap'] ?></dd>
                                <dt class="col-sm-4 mb-3">Nomor Telpon</dt>
                                <dd class="col-sm-8"><?= $data_pembelian['nomor_telpon'] ?></dd>
                                <dt class="col-sm-4">Email</dt>
                                <dd class="col-sm-8"><?= $data_pembelian['email'] ?></dd>
                                <dt class="col-sm-4">Bukti Pembayaran</dt>
                                <dd class="col-sm-8"><img src="<?= base_url('public/uploads/' . $data_pembelian['bukti_pembayaran']) ?>" alt=""></dd>
                            </dl>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <?php foreach ($data_checkout as $data) : ?>
                                <div class="media d-flex align-items-center">
                                    <img src="<?= base_url('public/uploads/') . (isset($data['gambar']) ? $data['gambar'] : 'default.jpg') ?>" alt="User Avatar" class="img-size-50 mr-2 ml-0">
                                    <div class="media-body">
                                        <h3 class="dropdown-item-title">
                                            <?= $data['nama_perangkat'] ?>
                                            <span class="float-right text-sm text-muted font-weight-bold">
                                                <?= "Rp " . number_format($data['harga'], 0, ',', '.'); ?>
                                            </span>
                                        </h3>
                                        <p class="text-sm badge badge-warning">
                                            <?= $data['quantity'] ?> Unit
                                        </p>
                                    </div>
                                </div>
                                <?php if ($data !== end($data_checkout)) : ?>
                                    <hr class="mb-2">
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <hr class="mb-4">
                            <dl class="row">
                                <dt class="col-sm-4 mb-3">Total Bayar</dt>
                                <dd class="col-sm-8">
                                    <?= "Rp " . number_format($data_pembelian['total_harga'], 0, ',', '.'); ?>
                                </dd>
                                <dt class="col-sm-4 mb-3">Metode Pembayaran</dt>
                                <dd class="col-sm-8"><?= $data_pembelian['metode_pembayaran'] ?></dd>
                                <dt class="col-sm-4">Status Pembayaran</dt>
                                <dd class="col-sm-8">
                                    <span class="badge <?= (($data_pembelian['status_pembayaran'] == "Proses Kirim") || $data_pembelian['status_pembayaran'] == "Barang Diterima") ? 'badge-success' : 'badge-danger' ?>"><?= $data_pembelian['status_pembayaran'] ?>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?= $this->endSection() ?>