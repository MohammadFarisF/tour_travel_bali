    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100" src="<?= base_url() ?>asset_user/img/home.jpg" alt="Explore Tour & Travel Bali" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">About Us</h6>
                    <h1 class="mb-4">Welcome to <span class="text-primary">Explore Tour & Travel Bali</span></h1>
                    <p class="mb-4">At Explore Tour & Travel Bali, we specialize in curating exceptional travel experiences on the Island of the Gods. Our mission is to make your journey in Bali truly memorable by offering top-notch services and unique adventures tailored to your desires. Let us be your guide as you uncover the hidden gems and breathtaking beauty of Bali. Join us, and create lasting memories on your next adventure!</p>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->



    <!-- Service Start -->
    <div class="container-xxl py-5">
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
    </div>
    <!-- Service End -->


    <!-- Documentation Start -->
    <div class="container-xxl py-5 destination">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Image Documentation</h6>
                <h1 class="mb-5">Documentation</h1>
            </div>
            <div class="row g-3">
                <div class="col-lg-7 col-md-6">
                    <div class="row g-3">
                        <div class="col-lg-12 col-md-12 wow zoomIn" data-wow-delay="0.1s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="asset_user/img/dokumentasi1.jpeg" alt="">
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="asset_user/img/dokumentasi4.jpeg" alt="">
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="asset_user/img/dokumentasi3.jpeg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                    <a class="position-relative d-block h-100 overflow-hidden" href="">
                        <img class="img-fluid position-absolute w-100 h-100" src="asset_user/img/dokumentasi5.jpeg" alt="" style="object-fit: cover;">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Documentation Start -->


    <!-- Package Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Packages</h6>
                <h1 class="mb-5">Awesome Packages</h1>
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
                                        echo 'Single Destination';
                                    } elseif ($package['package_type'] === 'multiple_day') {
                                        echo 'Multiple Day Package';
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
                                    <a href="<?= base_url('package-detail/' . esc($package['package_id'])); ?>" class="btn btn-sm btn-primary px-3 border-end" style="border-radius: 30px 0 0 30px;">Read More</a>
                                    <a href="https://wa.me/yourwhatsappphonenumber?text=I%20am%20interested%20in%20<?= urlencode($package['package_name']); ?>" class="btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Tanya ke WhatsApp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Process Start -->
    <div class="container-xxl py-5">
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
    </div>
    <!-- Process Start -->

    <!-- Testimonial Start -->
    <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="text-center">
                <h6 class="section-title bg-white text-center text-primary px-3">Testimonial</h6>
                <h1 class="mb-5">Our Clients Say!!!</h1>
            </div>
            <div class="owl-carousel testimonial-carousel position-relative">
                <div class="testimonial-item bg-white text-center border p-4">
                    <h5 class="mb-0">Alexander Johann Schmidt</h5>
                    <p>Germany</p>
                    <p class="mb-0">Our trip to Bali with ExploreTour & Travel Bali was one of the best holidays we have ever had. Every detail of the trip was arranged perfectly. We really enjoyed the tour to the Tegallalang Rice Terrace and snorkeling in Amed. Our tour guide was very knowledgeable and always helpful . The hotel chosen for us was very clean and comfortable, with very friendly staff. We will definitely return and recommend ExploreTour & Travel Bali to all our friends!</p>
                </div>
                <div class="testimonial-item bg-white text-center border p-4">
                    <h5 class="mb-0">Isabella Sofia Rodríguez García</h5>
                    <p>Spain</p>
                    <p class="mt-2 mb-0">Many thanks to ExploreTour & Travel Bali for making our holiday in Bali so special! Everything is professionally arranged, from transportation to tours to beautiful destinations such as Besakih Temple and Jimbaran Beach. Our tour guide was very friendly and provided lots of interesting information about Balinese culture. The accommodation is very comfortable and has stunning views. We highly recommend ExploreTour & Travel Bali!</p>
                </div>
                <div class="testimonial-item bg-white text-center border p-4">
                    <h5 class="mb-0">Jonathan Michael Williams</h5>
                    <p>USA</p>
                    <p class="mt-2 mb-0">Traveling to Bali with Explore Tour & Travel Bali is an amazing experience! Everything was very well organized, from airport pick up to daily tours to amazing places like Tanah Lot and Ubud. Our tour guide, was very friendly and informative. We also really enjoyed the snorkeling tour in Nusa Penida. Thank you for an unforgettable holiday!</p>
                </div>
                <div class="testimonial-item bg-white text-center border p-4">
                    <h5 class="mb-0">Olivia Marie Johnson</h5>
                    <p>Italy</p>
                    <p class="mt-2 mb-0">Explore Tour & Travel Bali made our holiday in Bali truly magical! Everything was perfectly organized, from the warm welcome at the airport to the comprehensive tour. Highlights include sunset at Tanah Lot and cultural dance performances in Ubud. Our guides were great, shared a lot of knowledge and were always willing to help. Highly recommend Explore Tour & Travel Bali for the perfect holiday in Bali!</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial End -->