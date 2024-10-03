<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                                Bank Pelanggan
                            </h1>
                            <div class="page-header-subtitle">Hai admin, Selamat Datang di Pengelolaan Bank Pelanggan :)</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Bank Pelanggan</span>
                    <!-- Button berada di ujung kanan -->
                
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Kode Bank</th>
                                <th>Nama Akun</th>
                                <th>Nomor Akun</th>
                                <th>Nama Pemegang Akun</th>
                                <th>Tipe Akun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Looping data destinasi -->
                            <?php foreach ($bankpelanggan as $bankpelanggan): ?>
                                <tr>
                                    <td><?php echo esc($bankpelanggan['custbank_id']); ?></td>
                                    <td><?php echo esc($bankpelanggan['account_name']); ?></td>
                                    <td><?php echo esc($bankpelanggan['account_number']); ?></td>
                                    <td><?php echo esc($bankpelanggan['account_holder_name']); ?></td>
                                    <td><?php echo esc($bankpelanggan['account_type']); ?></td>
                                    <td>
                                    <a href="<?= site_url('bali/bankpelanggan/delete/' . $bankpelanggan['custbank_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus bank ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>