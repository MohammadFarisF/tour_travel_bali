<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                                Data Customer
                            </h1>
                            <div class="page-header-subtitle">Hai admin, Selamat Datang di Pengelolaan Data Customer :)</div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main page content-->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>ID Customer</th>
                                <th>Nama Customer</th>
                                <th>Email</th>
                                <th>Nomor HP</th>
                                <th>Tanggal Lahir</th>
                                <th>Kewarganegaraan</th>
                                <th>Jenis Kelamin</th>
                                <th>Foto Profil</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($customer as $user): ?>
                                <tr>
                                    <td><?php echo esc($user['customer_id']); ?></td>
                                    <td><?php echo esc($user['full_name']); ?></td>
                                    <td><?php echo esc($user['email']); ?></td>
                                    <td><?php echo esc($user['phone_number']); ?></td>
                                    <td><?php echo esc($user['tgl_lahir']); ?></td>
                                    <td><?php echo esc($user['citizen']); ?></td>
                                    <td><?php echo esc($user['gender']); ?></td>
                                    <td>
                                        <?php if (!empty($user['photo'])): ?>
                                            <img src="<?= base_url('uploads/customer/' . esc($user['photo'])); ?>" alt="Foto Profil" style="width: 100px; height: auto;">
                                        <?php else: ?>
                                            No Image
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