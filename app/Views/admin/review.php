<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                                Data Review
                            </h1>
                            <div class="page-header-subtitle">
                                Hai admin, Selamat Datang di Pengelolaan Review Customer :)
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Main page content -->
        <div class="container-xl px-4 mt-n10">
            <div class="card mb-4">
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>ID Review</th>
                                <th>ID Customer</th>
                                <th>ID Package</th>
                                <th>Rating</th>
                                <th>Review Text</th>
                                <th>Review Date</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($review as $ulasan): ?>
                            <tr>
                                <td><?php echo esc($ulasan['review_id']); ?></td>
                                <td><?php echo esc($ulasan['user_id']); ?></td>
                                <td><?php echo esc($ulasan['package_id']); ?></td>
                                <td><?php echo esc($ulasan['rating']); ?></td>
                                <td><?php echo esc($ulasan['review_text']); ?></td>
                                <td><?php echo esc($ulasan['review_date']); ?></td>
                                <td>
                                    <form action="<?php echo site_url('dashboard/review/delete/' . $ulasan['review_id']); ?>" method="post" style="display:inline;">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this review?');">Delete</button>
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
