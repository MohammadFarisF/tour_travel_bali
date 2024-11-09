<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                                Invoice
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content -->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Pesanan Anda</span>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Kode Booking</th>
                                <th>Nama Paket</th>
                                <th>Total Bayar</th>
                                <th>Status Pemesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bookings as $booking): ?>
                                <tr onclick="window.location.href='<?= site_url('profile/detail-invoice/' . $booking['booking_id']); ?>'" style="cursor: pointer;">
                                    <td><?= $booking['booking_id']; ?></td>
                                    <td><?= $booking['package_name']; ?></td>
                                    <td>Rp. <?= number_format($booking['total_amount'], 0, ',', '.'); ?></td> <!-- Format Total Bayar -->
                                    <td>
                                        <?php
                                        switch ($booking['booking_status']) {
                                            case 'pending':
                                                echo 'Belum dibayar';
                                                break;
                                            case 'confirmed':
                                                echo 'Sudah dibayar';
                                                break;
                                            case 'cancelled':
                                                echo 'Pesanan dibatalkan';
                                                break;
                                            case 'completed':
                                                echo 'Trip selesai';
                                                break;
                                            default:
                                                echo 'Status tidak diketahui';
                                                break;
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>