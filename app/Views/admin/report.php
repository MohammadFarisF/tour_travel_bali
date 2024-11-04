<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="truck"></i></div>
                                Pengelolaan Laporan
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Main page content-->
        <div class="container-xxl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header">Cetak Laporan</div>
                <div class="card-body">
                    <div class="sbp-preview">
                        <div class="sbp-preview-content">
                            <form id="reportForm" method="post" action="<?= base_url() ?>bali/report/printReport" target="_blank">
                                <div class="row g-3 align-items-center">

                                    <!-- Filter Status Booking -->
                                    <div class="col-auto d-flex justify-content-between align-items-center">
                                        <label for="statusFilter" class="form-label" style="padding-right: 2px;">Status:</label>
                                        <select id="statusFilter" name="bookingStatus" class="form-select">
                                            <option value="all" selected>All Statuses</option>
                                            <option value="confirmed">Sudah Dibayar</option>
                                            <option value="pending">Belum Dibayar</option>
                                            <option value="cancelled">Dibatalkan</option>
                                            <option value="completed">Selesai</option>
                                        </select>
                                    </div>

                                    <!-- Filter Time Period -->
                                    <div class="col-auto d-flex justify-content-between align-items-center">
                                        <label for="timeFilter" class="form-label">Time Period:</label>
                                        <select id="timeFilter" name="timePeriod" class="form-select">
                                            <option value="all" selected>All Time</option>
                                            <option value="daily">Harian</option>
                                            <option value="monthly">Bulanan</option>
                                            <option value="yearly">Tahunan</option>
                                        </select>
                                    </div>

                                    <!-- Show Button -->
                                    <div class="col-auto float-end">
                                        <button type="submit" class="btn btn-primary">Print</button>
                                    </div>

                                </div>
                            </form>

                            <!-- Tabel Data Booking -->
                            <div class="table-responsive mt-4">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Pemesan</th>
                                            <th>Paket</th>
                                            <th>Destinasi</th>
                                            <th>Jumlah Orang</th>
                                            <th>Tanggal Pelaksanaan</th>
                                            <th>Kendaraan</th>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>