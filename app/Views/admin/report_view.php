<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        @page {
            margin: 20px;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 15px;
            background-color: #ffffff;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 2px solid #333;
        }

        .company-logo {
            width: 70px;
            height: 70px;
            margin-bottom: 8px;
            object-fit: contain;
        }

        .company-info {
            margin-bottom: 15px;
        }

        .company-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
            color: #333;
        }

        .company-details {
            font-size: 11px;
            color: #333;
            line-height: 1.3;
        }

        .report-title {
            font-size: 16px;
            font-weight: bold;
            margin: 15px 0;
            text-align: center;
            color: #333;
        }

        .report-period {
            text-align: center;
            margin-bottom: 15px;
            color: #333;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
            text-align: left;
            font-size: 10px;
        }

        th {
            background-color: #f5f5f5;
            font-weight: bold;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #ffffff;
        }

        .footer {
            margin-top: 20px;
            padding-top: 15px;
            border-top: 2px solid #333;
            font-size: 11px;
        }

        .footer-info {
            text-align: left;
            margin-bottom: 15px;
        }

        .signature-section {
            text-align: right;
            margin-top: 30px;
            padding-right: 30px;
        }

        .signature-line {
            width: 150px;
            border-bottom: 1px solid #333;
            margin-bottom: 8px;
            display: inline-block;
        }

        .signature-name {
            font-weight: bold;
            font-size: 11px;
        }

        .signature-title {
            color: #333;
            font-size: 11px;
        }

        .page-number {
            position: fixed;
            bottom: 20px;
            width: 100%;
            text-align: center;
            font-size: 11px;
            color: #333;
        }

        .print-info {
            position: fixed;
            bottom: 40px;
            font-size: 11px;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="<?= $logoSrc ?>" alt="Logo Travel" class="company-logo">
        <div class="company-info">
            <div class="company-name">EXPLORE TOUR AND TRAVEL BALI</div>
            <div class="company-details">
                Jl. Mekar II Blok C 2 No.2 Pemogan, Denpasar Selatan, Indonesia<br>
                Telp: +62 822-3690-6042 | Email: explorebali52@gmail.com<br>
                Website: www.explorebali.com
            </div>
        </div>
    </div>

    <div class="report-title">LAPORAN TRANSAKSI PEMESANAN PAKET WISATA</div>
    <div class="report-period">Periode: <?= $dateRangeText ?></div>
    <div class="report-period">Status Pesanan: <?= $statusText ?></div>

    <table>
        <thead>
            <tr>
                <th>Nama Pemesan</th>
                <th>Paket</th>
                <th>Destinasi</th>
                <th>Jumlah<br>Orang</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Kendaraan</th>
                <th>Total<br>Pembayaran</th>
                <th>Status<br>Pemesanan</th>
                <th>Status<br>Pembayaran</th>
                <th>Status<br>Refund</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($reportData as $data): ?>
                <tr>
                    <td><?= esc($data['user_name']) ?></td>
                    <td><?= esc($data['package_name']) ?></td>
                    <td><?= esc($data['destination_names']) ?></td>
                    <td><?= esc($data['total_people']) ?></td>
                    <td><?= esc($data['departure_date']) ?> - <?= esc($data['return_date']) ?></td>
                    <td><?= esc($data['vehicle_name']) ?></td>
                    <td><?= esc($data['total_amount']) ?></td>
                    <td><?= esc($data['booking_status']) ?></td>
                    <td><?= esc($data['payment_status']) ?></td>
                    <td><?= esc($data['refund_status']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        <div class="print-info">
            Dicetak pada: <?= date('d/m/Y H:i:s') ?><br>
            Dicetak Oleh: <?= $adminName ?>
        </div>

        <div class="signature-section">
            <div>Bali, <?= date('d F Y') ?></div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="signature-line"></div>
            <div class="signature-name">Muhammad Firjatullah</div>
            <div class="signature-title">Pemilik Perusahaan</div>
        </div>
    </div>

    <div class="page-number">
    </div>
</body>

</html>