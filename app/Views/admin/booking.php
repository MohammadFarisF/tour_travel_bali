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
                                    <td><?= $booking['booking_id']; ?></td>
                                    <td><?= $booking['user_name']; ?></td>
                                    <td><?= $booking['package_name']; ?></td>
                                    <td><?= $booking['address']; ?></td>
                                    <td><?= $booking['created_at']; ?></td>
                                    <td><?= $booking['total_amount']; ?></td>
                                    <td><?= $booking['booking_status']; ?></td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal<?= $booking['booking_id']; ?>">
                                            Detail
                                        </button>
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
                                                <p><strong>Jumlah Orang:</strong> <?= $booking['total_people']; ?></p>
                                                <p><strong>Tanggal Pelaksanaan:</strong> <?= $booking['departure_date'] . ' - ' . $booking['return_date']; ?></p>
                                                <p><strong>Kendaraan Digunakan:</strong> <?= $booking['vehicle_name']; ?></p>
                                                <p><strong>Total Bayar:</strong> <?= $booking['total_amount']; ?></p>
                                                <p><strong>Status Pemesanan:</strong> <?= $booking['booking_status']; ?></p>
                                                <p><strong>Status Pembayaran:</strong> <?= $booking['payment_status']; ?></p>
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