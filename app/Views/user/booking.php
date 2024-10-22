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
                        <p class="mb-0">Explore the wonders of Bali and select your dream destination! From stunning beaches and vibrant nightlife to serene temples and lush rice terraces, we offer a variety of locations to suit your desires. Let us help you find the perfect spot for your next adventure.</p>
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
                        <p class="mb-0">Enjoy a hassle-free booking experience with our secure online payment system. Simply choose your destination, book your trip, and pay online with ease. Your dream vacation is just a few clicks away!</p>
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

    <!-- Package Start -->
    <div class="container-xxl py-5">
    <div class="container">
        <div class="text-center pb-4">
            <h6 class="section-title bg-white text-center text-primary px-3">Packages</h6>
            <h1 class="mb-5">Our Tour Packages</h1>
        </div>
        <div class="row gy-5 gx-4 justify-content-center">
            <?php if (!empty($packages) && is_array($packages)): ?>
                <?php foreach ($packages as $package): ?>
                    <div class="col-lg-4 col-sm-6 text-center pt-4">
                        <div class="position-relative border border-primary pt-5 pb-4 px-4">
                            <img src="<?= base_url('uploads/paket/' . esc($package['foto'])); ?>" alt="<?= esc($package['package_name']); ?>" class="img-fluid mb-3" style="width:100%; height:200px; object-fit:cover;">
                            <h5 class="mt-4"><?= esc($package['package_name']); ?></h5>
                            <hr class="w-25 mx-auto bg-primary mb-1">
                            <hr class="w-50 mx-auto bg-primary mt-0">
                            <p class="mb-0"><?= esc($package['description']); ?></p>
                            <p class="text-primary mt-3"><strong>Rp <?= number_format($package['harga'], 0, ',', '.'); ?></strong></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No packages available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
     <!-- Package End -->


    <!-- Booking Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center pb-4 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Booking</h6>
                <h1 class="mb-5">Book A Tour</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-7">
                    <div class="wow fadeInUp" data-wow-delay="0.3s">
                        <form id="bookingForm" onsubmit="redirectToWhatsApp(event)">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="name" placeholder="Your Name" required>
                                        <label for="name">Your Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="email" class="form-control" id="email" placeholder="Your Email" required>
                                        <label for="email">Your Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="text" placeholder="Address" required>
                                        <label for="text">Address</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating date" id="date3" data-target-input="nearest">
                                        <input type="date" class="form-control datetimepicker-input" id="date" placeholder="Date" data-target="#date3" data-toggle="datetimepicker" required />
                                        <label for="date">Date</label>
                                    </div>
                                </div>
                                <div class="destination-label">
                                    <label>Select Destinations:</label>
                                </div>
                                <div class="destination-container">
                                    <div class="destination-label">
                                        <input id="destination1" type="checkbox" />
                                        <label for="destination1">Destination 1</label>
                                    </div>
                                    <div class="destination-label">
                                        <input id="destination2" type="checkbox" />
                                        <label for="destination2">Destination 2</label>
                                    </div>
                                    <div class="destination-label">
                                        <input id="destination3" type="checkbox" />
                                        <label for="destination3">Destination 3</label>
                                    </div>
                                    <div class="destination-label">
                                        <input id="destination4" type="checkbox" />
                                        <label for="destination4">Destination 4</label>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <label class="text-gray-700" for="person">
                                        Person
                                    </label>
                                    <input id="person" min="1" type="number" value="1" />
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Special Request" id="message" style="height: 100px" required></textarea>
                                        <label for="message">Special Request</label>
                                    </div>
                                </div>
                                <div class="flex justify-end space-x-4 mt-6">
                                    <button class="button button-cancel" type="button">
                                        Cancel
                                    </button>
                                    <button class="button button-book" type="submit">
                                        Booking
                                    </button>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="wow fadeInUp" data-wow-delay="0.5s">
                        <div class="contact-info bg-light rounded p-3 mb-4">
                            <h5><i class="fa fa-map-marker-alt text-primary me-3"></i>Office</h5>
                            <p class="mb-2">Jl. Mekar II Blok C 2 No.2 Pemogan, Denpasar Selatan, Indonesia</p>
                        </div>
                        <div class="contact-info bg-light rounded p-3 mb-4">
                            <h5><i class="fa fa-phone-alt text-primary me-3"></i>Phone</h5>
                            <p class="mb-2">+62 822-3690-6042</p>
                        </div>
                        <div class="contact-info bg-light rounded p-3 mb-4">
                            <h5><i class="fa fa-envelope-open text-primary me-3"></i>Email</h5>
                            <p class="mb-2">explorebali52@gmail.com</p>
                        </div>
                        <div class="contact-info bg-light rounded p-3 mb-4">
                            <h5><i class="fa fa-clock text-primary me-3"></i>Opening Hours</h5>
                            <p class="mb-2">24 Hours</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Booking End -->