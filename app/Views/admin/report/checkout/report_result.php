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
<h4 style="text-align: center;">Laporan Pembelian</h4>
<div style="text-align: center;">
    <?php if ($jenis_laporan == "per") : ?>
        <?php $uniqueMerek = null;
        foreach ($data_checkout as $data) :
            if ($uniqueMerek === null) :
                $uniqueMerek = $data['nama_merek']; // Set nama merek pertama kali ditemui
        ?>
                <h3>Nama Merek: <?= $uniqueMerek ?></h3>
            <?php
            endif;
            ?>
        <?php endforeach; ?>
    <?php else : ?>
        <h3>Rekapitulasi Data Pembelian Smartphone</h3>
        <p>Periode : <?= $tahun_rilis ?></p>
    <?php endif ?>
</div>
<table class="data-perangkat">
    <thead>
        <tr>
            <th style="width: 5%;">No</th>
            <th>Nama Pembeli</th>
            <th>Nama Smartphone</th>
            <th>Harga Smartphone</th>
            <th>Merek Smartphone</th>
            <th>Qty</th>
            <th>Tanggal Pembelian</th>
            <th>Metode Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($data_checkout as $data) : ?>
            <tr>
                <td><?= $i++ ?></td>
                <td><?= $data['nama_lengkap'] ?></td>
                <td><?= $data['nama_perangkat'] ?></td>
                <td>Rp. <?= number_format($data['harga'], 0, ',', '.') ?></td>
                <td><?= $data['nama_merek'] ?></td>
                <td><?= $data['quantity'] ?></td>
                <td><?= $data['tanggal_pembelian'] ?></td>
                <td><?= $data['metode_pembayaran'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?= $this->endSection() ?>