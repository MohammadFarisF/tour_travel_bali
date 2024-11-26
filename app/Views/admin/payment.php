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
                                <th>Nama Customer</th>
                                <th>Total Pembayaran</th>
                                <th>Status Pembayaran</th>
                                <th>Bukti Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($payments as $payment): ?>
                                <tr>
                                    <td>
                                        <a href="<?= base_url('bali/booking'); ?>" style="cursor: pointer; color: #69707a; transition: color 0.3s;" onmouseover="this.style.color='blue';" onmouseout="this.style.color='#69707a';">
                                            #<?= $payment['booking_id']; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?= $payment['full_name'] ?>
                                    </td>
                                    <td>Rp <?= number_format($payment['total_amount'], 0, ',', '.'); ?></td> <!-- Format Tanggal Pembayaran -->
                                    <td>
                                        <?php
                                        switch ($payment['payment_status']) {
                                            case 'validated':
                                                echo '<span class="badge bg-success text-white rounded-pill">Sudah Terkonfirmasi</span>';
                                                break;
                                            case 'pending':
                                                echo '<span class="badge bg-warning text-dark rounded-pill"><strong>Belum Dikonfirmasi </strong></span>';
                                                break;
                                            case 'failed':
                                                echo '<span class="badge bg-danger text-white rounded-pill">Pembayaran Gagal</span>';
                                                break;
                                            default:
                                                echo '<span class="badge bg-secondary text-white rounded-pill">Status Tidak Diketahui</span>';
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#proofModal<?= $payment['payment_id']; ?>">
                                            Lihat
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($payment['payment_status'] === 'validated'): ?>
                                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detailModal<?= $payment['payment_id']; ?>">
                                                Detail
                                            </button>
                                        <?php else: ?>
                                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateStatusModal<?= $payment['payment_id']; ?>">
                                                Ubah Status
                                            </button>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <div class="modal fade" id="detailModal<?= $payment['payment_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detailModalLabel">Detail Pembayaran</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Metode Pembayaran:</strong> <?php
                                                                                        // Assuming there's a method to determine the payment method
                                                                                        echo $payment['payment_method'] === 'bank_transfer' ? 'Bank Transfer' : 'Lainnya';
                                                                                        ?></p>
                                                <p><strong>Nama Akun:</strong> <?= $payment['account_name']; ?></p>
                                                <p><strong>Nama Pemegang Akun:</strong> <?= $payment['account_holder_name']; ?></p>
                                                <p><strong>Nomor Akun:</strong> <?= $payment['account_number']; ?></p>
                                                <p><strong>Tanggal Bayar:</strong> <?= date('l, d F Y', strtotime($payment['payment_date'])); ?></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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