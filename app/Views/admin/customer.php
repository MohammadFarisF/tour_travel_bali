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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($customer as $user): ?>
                                <tr>
                                    <td><?php echo esc($user['user_id']); ?></td>
                                    <td><?php echo esc($user['full_name']); ?></td>
                                    <td><?php echo esc($user['email']); ?></td>
                                    <td><?php echo esc($user['phone_number']); ?></td>
                                    <td>
                                        <form action="<?php echo site_url('bali/customer/delete/' . $user['user_id']); ?>" method="post" style="display:inline;">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this customer?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>