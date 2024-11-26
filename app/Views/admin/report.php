<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
                                        <select id="statusFilter" name="status" class="form-select">
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
                                        <select id="timeFilter" name="inputType" class="form-select">
                                            <option value="all" selected>All Time</option>
                                            <option value="daily">Harian</option>
                                            <option value="monthly">Bulanan</option>
                                            <option value="yearly">Tahunan</option>
                                        </select>
                                    </div>

                                    <div class="col-auto" id="calendarInput" style="display: none;">
                                        <input type="text" id="calendar" name="dateRange" class="form-control" placeholder="Select a date">
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
                                            <th>Nama Paket</th>
                                            <th>Nama Destinasi</th>
                                            <th>Jumlah Peserta</th>
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
                                                <td><?= esc($data['total_people']) ?> Orang</td>
                                                <td>
                                                    <?php
                                                    // Format tanggal untuk departure_date dan return_date
                                                    $departureDate = date('l, d F Y', strtotime($data['departure_date']));
                                                    $returnDate = date('l, d F Y', strtotime($data['return_date']));
                                                    echo $departureDate . ' - ' . $returnDate;
                                                    ?>
                                                </td>
                                                <td><?= esc($data['vehicle_name']) ?></td>
                                                <td>Rp. <?= number_format($data['total_amount'], 0, ',', '.') ?></td>
                                                <td>
                                                    <?php
                                                    // Menampilkan status booking dengan teks biasa
                                                    switch ($data['booking_status']) {
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
                                                <td>
                                                    <?php
                                                    // Menampilkan status pembayaran dengan teks biasa
                                                    switch ($data['payment_status']) {
                                                        case 'paid':
                                                            echo 'Pembayaran Berhasil';
                                                            break;
                                                        case 'pending':
                                                            echo 'Menunggu Konfirmasi';
                                                            break;
                                                        case 'refund_processed':
                                                            echo 'Proses Refund';
                                                            break;
                                                        default:
                                                            echo 'Status tidak diketahui';
                                                            break;
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    // Menampilkan status refund dengan teks biasa
                                                    switch ($data['refund_status']) {
                                                        case 'processed':
                                                            echo 'Dalam Proses';
                                                            break;
                                                        case 'rejected':
                                                            echo 'Refund Ditolak';
                                                            break;
                                                        case 'completed':
                                                            echo 'Refund Selesai';
                                                            break;
                                                        default:
                                                            echo 'Status Tidak Diketahui';
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
                </div>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const timeFilter = document.getElementById('timeFilter');
            const calendarInput = document.getElementById('calendarInput');
            const calendar = document.getElementById('calendar');

            // Initialize Flatpickr
            flatpickr(calendar, {
                dateFormat: "Y-m-d", // Format for daily filter
                mode: "single", // Single date picker for daily
                disableMobile: true // Optional to disable mobile calendar
            });

            timeFilter.addEventListener('change', function() {
                if (timeFilter.value === 'daily') {
                    // Show calendar for daily
                    calendarInput.style.display = 'block';
                    flatpickr(calendar, {
                        dateFormat: "Y-m-d"
                    });
                } else if (timeFilter.value === 'monthly') {
                    // Show calendar for monthly (month picker)
                    calendarInput.style.display = 'block';
                    flatpickr(calendar, {
                        dateFormat: "Y-m", // Format bulan
                        disableMobile: true,
                        plugins: [new monthSelectPlugin({
                            shorthand: true, // Gunakan bulan singkat (Jan, Feb, dst.)
                            dateFormat: "Y-m", // Format bulan untuk backend
                            theme: "light" // Tema untuk selector bulan
                        })]
                    });
                } else if (timeFilter.value === 'yearly') {
                    // Show calendar for yearly (year picker)
                    calendarInput.style.display = 'block';
                    flatpickr("#dateRange", {
                        dateFormat: "Y", // Format hanya tahun
                        enableTime: false,
                        mode: "single"
                    });
                } else {
                    // Hide the calendar when "All Time" is selected
                    calendarInput.style.display = 'none';
                }
            });

            // Trigger change to initialize
            timeFilter.dispatchEvent(new Event('change'));
        });
    </script>