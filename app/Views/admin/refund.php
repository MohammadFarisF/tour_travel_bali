<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                                Pengembalian Dana
                            </h1>
                            <div class="page-header-subtitle">Hai admin, Selamat Datang di Pengelolaan Pengembalian Dana :)</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Data Refund</span>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Nomor Akun</th>
                                <th>Nama Pemegang Akun</th>
                                <th>Kode Booking</th>
                                <th>Jumlah Refund</th>
                                <th>Tanggal Refund</th>
                                <th>Status Refund</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($refunds as $refund): ?>
                                <tr>
                                    <td><?= $refund['account_number']; ?></td>
                                    <td><?= $refund['account_holder_name']; ?></td>
                                    <td>#<?= $refund['booking_id']; ?></td>
                                    <td><?= "Rp " . number_format($refund['refund_amount'], 0, ',', '.'); ?></td> <!-- Format Rupiah -->
                                    <td><?= date('l, d F Y', strtotime($refund['refund_date'])); ?></td> <!-- Format Tanggal Refund -->
                                    <td>
                                        <?php
                                        switch ($refund['refund_status']) {
                                            case 'processed':
                                                echo '<span class="badge bg-warning text-dark"><strong>Dalam Proses</strong></span>';
                                                break;
                                            case 'rejected':
                                                echo '<span class="badge bg-danger text-white">Refund Ditolak</span>';
                                                break;
                                            case 'completed':
                                                echo '<span class="badge bg-success text-white">Refund Selesai</span>';
                                                break;
                                            default:
                                                echo '<span class="badge bg-secondary text-white">Status Tidak Diketahui</span>';
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalRefund<?= $refund['refund_id']; ?>">Ubah Status</button>

                                        <!-- Modal untuk mengubah status refund -->
                                        <div class="modal fade" id="modalRefund<?= $refund['refund_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modalRefundLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalRefundLabel">Ubah Status Refund</h5>
                                                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="<?= base_url(); ?>bali/refund/updateStatus" method="post">
                                                        <div class="modal-body">
                                                            <input type="hidden" name="refund_id" value="<?= $refund['refund_id']; ?>">
                                                            <div class="form-group">
                                                                <label>Status Refund</label>
                                                                <select name="status" class="form-control">
                                                                    <option value="processed" <?= $refund['refund_status'] == 'processed' ? 'selected' : ''; ?>>Dalam Proses</option>
                                                                    <option value="rejected" <?= $refund['refund_status'] == 'rejected' ? 'selected' : ''; ?>>Ditolak</option>
                                                                    <option value="completed" <?= $refund['refund_status'] == 'completed' ? 'selected' : ''; ?>>Selesai</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Tutup</button>
                                                            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>