<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                                Payment
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
                    <span>Data Payment</span>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Kode Booking</th>
                                <th>Nama Akun Pembayaran</th>
                                <th>Nomor Akun Pembayaran</th>
                                <th>Metode Pembayaran</th>
                                <th>Tanggal Pembayaran</th>
                                <th>Status Pembayaran</th>
                                <th>Bukti Pembayaran</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pembayaran as $bayar): ?>
                                <tr>
                                    <td><?= esc($bayar['booking_id']); ?></td>
                                    <td><?= esc($bayar['account_holder_name']); ?></td>
                                    <td><?= esc($bayar['account_number']); ?></td>
                                    <td><?= esc($bayar['payment_method']); ?></td>
                                    <td><?= date('d F Y', strtotime($bayar['created_at'])); ?></td>
                                    <td>
                                        <?php if ($bayar['payment_status'] == 'pending'): ?>
                                            <span class="badge bg-warning text-white">Pending</span>
                                        <?php elseif ($bayar['payment_status'] == 'approved'): ?>
                                            <span class="badge bg-success text-white">Approved</span>
                                        <?php elseif ($bayar['payment_status'] == 'rejected'): ?>
                                            <span class="badge bg-danger text-white">Rejected</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($bayar['proof_of_payment'])): ?>
                                            <img src="<?= base_url('uploads/payments/' . $bayar['proof_of_payment']); ?>" 
                                                    alt="Bukti Pembayaran" 
                                                    style="width: 100px; height: auto;"
                                                    onclick="window.open(this.src)">
                                        <?php else: ?>
                                            Tidak ada bukti
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($bayar['payment_status'] == 'pending'): ?>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-light dropdown-toggle" 
                                                        type="button" 
                                                        id="dropdownMenuButton" 
                                                        data-bs-toggle="dropdown" 
                                                        aria-expanded="false">
                                                    Aksi
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <li>
                                                        <form action="<?= base_url('bali/payment/updateStatus') ?>" method="post">
                                                            <input type="hidden" name="payment_id" value="<?= $bayar['payment_id'] ?>">
                                                            <input type="hidden" name="status" value="approved">
                                                            <button type="submit" class="dropdown-item text-success">
                                                                <i data-feather="check"></i> Approve
                                                            </button>
                                                        </form>
                                                    </li>
                                                    <li>
                                                        <form action="<?= base_url('bali/payment/updateStatus') ?>" method="post">
                                                            <input type="hidden" name="payment_id" value="<?= $bayar['payment_id'] ?>">
                                                            <input type="hidden" name="status" value="rejected">
                                                            <button type="submit" class="dropdown-item text-danger">
                                                                <i data-feather="x"></i> Reject
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </main>