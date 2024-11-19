<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .status-label {
        display: inline-block;
        padding: 5px 15px;
        border-radius: 20px;
        /* Membuat bentuk melengkung */
        color: #fff;
        font-weight: bold;
        text-align: center;
    }

    /* Status Booking */
    .status-pending {
        background-color: #ffc107;
        /* Kuning */
    }

    .status-confirmed {
        background-color: #28a745;
        /* Hijau */
    }

    .status-cancelled {
        background-color: #dc3545;
        /* Merah */
    }

    .status-completed {
        background-color: #17a2b8;
        /* Biru */
    }

    /* Status Pembayaran */
    .payment-pending {
        background-color: #ffc107;
        /* Kuning */
    }

    .payment-paid {
        background-color: #28a745;
        /* Hijau */
    }

    .payment-refund {
        background-color: #6c757d;
        /* Abu-abu */
    }

    .payment-unknown {
        background-color: #343a40;
        /* Hitam */
    }
</style>
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-light pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1>
                                <div class="page-header-icon" data-feather="file-text" style="height:50px; width:30px"></div>
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
                <div class="card-header-primary d-flex justify-content-between align-items-center">
                    <span>Pesanan Anda</span>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-black">
                                <th>Kode Booking</th>
                                <th>Nama Paket</th>
                                <th>Total Bayar</th>
                                <th>Status Pemesanan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bookings as $booking): ?>
                                <tr>
                                    <td class="text-black"><a href="<?= base_url('profile/invoice-details/' . esc($booking['booking_id'])) ?>">
                                            #<?= $booking['booking_id']; ?>
                                        </a></td>
                                    <td class="text-black"><?= $booking['package_name']; ?></td>
                                    <td class="text-black">Rp. <?= number_format($booking['total_amount'], 0, ',', '.'); ?></td> <!-- Format Total Bayar -->
                                    <td>
                                        <?php
                                        switch ($booking['booking_status']) {
                                            case 'pending':
                                                echo '<span class="status-label status-pending">Menunggu Konfirmasi</span>';
                                                break;
                                            case 'confirmed':
                                                echo '<span class="status-label status-confirmed">Pesanan Terkonfirmasi</span>';
                                                break;
                                            case 'cancelled':
                                                echo '<span class="status-label status-cancelled">Pesanan Dibatalkan</span>';
                                                break;
                                            case 'completed':
                                                echo '<span class="status-label status-completed">Trip Selesai</span>';
                                                break;
                                            default:
                                                echo '<span class="status-label status-unknown">Status tidak diketahui</span>';
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
    <script>
        feather.replace();
    </script>