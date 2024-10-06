<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Transaksi</title>
    <style>
        /* Gaya CSS untuk PDF */
        body {
            font-family: 'Courier', monospace;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Laporan Transaksi</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Pemesan</th>
                <th>Paket</th>
                <th>Destinasi</th>
                <th>Jumlah Orang</th>
                <th>Tanggal Pelaksanaan</th>
                <th>Kendaraan yang Dipakai</th>
                <th>Total Pembayaran</th>
                <th>Status Pemesanan</th>
                <th>Status Pembayaran</th>
                <th>Status Refund</th>
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
</body>

</html>