<?= $this->extend('layouts/report_layout') ?>

<?= $this->section('content') ?>
<style>
    .data-perangkat {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #000;
    }

    .data-perangkat th,
    .data-perangkat td {
        border: 1px solid #000;
    }
</style>
<h4 style="text-align: center;">Laporan Smartphone</h4>
<div style="text-align: center;">
    <?php if ($jenis_laporan == "per") : ?>
        <?php $uniqueMerek = null;
        foreach ($data_perangkat as $perangkat) :
            if ($uniqueMerek === null) :
                $uniqueMerek = $perangkat['nama_merek']; // Set nama merek pertama kali ditemui
        ?>
                <h3>Nama Merek: <?= $uniqueMerek ?></h3>
            <?php
            endif;
            ?>
        <?php endforeach; ?>
    <?php else : ?>
        <h3>Rekapitulasi Data Smartphone</h3>
    <?php endif ?>
    <p><?= ($jenis_laporan == "per") ? "Tahun Rilis " : "Periode " ?> : <?= $tahun_rilis ?></p>
</div>
<table class="data-perangkat">
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th>Name</th>
            <th>Merek</th>
            <th>Tahun Rilis</th>
            <th>Stok</th>
            <th>Harga</th>
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
                <td>Rp. <?= number_format($perangkat['harga'], 0, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>