    <!-- About Start -->
    <style>
        .documentation-item {
            position: relative;
            overflow: hidden;
        }

        .documentation-item a {
            display: block;
            position: relative;
        }

        .documentation-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .documentation-item .text-container {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background-color: rgba(0, 0, 0, 0.7);
            /* Background hitam */
            color: white;
            padding: 10px;
            font-size: 14px;
            display: none;
            /* Defaultnya disembunyikan */
        }

        .documentation-item:hover .text-container {
            display: block;
            /* Menampilkan nama paket saat hover */
        }
    </style>
    <div class="container-fluid bg-primary hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-4 text-white mb-3 animated slideInDown">Nikmati Liburan Anda Bersama Kami</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">Rasakan keajaiban liburan di Bali seperti yang belum pernah Anda rasakan sebelumnya!</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Start -->
    <!-- <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Services</h6>
                <h1 class="mb-5">Our Services</h1>
            </div>
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-road text-primary mb-4"></i>
                            <h5>Road To View</h5>
                            <p>Enjoy a stunning journey with beautiful views along the way. We present the best routes that show the stunning natural panorama of Bali. From enchanting beaches to towering mountains, every trip will be an unforgettable visual experience.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-map-marker-alt text-primary mb-4"></i>
                            <h5>Destination</h5>
                            <p>Discover the best destinations in Bali with us. We offer a wide selection of interesting tourist attractions, ranging from cultural, natural and culinary attractions. Each destination is carefully selected to provide the best experience and sweet memories while in Bali.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-user text-primary mb-4"></i>
                            <h5>Profile Travel</h5>
                            <p>Get to know our travel services specifically designed to meet your various travel needs. With experience and dedication in the tourism industry, we are committed to providing the best service and ensuring every trip you take with us is a satisfying experience.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item rounded pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-cog text-primary mb-4"></i>
                            <h5>Custom Itineraries</h5>
                            <p>We offer a travel plan creation service tailored to your wishes and needs. With our experience and in-depth local knowledge, we will help you design the perfect trip, including the best destinations, activities and accommodation options in Bali.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Service End -->


    <!-- Documentation Start -->
    <div class="container-xxl py-5 destination">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Dokumentasi Gambar</h6>
                <h1 class="mb-5">Dokumentasi</h1>
            </div>
            <div class="owl-carousel documentation-carousel position-relative">
                <?php foreach ($reviews as $review): ?>
                    <?php
                    // Split the comma-separated image filenames into an array
                    $images = explode(',', $review['review_photo']);
                    ?>
                    <?php foreach ($images as $image): ?>
                        <div class="documentation-item position-relative bg-white text-center border">
                            <a class="position-relative d-block overflow-hidden">
                                <img class="img-fluid" src="uploads/review/<?= esc($image); ?>" alt="documentation-image">
                                <div class="text-container">
                                    <p class="mb-0"><?= esc($review['package_name']) ?></p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>


    <!-- Documentation Start -->


    <!-- Package Start -->
    <div class="container-xxl py-5" id="paket">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Paket Perjalanan</h6>
                <h1 class="mb-5">Paket Perjalanan Impian</h1>
            </div>
            <div class="row g-4 justify-content-center">

                <?php
                function truncateDescription($description, $maxLength = 300)
                {
                    if (strlen($description) <= $maxLength) {
                        return $description;
                    }
                    $truncated = substr($description, 0, $maxLength);
                    $lastSpace = strrpos($truncated, ' ');
                    if ($lastSpace !== false) {
                        $truncated = substr($truncated, 0, $lastSpace);
                    }
                    return $truncated . '...';
                }
                ?>
                <?php foreach ($packages as $package): ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="package-item">
                            <div class="overflow-hidden">
                                <img class="img-fluid" src="uploads/paket/<?= esc($package['foto']); ?>" alt="">
                            </div>
                            <div class="d-flex border-bottom">
                                <small class="flex-fill text-center border-end py-2">
                                    <i class="fa fa-map-marker-alt text-primary me-2"></i>
                                    <?php
                                    // Modify package type display
                                    if ($package['package_type'] === 'single_destination') {
                                        echo 'Paket 1 Hari';
                                    } elseif ($package['package_type'] === 'multiple_day') {
                                        echo 'Paket Multi - Hari';
                                    } else {
                                        echo esc($package['package_type']);
                                    }
                                    ?>
                                </small>
                            </div>
                            <div class="text-center p-4">
                                <h3 class="mb-0"><?= esc($package['package_name']); ?></h3>
                                <?php if ($package['price'] !== null): ?>
                                    <h5 class="mb-0">Mulai Dari Rp <?= number_format($package['price'], 0, ',', '.'); ?> Per Orang</h5>
                                <?php else: ?>
                                    <h5 class="mb-0">Harga tidak tersedia</h5> <!-- Message when no price is available -->
                                <?php endif; ?>
                                <div class="mb-3">
                                    <h6><?= number_format($package['average_rating'], 1); ?> ⭐</h6>
                                </div>
                                <p><?= esc(truncateDescription($package['description'], 300)); ?></p>
                                <div class="d-flex justify-content-center mb-2">
                                    <a href="<?= base_url('package-detail/' . esc($package['package_id'])); ?>" class="btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Pesan Paket</a>
                                    <a href="https://wa.me/6282236906042?text=Saya%20ingin%20bertanya%20-%20tanya%20mengenai%20info%20jelas%20dari%20Paket%20Perjalanan%20<?= urlencode($package['package_name']); ?>" class="btn btn-sm btn-success px-3" style="border-radius: 0 30px 30px 0;" target="_blank">Tanya ke WhatsApp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Process Start -->
    <!-- <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Process</h6>
                <h1 class="mb-5">3 Easy Steps</h1>
            </div>
            <div class="row gy-5 gx-4 justify-content-center">
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <i class="fa fa-map-marker-alt fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">Choose A Destination</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">Choose your perfect destination and embark on an unforgettable journey through Bali’s most captivating spots, from vibrant beaches to tranquil temples and scenic terraces. Discover the magic of Bali, crafted just for you.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <i class="fa fa-dollar-sign fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">Pay Online</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">Enjoy a hassle-free booking experience with our secure online payment system. Simply select your destination, book your trip, and send proof of payment easily. Your dream vacation is just a few clicks away!</p>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 text-center pt-4 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="position-relative border border-primary pt-5 pb-4 px-4">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle position-absolute top-0 start-50 translate-middle shadow" style="width: 100px; height: 100px;">
                            <i class="fa fa-car fa-3x text-white"></i>
                        </div>
                        <h5 class="mt-4">Lets Go</h5>
                        <hr class="w-25 mx-auto bg-primary mb-1">
                        <hr class="w-50 mx-auto bg-primary mt-0">
                        <p class="mb-0">Pack your bags and get ready for an unforgettable journey! With Bali Tour Explorer, every moment is designed to create lasting memories. Let's go and experience the beauty, culture, and excitement of Bali together.</p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- Process Start -->

    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Testimoni</h6>
                <h1 class="mb-5">Pendapat Klien Tentang Kami!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <?php foreach ($reviews as $review): ?>
                    <div class="testimonial-item bg-white text-center border p-4">
                        <h5 class="mb-0"><?= esc($review['full_name']) ?></h5>
                        <p class="mb-0"><strong><?= esc($review['citizen']) ?></strong></p>
                        <p><?= esc($review['package_name']) ?></p>
                        <h5 class="mt-2 mb-2">"<?= esc($review['review_text']) ?>"</h5>
                        <p class="mt-3"><?= date('d F Y', strtotime($review['review_date'])) ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Syarat dan Ketentuan</h6>
                <h1 class="mb-5">Syarat dan Ketentuan Pelanggan!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <div class="item">
                    <div class="bg-primary rounded p-4 text-white text-center">
                        <p>
                            Jika pembatalan dilakukan lebih dari 7 hari sebelum tanggal keberangkatan, <strong>100% dana akan dikembalikan</strong> (kecuali biaya administrasi).
                        </p>
                    </div>
                </div>
                <div class="item">
                    <div class="bg-primary rounded p-4 text-white text-center">
                        <p>
                            Untuk pembatalan antara 3 hingga 7 hari sebelum tanggal keberangkatan, <strong>50% dana akan dikembalikan</strong>.
                        </p>
                    </div>
                </div>
                <div class="item">
                    <div class="bg-primary rounded p-4 text-white text-center">
                        <p>
                            Jika pembatalan dilakukan kurang dari 3 hari sebelum tanggal keberangkatan, <strong>tidak ada pengembalian dana</strong>.
                        </p>
                    </div>
                </div>
                <div class="item">
                    <div class="bg-primary rounded p-4 text-white text-center">
                        <p>
                            Pembatalan dapat dilakukan melalui halaman detail pemesanan dari setiap kode pemesanan melalui tombol detail di akun pengguna, Proses pembatalan akan mengikuti kebijakan refund yang telah disebutkan sebelumnya.
                        </p>
                    </div>
                </div>
                <div class="item">
                    <div class="bg-primary rounded p-4 text-white text-center">
                        <p>
                            Pemesanan dianggap sah setelah pembayaran diterima dan dikonfirmasi, Jika bukti pembayaran belum diunggah dalam waktu <strong>24 jam</strong>, sistem berhak membatalkan pesanan.
                        </p>
                    </div>
                </div>
                <div class="item">
                    <div class="bg-primary rounded p-4 text-white text-center">
                        <p>
                            Kami tidak bertanggung jawab atas kehilangan barang pribadi selama perjalanan, Asuransi perjalanan tidak termasuk dalam harga paket.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Smooth scroll for "Paket" link
        $('a[href="#paket"]').on('click', function(event) {
            event.preventDefault(); // Prevent default jump to section
            $('html, body').animate({
                behavior: "smooth"
            }, )
        });
    </script>