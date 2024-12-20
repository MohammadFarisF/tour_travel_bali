<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                                Pemesanan
                            </h1>
                            <div class="page-header-subtitle">Hai admin, Selamat Datang di Pengelolaan Pemesanan :)</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Data Pemesanan</span>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Kode Booking</th>
                                <th>Nama Pemesan</th>
                                <th>Nama Paket</th>
                                <th>Alamat</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Total Bayar</th>
                                <th>Status Pemesanan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($bookings as $booking): ?>
                                <tr>
                                    <td>
                                        <?php if ($booking['booking_status'] === 'completed' || $booking['booking_status'] === 'pending'): ?>
                                            <!-- Jika status sudah completed, tampilkan kode booking tanpa link -->
                                            <span>#<?= $booking['booking_id']; ?></span>
                                        <?php else: ?>
                                            <!-- Jika status belum completed, tampilkan kode booking dengan modal -->
                                            <a data-bs-toggle="modal" data-bs-target="#detailModal<?= $booking['booking_id']; ?>" style="cursor: pointer; color: black; transition: color 0.3s;" onmouseover="this.style.color='blue';" onmouseout="this.style.color='black';">#<?= $booking['booking_id']; ?></a>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= $booking['user_name']; ?></td>
                                    <td><?= $booking['package_name']; ?></td>
                                    <td><?= $booking['address']; ?></td>
                                    <td><?= date('l, d F Y', strtotime($booking['created_at'])); ?></td> <!-- Format Tanggal Pemesanan -->
                                    <td>Rp. <?= number_format($booking['total_amount'], 0, ',', '.'); ?></td> <!-- Format Total Bayar -->
                                    <td>
                                        <?php
                                        switch ($booking['booking_status']) {
                                            case 'pending':
                                                echo '<span class="badge bg-warning text-dark rounded-pill"><strong>Belum Dibayar</strong></span>';
                                                break;
                                            case 'confirmed':
                                                echo '<span class="badge bg-success text-white rounded-pill">Sudah Dibayar</span>';
                                                break;
                                            case 'cancelled':
                                                echo '<span class="badge bg-danger text-white rounded-pill">Pesanan Dibatalkan</span>';
                                                break;
                                            case 'completed':
                                                echo '<span class="badge bg-primary text-white rounded-pill">Trip Selesai</span>';
                                                break;
                                            default:
                                                echo '<span class="badge bg-secondary text-white rounded-pill">Status Tidak Diketahui</span>';
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php if ($booking['booking_status'] === 'completed' || $booking['booking_status'] === 'pending'): ?>
                                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detailModal<?= $booking['booking_id']; ?>">
                                                Detail
                                            </button>
                                        <?php else: ?>
                                            <!-- Jika status belum completed, tampilkan tombol Selesai -->
                                            <form action="<?= base_url('bali/booking/completeBooking/' . esc($booking['booking_id'])) ?>" method="post" onsubmit="return confirm('Apakah Anda yakin ingin menyelesaikan pesanan ini?');">
                                                <button type="submit" class="btn btn-primary">Selesai</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <!-- Modal untuk detail pemesanan -->
                                <div class="modal fade" id="detailModal<?= $booking['booking_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Pemesanan <?= $booking['booking_id']; ?></h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Nama Pemesan:</strong> <?= $booking['user_name']; ?></p>
                                                <p><strong>Nama Paket:</strong> <?= $booking['package_name']; ?></p>
                                                <p><strong>Destinasi Paket:</strong> <?= $booking['destination_names']; ?></p>
                                                <p><strong>Alamat:</strong> <?= $booking['address']; ?></p>
                                                <p><strong>Jumlah Orang:</strong> <?= $booking['total_people']; ?> Orang</p>
                                                <p><strong>Tanggal Pelaksanaan:</strong> <?= date('l, d F Y', strtotime($booking['departure_date'])) . ' - ' . date('l, d F Y', strtotime($booking['return_date'])); ?></p> <!-- Format Tanggal Pelaksanaan -->
                                                <p><strong>Kendaraan Digunakan:</strong> <?= $booking['vehicle_name']; ?></p>
                                                <p><strong>Total Bayar:</strong> Rp. <?= number_format($booking['total_amount'], 0, ',', '.'); ?></p>
                                                <p><strong>Status Pemesanan:</strong>
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
                                                    }
                                                    ?>
                                                </p>
                                                <p><strong>Status Pembayaran:</strong>
                                                    <?php
                                                    switch ($booking['payment_status']) {
                                                        case 'pending':
                                                            echo 'Belum dikonfirmasi';
                                                            break;
                                                        case 'paid':
                                                            echo 'Sudah dikonfirmasi';
                                                            break;
                                                        case 'refund_processed':
                                                            echo 'Proses pengembalian dana';
                                                            break;
                                                        default:
                                                            echo 'Status tidak diketahui';
                                                            break;
                                                    }
                                                    ?>
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>