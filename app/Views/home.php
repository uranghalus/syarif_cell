<?php

use function App\Helpers\shorten_text;

helper('shorten');
?>
<?= $this->extend('layouts/main_layout') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-12">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="<?= base_url(); ?>public/assets/img/34b5bf180145769.6505ae7623131.webp" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 h-100" src="<?= base_url(); ?>public/assets/img/f3832e180145769.6505ae76214ca.webp" alt="Second slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-custom-icon" aria-hidden="true">
                    <i class="fas fa-chevron-left"></i>
                </span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-custom-icon" aria-hidden="true">
                    <i class="fas fa-chevron-right"></i>
                </span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

<!-- Content -->

<div class="container">
    <div class="content-header">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Produk Baru </h1>
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
</div>
<?= $this->endSection() ?>