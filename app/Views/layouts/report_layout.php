<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan PDF</title>
    <style>
        table {
            font-family: sans-serif;
        }

        .kop {
            width: 100%;
            border-bottom: 1px solid #000;
        }

        .ttd {
            width: 100%;
            text-align: center;
        }
    </style>
</head>


<body>
    <!-- Kop laporan -->
    <table class="kop">
        <tr>
            <td style="width: 20%; text-align: left;">
                <img src="<?= base_url(); ?>public/assets/img/AdminLTELogo.png" alt="Logo" style="max-width: 100px;">
            </td>
            <td style="width: 80%; text-align: center;">
                <h2>Syarif Cell</h2>
                <p>Jl. H. Mistar Cokrokusumo, Kemuning, Kec. Banjarbaru Selatan, Kota Banjar Baru, Kalimantan Selatan 70732</p>
                <p>082254272344</p>
            </td>
        </tr>
    </table>


    <!-- Isi laporan -->
    <?= $this->renderSection('content') ?>
    <!-- Tambahkan konten laporan lainnya sesuai kebutuhan -->
    <!-- Informasi Penanggung Jawab -->
    <div style="margin-top: 50px;">
        <p style="clear: both;">Tanggal Dicetak: <?= date('d/m/Y') ?></p>
        <table class="ttd">
            <tr>
                <th>Mengetahui,</th>
                <th>Dicetak Oleh,</th>
            </tr>
            <tr height="100px">
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td>(<?= session()->get('name'); ?>)</td>
                <td>(__________________)</td>
            </tr>
        </table>
    </div>
</body>

</html>