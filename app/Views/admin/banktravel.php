<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                                Bank travel
                            </h1>
                            <div class="page-header-subtitle">Hai admin, Selamat Datang di Pengelolaan Bank Travel :)</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Bank Travel</span>
                    <!-- Button berada di ujung kanan -->
                    <a href="<?= base_url(); ?>bali/banktravel/create" class="btn btn-primary">Tambah Bank Travel</a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Kode Bank</th>
                                <th>Nomor Akun</th>
                                <th>Nama Pemegang Akun</th>
                                <th>Nama Bank</th>
                                <th>Foto</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Looping data destinasi -->
                            <?php foreach ($banktravel as $banktravel): ?>
                                <tr>
                                    <td><?php echo esc($banktravel['trabank_id']); ?></td>
                                    <td><?php echo esc($banktravel['account_number']); ?></td>
                                    <td><?php echo esc($banktravel['account_holder_name']); ?></td>
                                    <td><?php echo esc($banktravel['bank_name']); ?></td>
                                    <td>
                                        <?php if (!empty($banktravel['photo'])): ?>
                                            <img src="<?= base_url('uploads/' . esc($banktravel['photo'])); ?>" alt="Foto Bank" style="width: 100px; height: auto;">
                                        <?php else: ?>
                                            No Image
                                        <?php endif; ?></td>
                                    <td>
                                    <a href="<?= site_url('bali/banktravel/edit/' . $banktravel['trabank_id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= site_url('bali/banktravel/delete/' . $banktravel['trabank_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus bank ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>