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
                                <th>Nama Customer</th>
                                <th>Nama Akun</th>
                                <th>Nomor Akun</th>
                                <th>Nama Pemegang Akun</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Looping data destinasi -->
                            <?php foreach ($bankpelanggan as $bp): ?>
                                <tr>
                                    <td><?php echo esc($bp['full_name']); ?></td>
                                    <td><?php echo esc($bp['account_name']); ?></td>
                                    <td><?php echo esc($bp['account_number']); ?></td>
                                    <td><?php echo esc($bp['account_holder_name']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>