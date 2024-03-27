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
                        </div>
                        <div class="card-body">
                            <?php if (empty($data_spesifikasi)) : ?>
                                <p class="text-center font-weight-bold text-muted">Spesifikasi Tidak Ada</p>
                            <?php else : ?>
                                <dl class="row">
                                    <?php foreach ($data_spesifikasi as $spesifikasi) : ?>
                                        <dt class="col-sm-4 mb-3"><?= $spesifikasi['jenis_spesifikasi'] ?></dt>
                                        <dd class="col-sm-8"><?= $spesifikasi['nilai_spesifikasi'] ?></dd>
                                    <?php endforeach ?>
                                </dl>
                            <?php endif; ?>
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