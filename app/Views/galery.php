<?php

use function App\Helpers\shorten_text;

helper('shorten');
?>
<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<!-- Content -->

<div class="container">
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Produk Baru </h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <div class="row">
        <!-- Product Card -->
        <?php foreach ($latest_perangkat as $produk) : ?>
            <div class="col-md-3">
                <div class="card">
                    <?php if ($produk['gambar']) : ?>
                        <div class="card-img-top bg-light" style="padding: 40px; width: 100%; height:250px">
                            <div class="text-center">
                                <img src="<?= base_url('public/uploads/' . $produk['gambar']) ?>" alt="<?= $produk['nama_perangkat'] ?>" width="120">
                            </div>
                        </div>
                    <?php else : ?>
                        No Image
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold"><?= shorten_text($produk['nama_perangkat'], 20) ?></h5>
                        <p class="card-text text-truncate"><?= "Rp " . number_format($produk['harga'], 0, ',', '.'); ?></p>
                        <p class="card-text text-justify"><?= shorten_text($produk['deskripsi'], 30) ?></p>
                        <a href="<?= base_url('/client/data-perangkat/') . $produk['perangkat_id'] ?>" class="btn btn-primary">More Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- End Product Card -->
        <!-- Add more Product Cards here -->
    </div>
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Semua Produk</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div>
    <div class="row">
        <!-- Product Card -->
        <?php foreach ($data_perangkat as $produk) : ?>
            <div class="col-md-4">
                <div class="card">
                    <?php if ($produk['gambar']) : ?>
                        <div class="card-img-top bg-light" style="padding: 40px; width: 100%; height:250px">
                            <div class="text-center">
                                <img src="<?= base_url('public/uploads/' . $produk['gambar']) ?>" alt="<?= $produk['nama_perangkat'] ?>" width="120">
                            </div>
                        </div>
                    <?php else : ?>
                        No Image
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title font-weight-bold"><?= shorten_text($produk['nama_perangkat'], 20) ?></h5>
                        <p class="card-text text-truncate"><?= "Rp " . number_format($produk['harga'], 0, ',', '.'); ?></p>
                        <p class="card-text text-justify"><?= shorten_text($produk['deskripsi'], 30) ?></p>
                        <a href="<?= base_url('/client/data-perangkat/') . $produk['perangkat_id'] ?>" class="btn btn-primary">More Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <!-- End Product Card -->
        <!-- Add more Product Cards here -->
    </div>
</div>
<?= $this->endSection() ?>