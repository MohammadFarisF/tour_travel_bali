<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                                Pembayaran
                            </h1>
                            <div class="page-header-subtitle">Hai admin, Selamat Datang di Pengelolaan Pembayaran :)</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Data Pembayaran</span>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Kode Booking</th>
                                <th>Nama Akun Pembayaran</th>
                                <th>Nomor Akun Pembayaran</th>
                                <th>Metode Pembayaran</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Status Pembayaran</th>
                                <th>Bukti Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($payments as $payment): ?>
                                <tr>
                                    <td><?= $payment['booking_id']; ?></td>
                                    <td><?= $payment['account_holder_name']; ?></td>
                                    <td><?= $payment['account_number']; ?></td>
                                    <td>
                                        <?php
                                        // Assuming there's a method to determine the payment method
                                        echo $payment['payment_method'] === 'bank_transfer' ? 'Bank Transfer' : 'Lainnya';
                                        ?>
                                    </td>
                                    <td><?= date('l, d F Y', strtotime($payment['payment_date'])); ?></td> <!-- Format Tanggal Pembayaran -->
                                    <td>
                                        <?php
                                        switch ($payment['payment_status']) {
                                            case 'validated':
                                                echo 'Sudah terkonfirmasi';
                                                break;
                                            case 'pending':
                                                echo 'Belum dikonfirmasi';
                                                break;
                                            case 'failed':
                                                echo 'Pembayaran gagal';
                                                break;
                                            default:
                                                echo 'Status tidak diketahui';
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#proofModal<?= $payment['payment_id']; ?>">
                                            Lihat
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateStatusModal<?= $payment['payment_id']; ?>">
                                            Ubah Status
                                        </button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="proofModal<?= $payment['payment_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="proofModalLabel<?= $payment['payment_id']; ?>" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="proofModalLabel<?= $payment['payment_id']; ?>">Bukti Pembayaran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <img src="<?= base_url('uploads/bukti_tf/' . $payment['proof_of_payment']); ?>" class="img-fluid" alt="Bukti Pembayaran">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal untuk mengubah status pembayaran -->
                                <div class="modal fade" id="updateStatusModal<?= $payment['payment_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateStatusModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateStatusModalLabel">Ubah Status Pembayaran</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="<?= base_url(); ?>bali/payment/updateStatus" method="post">
                                                <div class="modal-body">
                                                    <input type="hidden" name="payment_id" value="<?= $payment['payment_id']; ?>">
                                                    <div class="mb-3">
                                                        <label for="status" class="form-label">Pilih Status</label>
                                                        <select class="form-select" name="status" required>
                                                            <option value="validated">Sudah terkonfirmasi</option>
                                                            <option value="pending">Belum dikonfirmasi</option>
                                                            <option value="failed">Pembayaran gagal</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Tutup</button>
                                                    <button class="btn btn-primary" type="submit">Simpan</button>
                                                </div>
                                            </form>
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