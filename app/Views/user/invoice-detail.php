<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    @media print {
        @page {
            size: A4 landscape;

        }

        body {
            margin: 0;
            padding: 0;
            font-size: 13px;
        }

        .container-xl,
        .card-body {
            padding: 5px;
        }

        h1,
        h2,
        h3 {
            font-size: 14px;
        }

        p,
        td,
        th {
            font-size: 13px;
            margin: 0;
        }

        table {
            width: 100%;
            font-size: 13px;
            border-collapse: collapse;
            page-break-inside: auto;
        }

        th,
        td {
            padding: 5px;
        }

        /* Ensure no unnecessary elements are printed */
        #layoutSidenav_nav,
        header.page-header,
        .card-header-primary,
        div.container-fluid {
            display: none !important;
        }

        .footer-print {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #343a40 !important;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 10px;
        }

        * {
            background: none !important;
        }

        /* Ensure table breaks don't occur */
        tr {
            page-break-inside: avoid;
        }
    }
</style>


<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-light">
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
        <div class="container-xl px-4">
            <div class="card mb-4">
                <div class="card-header-primary d-flex justify-content-between align-items-center">
                    <span>Detail Invoice</span>
                    <button class="btn btn-primary" onclick="window.print()">
                        <i data-feather="printer" style="height:25px; width:20px;"></i> Print Invoice
                    </button>
                </div>
                <div class="card-body">
                    <!-- Invoice Content -->
                    <div class="invoice-header mb-4">
                        <div class="row align-items-center">
                            <!-- Profil Perusahaan -->
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <img src="<?= base_url() ?>asset_user/img/title.png" alt="Travel Logo" class="me-3 rounded-circle" style="height: 80px; width: 80px;">
                                    <div>
                                        <h2 class="mb-0">Bali Tour & Travel</h2>
                                        <p class="mb-0 text-muted">Your Trusted Travel Partner</p>
                                        <p class="mb-0">Jl. Sunset Road No. 5</p>
                                        <p class="mb-0">Kuta, Bali - 80361</p>
                                        <p class="mb-0">Phone: <strong>+62 812-3456-7890</strong></p>
                                        <p class="mb-0">Email: <strong>info@balitourtravel.com</strong></p>
                                    </div>
                                </div>
                            </div>
                            <!-- Detail Invoice -->
                            <div class="col-md-6 text-end">
                                <p class="mb-0">Invoice #: <strong><?= $booking['booking_id'] ?></strong></p>
                                <p class="mb-0">Date: <strong><?= date('d F Y') ?></strong></p>
                                <p class="mb-0">Booking Date: <strong><?= date('d F Y', strtotime($booking['created_at'])) ?></strong></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Invoice To -->
                        <div class="col-md-6">
                            <h3>Detail Booking:</h3>
                            <p class="mb-0">Nama Paket: <strong><?= $package['package_name'] ?></strong></p>
                            <p class="mb-0">Kendaraan: <strong><?= $vehicleNames ?></strong></p>
                            <p class="mb-0">Hari Keberangkatan: <strong><?= date('l, d F Y', strtotime($booking['departure_date'])) ?></strong></p>
                            <p class="mb-0">Durasi: <strong><?= $package['hari'] ?> Hari</strong></p>
                        </div>
                        <!-- Payment Status / Detail Booking -->
                        <div class="col-md-6 text-end">
                            <h3>Invoice To:</h3>
                            <p class="mb-0"><?= $customer['full_name'] ?></p>
                            <p class="mb-0"><?= $booking['address'] ?></p>
                            <p class="mb-0"><?= $customer['email'] ?></p>
                            <p class="mb-0"><?= $customer['phone_number'] ?></p>
                        </div>
                    </div>
                    <h2 class="text-center mb-4">Tour Package Invoice</h2>
                    <table class="table table-striped table-bordered">
                        <thead class="text-black">
                            <tr>
                                <th>Destination</th>
                                <th>Location</th>
                                <th>Price Per Person</th>
                                <th>Person</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $totalPrice = 0;
                            foreach ($destinationDetails as $destination) :
                                // Calculate the destination price
                                $destinationPrice = $destination['harga_per_orang'] * $booking['total_people'];
                                $totalPrice += $destinationPrice;
                            ?>
                                <tr>
                                    <td class="text-black"><?= $destination['destination'] ?></td>
                                    <td class="text-black"><?= $destination['location'] ?></td>
                                    <td class="text-black">Rp <?= number_format($destination['harga_per_orang'], 0, ',', '.') ?></td>
                                    <td class="text-black"><?= $booking['total_people'] ?> Orang</td>
                                    <td class="text-black">Rp <?= number_format($destinationPrice, 0, ',', '.') ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end text-black">Total: </th>
                                <th class="text-black">Rp <?= number_format($booking['total_amount'], 0, ',', '.') ?></th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="mb-4">
                        <div class="row">
                            <!-- Payment Details -->
                            <div class="col-md-6">
                                <h3>Payment Details:</h3>
                                <p class="mb-0">Payment Status: <strong>Lunas</strong></p>
                                <p class="mb-0">Metode Pembayaran: <strong><?= ucfirst($payment['payment_method']) ?></strong></p>
                                <p class="mb-0">Nama Pemegang Akun: <strong><?= $payment['account_holder_name'] ?></strong></p>
                                <p class="mb-0">Nama Akun: <strong><?= $payment['account_name'] ?></strong></p>
                                <p class="mb-0">Nomor Akun: <strong>**** **** **** <?= substr($payment['account_number'], -4) ?></strong></p>
                            </div>

                            <!-- Customer Note and Terms and Conditions -->
                            <div class="col-md-6">
                                <h3>Customer Note:</h3>
                                <p class="mb-0"><?= $booking['customer_note'] ?? 'No note provided.' ?></p>

                                <h3 class="mt-4">Terms and Conditions:</h3>
                                <ul>
                                    <li>By making a payment, you agree to the terms and conditions of our travel services.</li>
                                    <li>Cancellations made 48 hours before departure are eligible for a refund.</li>
                                    <li>Refunds will be processed within 7 business days.</li>
                                    <!-- Add more terms and conditions as needed -->
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="footer-print text-center text-white">
                        <p class="mb-0" style="background-color:#343a40; padding: 10px;">Terimakasih Sudah mempercayai Jasa Travel Kami</p>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script>
        feather.replace();
    </script>