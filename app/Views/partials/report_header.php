<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <htmlpageheader name="letterheader">
        <table width="100%" class="head">
            <tr>
                <td style="text-align: center;"><img src="<?= base_url(); ?>public/assets/img/AdminLTELogo.png" width="128" alt="" srcset=""></td>
            </tr>
            <tr>
                <td style="text-align: center;">
                    <span style="font-weight: bold; font-size: 14pt;">
                        Politeknik Negeri Banjarmasin
                    </span>
                </td>
            </tr>
        </table>
        <div style="margin-top: 10px; font-weight: bold; font-size: 12pt;">
            <div style="text-align:center;">
                Kartu Peserta
                <br>
                Bimbingan Mental dan Fisik
            </div>
        </div>
    </htmlpageheader>
    <style>
        body {
            font-family: sans-serif;
        }

        @page {
            margin-top: 3cm;
            margin-bottom: 3cm;
            margin-left: 3cm;
            margin-right: 3cm;
            background-color: white;

        }

        @page :first {
            margin-top: 7cm;
            margin-bottom: 4cm;
            header: html_letterheader;
            footer: _blank;
            resetpagenum: 1;
        }

        @page letterhead :first {
            margin-top: 4cm;
            margin-bottom: 4cm;
            header: html_letterheader;
            footer: _blank;
            resetpagenum: 1;
            background-color: lightblue;
        }

        table.tab-container {
            margin: 10px 0px;
            width: 100%;
            font-size: 12pt;
            font-weight: bold;
            border-collapse: collapse;
        }

        table.tab-container td {
            border: 1px solid #090C02;
            padding: 8px 20px;
        }

        .data-peserta {
            width: 100%;
            margin: 10px 0px;
        }

        table.foto-peserta {
            width: 100%;
        }

        table.foto-peserta td {
            vertical-align: top;
            text-align: center;
            width: 100%;
        }

        .img {
            width: 150px;
            height: 150px;
            border: 1px solid #090C02;
            border-radius: 100%;
        }

        .bc-container {
            margin-top: 80px;
            text-align: center;
            border-top: 1px solid #090C02;
            border-bottom: 1px solid #090C02;
            padding: 10px;
        }

        table.barcode-container {
            width: 100%;
            text-align: center;
            font-size: 12pt;
            font-weight: normal;
        }

        .barcode {
            padding: 1.5mm;
            margin: 0;
            vertical-align: top;
            color: #090C02;
            height: 80px;
        }
    </style>

</body>

</html>