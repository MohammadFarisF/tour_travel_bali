<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<div id="layoutSidenav_content">
    <main>
        <header class="page-header page-header-light pb-10">
            <div class="container-xl px-4">
                <div class="page-header-content pt-4">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mt-4">
                            <h1>
                                <div data-feather="thumbs-up" style="height:50px; width:30px"></div>
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
                <div class="card-header-primary d-flex justify-content-between align-items-center">
                    <span>Review Customer</span>
                </div>
                <div class="card-body">
                    <table id="datatablesSimple" class="table table-striped table-bordered">
                        <thead>
                            <tr class="text-black">
                                <th>Kode Booking</th>
                                <th>Nama Paket</th>
                                <th>Total Harga</th>
                                <th>Rating</th>
                                <th>Review Photo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($review as $ulasan): ?>
                                <tr>
                                    <td class="text-black">#<?php echo esc($ulasan['booking_id']); ?></td>
                                    <td class="text-black"><?php echo esc($ulasan['package_name']); ?></td>
                                    <td class="text-black">
                                        <?php
                                        $formattedAmount = number_format($ulasan['total_amount'], 0, ',', '.');
                                        echo 'Rp ' . $formattedAmount;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        // Generate star rating
                                        $rating = $ulasan['rating'];
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                echo '<i class="fa fa-star" style="color: #ffcc00;"></i>';
                                            } else {
                                                echo '<i class="fa fa-star" style="color: #d3d3d3;"></i>';
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        // Memisahkan foto-foto yang dipisahkan koma
                                        $photos = explode(',', $ulasan['review_photo']);

                                        if (!empty($ulasan['review_photo'])): ?>
                                            <button class="btn btn-info text-white" data-bs-toggle="modal" data-bs-target="#photoModal-<?php echo esc($ulasan['review_id']); ?>">Lihat Foto</button>
                                        <?php else: ?>
                                            <span>No Photo</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php if (!empty($ulasan['review_photo'])): ?>
                                    <div class="modal fade" id="photoModal-<?php echo esc($ulasan['review_id']); ?>" tabindex="-1" aria-labelledby="photoModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="photoModalLabel">Review Photo</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php foreach ($photos as $photo): ?>
                                                        <img src="<?php echo base_url('uploads/review/' . esc($photo)); ?>" class="img-fluid mb-2" alt="Review Photo">
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script>
        feather.replace();
    </script>