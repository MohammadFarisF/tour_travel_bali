<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                                Destinasi Perjalanan
                            </h1>
                            <div class="page-header-subtitle">Hai admin, Selamat Datang di Pengelolaan Destinasi Perjalanan :)</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Destinasi Perjalanan</span>
                    <!-- Button berada di ujung kanan -->
                    <a href="<?= base_url(); ?>bali/destinasi/create" class="btn btn-primary">Tambah Destinasi</a>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Kode Destinasi</th>
                                <th>Kode Paket</th>
                                <th>Nama Destinasi</th>
                                <th>Lokasi</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Looping data destinasi -->
                            <?php foreach ($destinasi as $destinasi): ?>
                                <tr>
                                    <td><?php echo esc($destinasi['destination_id']); ?></td>
                                    <td></td>
                                    <td><?php echo esc($destinasi['destination_name']); ?></td>
                                    <td><?php echo esc($destinasi['location']); ?></td>
                                    <td><?php echo esc($destinasi['description']); ?></td>
                                    <td>
                                    <a href="<?= site_url('bali/destinasi/edit/' . $destinasi['destination_id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="<?= site_url('bali/destinasi/delete/' . $destinasi['destination_id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus destinasi ini?');">Hapus</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>