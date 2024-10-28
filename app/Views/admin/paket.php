<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                                Paket Perjalanan
                            </h1>
                            <div class="page-header-subtitle">Hai admin, Selamat Datang di Pengelolaan Paket Perjalanan :)</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Paket Perjalanan</span>
                    <!-- Button berada di ujung kanan -->
                    <?php if (session()->get('user_role') === 'owner'): ?>
                        <a href="<?= base_url(); ?>bali/paket/create" class="btn btn-primary">Tambah Paket</a>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Kode Paket</th>
                                <th>Nama Paket</th>
                                <th>Tipe Paket</th>
                                <th>Deskripsi Paket</th>
                                <th>Foto Paket</th>
                                <?php if (session()->get('user_role') === 'owner'): ?>
                                    <th>Aksi</th> <!-- Hanya tampil jika user_role adalah owner -->
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($packages) && is_array($packages)): ?>
                                <?php foreach ($packages as $package): ?>
                                    <tr>
                                        <td><?= esc($package['package_id']); ?></td>
                                        <td><?= esc($package['package_name']); ?></td>
                                        <td>
                                            <?php
                                            if ($package['package_type'] === 'single_destination') {
                                                echo 'Single Day';
                                            } elseif ($package['package_type'] === 'multiple_day') {
                                                echo 'Multiple Day';
                                            } else {
                                                echo esc($package['package_type']);
                                            }
                                            ?>
                                        </td>
                                        <td><?= esc($package['description']); ?></td>
                                        <td> <?php if (!empty($package['foto'])): ?>
                                                <img src="<?= base_url('uploads/paket/' . esc($package['foto'])); ?>" alt="Foto Paket" style="width: 100px; height: auto;">
                                            <?php else: ?>
                                                No Image
                                            <?php endif; ?>
                                        </td>
                                        <?php if (session()->get('user_role') === 'owner'): ?>
                                            <td>
                                                <a href="/bali/paket/edit/<?= $package['package_id'] ?>" class="btn btn-warning">Edit</a>
                                                <form action="/bali/paket/delete/<?= $package['package_id'] ?>" method="post" style="display:inline;">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                                </form>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>