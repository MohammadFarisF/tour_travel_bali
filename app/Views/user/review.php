<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-dark bg-gradient-primary-to-secondary pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1 class="page-header-title">
                                <div class="page-header-icon"><i data-feather="briefcase"></i></div>
                                Review
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
                    <span>Review Customer</span>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped table-bordered">
                    <thead>
                            <tr>
                                <th>Kode Booking</th>
                                <th>Nama Customer</th>
                                <th>Nama Paket</th>
                                <th>Rating</th>
                                <th>Review Text</th>
                                <th>Review Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($review as $ulasan): ?>
                                <tr>
                                    <td><?php echo esc($ulasan['booking_id']); ?></td>
                                    <td><?php echo esc($ulasan['full_name']); ?></td>
                                    <td><?php echo esc($ulasan['package_name']); ?></td>
                                    <td><?php echo esc($ulasan['rating']); ?></td>
                                    <td><?php echo esc($ulasan['review_text']); ?></td>
                                    <td><?php echo esc($ulasan['review_date']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </main>