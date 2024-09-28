<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Explore Tour & Travel Bali</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="icon" href="<?= base_url() ?>asset_user/img/title.png" type="image/png">

    <!-- Favicon -->
    <link href="<?= base_url() ?>asset_user/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url() ?>asset_user/lib/animate/animate.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>asset_user/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="<?= base_url() ?>asset_user/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url() ?>asset_user/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>


    <!-- Template Stylesheet -->
    <link href="<?= base_url() ?>asset_user/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar & Hero Start -->
    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-40 px-lg-5 py-3 py-lg-0">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <img class="fa img-fluid" src="<?= base_url() ?>asset_user/img/logobali.png" alt="">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="<?= base_url() ?>" class="nav-item nav-link active">Home</a>
                    <a href="<?= base_url() ?>about" class="nav-item nav-link">About</a>
                    <a href="<?= base_url() ?>service" class="nav-item nav-link">Services</a>
                    <a href="<?= base_url() ?>booking" class="nav-item nav-link">Booking</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu m-0">
                            <a href="<?= base_url() ?>documentation" class="dropdown-item">Documentation</a>
                            <a href="<?= base_url() ?>review" class="dropdown-item">Testimonial</a>
                        </div>
                    </div>
                    <a href="<?= base_url() ?>contact" class="nav-item nav-link">Contact</a>
                    <span>
                        <div class="translate" id="google_translate_element"></div>

                        <script type="text/javaScript">
                            function googleTranslateElementInit() { new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');    
                            }
                        </script>
                        <script type="text/javaScript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                    </span>
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar & Hero End -->

    <div class="container-fluid bg-primary py-5 mb-5 hero-header">
        <div class="container py-5">
            <div class="row justify-content-center py-5">
                <div class="col-lg-10 pt-lg-5 mt-lg-5 text-center">
                    <h1 class="display-3 text-white mb-3 animated slideInDown">Enjoy Your Vacation With Us</h1>
                    <p class="fs-4 text-white mb-4 animated slideInDown">Experience the magic of a holiday in Bali like you've never felt before!</p>
                    <div class="position-relative w-75 mx-auto animated slideInDown">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Navbar & Hero End -->


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
                                <img class="img-fluid" src="img/dokumentasi1.jpeg" alt="">
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.3s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="img/dokumentasi4.jpeg" alt="">
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-12 wow zoomIn" data-wow-delay="0.5s">
                            <a class="position-relative d-block overflow-hidden" href="">
                                <img class="img-fluid" src="img/dokumentasi3.jpeg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6 wow zoomIn" data-wow-delay="0.7s" style="min-height: 350px;">
                    <a class="position-relative d-block h-100 overflow-hidden" href="">
                        <img class="img-fluid position-absolute w-100 h-100" src="img/dokumentasi5.jpeg" alt="" style="object-fit: cover;">
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
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/ubud.webp" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>Ubud</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">$47.84 - $54.22/Car</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p>Ready for an unforgettable trip? We offer travel packages designed to satisfy your desire to explore interesting places with the best service. From exciting adventures to relaxing relaxation, we have everything you need for a dream vacation. Order now and enjoy the beauty of Indonesia!</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-sm btn-primary px-3 border-end" data-toggle="modal" data-target="#package1Modal" style="border-radius: 30px 0 0 30px;">Read More</button>
                                <a href="booking.html" class="btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Package 1 -->
                <div class="modal fade" id="package1Modal" tabindex="-1" role="dialog" aria-labelledby="package1ModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header sticky-header">
                                <h5 class="modal-title" id="package1ModalLabel">Package Details - Ubud Palace</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Gambar Utama -->
                                <img class="img-fluid mb-3" src="img/ubud.webp" alt="Ubud Palace">

                                <!-- Deskripsi Paket -->
                                <p>Ubud is a unique and captivating tourist destination that offers a perfect blend of nature, culture, and art. Despite its increasing popularity, Ubud has managed to preserve its traditional charm and serene atmosphere, which are hallmarks of the area. With its stunning natural beauty, rich cultural heritage, and peaceful environment, Ubud stands out as one of Bali's hidden gems and is a must-visit for travelers.</p>
                                <h5>Ubud tour package: $47,84 - $54,22/car (3-4 destinations).</h5>
                                <h3>Places Of Interest :</h3>
                                <!-- Gambar Tambahan -->
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubu1.jpg" alt="Ubud Palace - Additional View 1">
                                        <p><b>Rice Terrace Swing (UBUD)</b> the most popular choice in Bali recently. The tourist destination is located on the north side of Ubud Village, Gianyar Regency.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud2.jpg" alt="Ubud Palace - Additional View 2">
                                        <p><b>Goa Gajah Temple (UBUD) </b> famously with a historical temple, an archaelogical place. An Archaelogical and Historical Temple in Bali.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud3.jpg" alt="Ubud Palace - Additional View 3">
                                        <p><b>Tirta Empul temple (UBUD)</b> is a Hindu Balinese water temple, and is considered sacred by the community. Worshippers take part in ancient cleansing rituals here and visitors are welcomed to join.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud4.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>Tegenungan Waterfall (UBUD)</b> is a beautiful natural waterfall located just a half-hour drive from Ubud. The lush greenery and picturesque falls are a great photo op to commemorate your trip to Bali.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud5.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>Luwak Coffee Plantation (UBUD)</b> or known with popular name Bali Agrotourim, is a place to see various Tropical plantations such as coffee robusta, pineapple, Balinese snake fruite (salak), plain Balinese potatoes, fruit stars, cacao, jack fruit, durian tree and many more. Experience to see how to make Balinese coffee in very traditional ways, and taste the fresh of Balinese coffee or ginger tea with green view river valley.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud6.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>Ubud Monkey Forest</b> or also called the Sacred Wenara Wana Mandala is a nature reserve area as well as a temple complex located in Ubud, Bali. This area is home to around 340 Macaca fascicularis, better known as long- tailed macaques. This herd of monkeys is divided into four groups, each of which occupies a different area in the forest.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubu7.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>Batuan Temple (UBUD)</b> is one of the most popular and beautiful village temple which is part of three major temples in a village that is calleg Tri Kahyangan, and designed with Balinese architecture with split gates, stone guardians, thatched shrines and detailed carvings.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud8.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>ATV Bike Riding Bali (UBUD)</b> activity offers an extreme, sensational, beautiful and safe adventure tour. This offers you the serenity of nature and pampers your adrenaline soul. ATV riding takes you through local forests, rice fields, rivers and place you can never imagine.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud9.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>Rafting in Bali (UBUD)</b> is an adventure tourism activity that can be used to navigate the river using a rubber boat, as well as a challenging and exciting water sports activity while enjoying the beautiful and exotic views of the villages and nature of the island of Bali. There are 5 popular rivers for rafting in Bali.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud10.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>Bali's first Zoolpgical Park (UBUD)</b> is a wondrous place where you can learn the behaviour of over 500 rare and exotic animals in a lush, tropical environment. A park where you can participate in fascinating animal adventure activities, some of which are unique experiences of ther kind in Indonesia.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud11.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>Bali Bird Park (UBUD)</b> is a 2000 square meter attraction in Gianyar that exhibits 250 species of birds and interactive bird shows.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud12.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>Taman Safari Bali (UBUD)</b> home to over a thousand animals and your finest destination for an adventurous, fun and educational experience more than just a safari.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud13.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>Celuk Village in Ubud</b> is also known as the Silver Village and that is entirely for its production of jewelry.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud14.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>Kampung Batik Tohpati (UBUD)</b> is unique! This place is the centre of Batik variety in Bali, from the authentic hand-drawn batik to woven Batik that are processed traditionally.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud15.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>Bali Batuan Village (UBUD)</b> is a famous Balinese Paintings and as such as a famous Bali tourism destinations, located about 7 kilometers north of Denpasar about and 10 kilometers south of Ubud, it is popular with center of Bali arts, and now it’s knowm for its dancing, wood panel carving and Bali Paintings Ubud.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud16.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>Mas Ubud Village</b> is a wondrous place where you can learn the behaviour of over 500 rare and exotic animals in a lush, tropical environment. A park where you can participate in fascinating animal adventure activities, some of which are unique experiences of ther kind in Indonesia.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud17.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>Tibumana Waterfall (UBUD)</b> is one of the most beautiful hidden waterfalls in Bali. It is a true hidden gem, and definitely highly recommended for thos want to enjoy beautiful scenery, cool breeze atmosphere, peace and tranquility.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud18.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>The Ubud Center</b> is one of the most famous places on Earth. The spiritual centre of Bali. From the moment you step off your flight, feel the bright energy of this magical place. Located in the heart of Bali, this town is abundant with natural beauty, rich cultural heritage and spiritualism.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud19.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>Bali Cycling Tour (UBUD)</b> is interesting activities tours to enjoy experience, education, exercise and dull of fun by ride bicycle from Ubud Rice Field, Balinese Village and Jatiluwih Rice Terrace.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud20.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>Yoga (UBUD)</b> spiritual is rooted in Balinese culture and the Hindu religion. With Bali’s mindful atmosphere, it’s no sureprise that world-class yoga studios have blossomed on the island, providing an oasis of peace for the body.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud21.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>These Cooking Classes (UBUD)</b> in Bali let you take home the tricks of Indonesia’s culinary trade, with trips to the markets and spicy tips for the perfect sambal too</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/ubud22.jpg" alt="Ubud Palace - Additional View 4">
                                        <p><b>Penglipuran Village (UBUD)</b> is one of the traditional villages of Bangli Regency, Bali Province. It’s one of 3 Villages that has been named the cleanest villages in the World. Thanks to its cleanliness and neatness, this tourism village has also won several awards including Kalpataru, ISTA (Indonesia Sustainable Tourism Award) in 2017.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="booking.html" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Duplicate the structure above for other packages -->
                <!-- Package 2 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.2s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/uluwatu.webp" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>Uluwatu/Nusa Dua</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">$41.43/Car</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p>Ready for an unforgettable trip? We offer travel packages designed to satisfy your desire to explore interesting places with the best service. From exciting adventures to relaxing relaxation, we have everything you need for a dream vacation. Order now and enjoy the beauty of Indonesia!</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-sm btn-primary px-3 border-end" data-toggle="modal" data-target="#package2Modal" style="border-radius: 30px 0 0 30px;">Read More</button>
                                <a href="booking.html" class="btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Package 2 -->
                <div class="modal fade" id="package2Modal" tabindex="-1" role="dialog" aria-labelledby="package2ModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header sticky-header">
                                <h5 class="modal-title" id="package2ModalLabel">Package Details - Uluwatu/Nusa Dua</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Gambar Utama -->
                                <img class="img-fluid mb-3" src="img/uluwatu.webp" alt="Uluwatu/Nusa Dua">

                                <!-- Deskripsi Paket -->
                                <p>Uluwatu and Nusa Dua are unique and captivating tourist destinations that offer a perfect blend of natural beauty, culture, and luxury. Uluwatu, known for its dramatic cliffs, stunning beaches, and iconic temples, maintains its traditional charm and serene atmosphere despite its rising popularity. Meanwhile, Nusa Dua, with its pristine beaches, world-class resorts, and tranquil gardens, strikes a balance between elegance and Balinese culture. Both destinations stand out as hidden gems in Bali, offering a harmonious mix of adventure, relaxation, and cultural richness, making them must-visit spots for any traveler.</p>
                                <h5>Uluwatu/Nusa Dua tour package: $41.43/car (3-4 destinations).</h5>
                                <h3>Places Of Interest :</h3>
                                <!-- Gambar Tambahan -->
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/uluwatu1.jpg" alt="uluwatu1 - Additional View 1">
                                        <p><b>Blue Point Beach (ULUWATU)</b> actually the original name of this beach is Suluban. Suluban adoption of the word ‘mesulub’ which in Balinese language means “in Bali have to sop to walk through a gap in the cliff”. This may be because the road to this beach you must go down through a narrow road between the coastal cliffs.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/uluwatu2.jpg" alt="uluwatu2 - Additional View 2">
                                        <p><b>Padang Padang Beach (ULUWATU) </b> is one of Bali’s most famous surf spots. The surf has a steady set of barrels during good weather, attracting wave riders from around the world. This beach is also a regular spot for international surfing events, such as the Rip Curl Cup Padang Padang.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/uluwatu3.jpg" alt="uluwatu3 - Additional View 3">
                                        <p><b>Dreamland Beach (ULUWATU)</b> is a beautiful beach with white sand stretch 100 meters and leaned on a steep of white stone cliff overlooking to the amazing view of Indian Ocean. This beach is very attractive for tourist including the surfers offering the elegant, tranquility and spectacular sunset view that create the romantic nuance that make it as one of the place many visited by tourist every day.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/uluwatu5.jpg" alt="uluwatu4 - Additional View 5">
                                        <p><b>Water Sport Bali (NUSA DUA)</b> is a favorite place for all tourists who come to Bali, be it foreign or domestic tourists to add a very pleasant holiday experience
                                            during your holiday in Bali. We are located precisely in the Tanjung Benoa area, Nusa Dua, Bali. A place that will give you many beautiful memories in Bali watersport games.
                                        </p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/uluwatu6.jpg" alt="uluwatu5 - Additional View 6">
                                        <p><b>Paragliding Bali (NUSA DUA)</b> is an aerospace sport using a special parachute controlled by an instructor (pilot). Enjoy the sensation of flying over cliffs along
                                            beaches in southern Bali, such as Pandawa Beach, Green Bowl Beach, Uluwatu Beach and Sawangan Beach.
                                        </p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/uluwatu7.jpg" alt="uluwatu6 - Additional View 7">
                                        <p><b>GWK (Garuda Wisnu Kencana) Cultural Park (ULUWATU)</b> is home to some of the most iconic cultural landmarks in Bali, including the magnificent Garuda Wisnu Kencana statue, which stands tall at 121 meters and is a representation of the Hindu god Visnu and his mount, the Garuda bird. Also features a range of cultural activities and perfomances, including the Kecak Garuda Wisnu dance, traditional Balinese music and dance performances, and much more.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/uluwatu8.jpg" alt="uluwatu7 - Additional View 8">
                                        <p><b>Pandawa Beach (ULUWATU)</b> located about 4 km away from the mighty GWK in Kutuh Village, South Kuta Badung. There is a lesser known beach in the most southern part of Bali, hidden among the mountainous area of Badung. Named after the five brothers in the Mahabaratha epoch, which consistes of Yudistira, Bima, Arjuna, Sahadewa and Nakula, Pandawa Beach offers you a view of the vast Indian Ocean.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/uluwatu9.jpg" alt="uluwatu8 - Additional View 9">
                                        <p><b>Uluwatu Temple</b> is a Balinese Hindu sea temple located in uluwatu. The temple is regarded as one of the sad kahyangan and is dedicated to Sang Hyang Widhi Wasa in his manifestation as Rudra.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/uluwatu10.jpg" alt="uluwatu9 - Additional View 10">
                                        <b>Penangkaran penyu (NUSA DUA)</b>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/uluwatu11.jpg" alt="uluwatu10 - Additional View 11">
                                        <p><b>Melasti Beach (ULUWATU)</b> is a beautiful beach located below a high cliff. unspoiled blue sea, make this beach to be one of the best in the region Ungasan. because many tourists who visit here, the beach melasti began repaired road to more easily reach the beach. High cliffs cleaved used as a road with many bends. from top, the road looks beautiful with limestone cliffs.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/uluwatu12.jpg" alt="uluwatu11 - Additional View 12">
                                        <p><b>Kecak and Fire Dance Show (ULUWATU)</b> is a must if you travel to Bali, that takes place at sunset time. As you enjoy the sublime sunset, watch the locals put on mesmerizing show of traditional and hypnotic Kecak Dance with swirling flames and vibrant cultural costumes. The show is perfectly timed just n time for this. There is no doubt that it will be a memorable trip to the iland.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/uluwatu13.jpg" alt="uluwatu12  - Additional View 13">
                                        <p><b>Green Bowl Beach (ULUWATU)</b> is known as one of the strongest currents on the island. A broken leash or last board could you sucked out to sea.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/uluwatu14.jpg" alt="uluwatu13 - Additional View 14">
                                        <p><b>Heli tour Bali (ULUWATU)</b> is your premier destination for breathtaking aerial adventures on the island of Bali.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="booking.html" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Package 3 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/nusapenida.jpg" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>Nusa Penida</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">$64.58 - $77.49/Car</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p>Ready for an unforgettable trip? We offer travel packages designed to satisfy your desire to explore interesting places with the best service. From exciting adventures to relaxing relaxation, we have everything you need for a dream vacation. Order now and enjoy the beauty of Indonesia!</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-sm btn-primary px-3 border-end" data-toggle="modal" data-target="#package3Modal" style="border-radius: 30px 0 0 30px;">Read More</button>
                                <a href="booking.html" class="btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Package 3 -->
                <div class="modal fade" id="package3Modal" tabindex="-1" role="dialog" aria-labelledby="package3ModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header sticky-header">
                                <h5 class="modal-title" id="package3ModalLabel">Package Details - Nusa Penida</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Gambar Utama -->
                                <img class="img-fluid mb-3" src="img/nusapenida.jpg" alt="Nusa Penida">

                                <!-- Deskripsi Paket -->
                                <p>Nusa Penida is a stunning island located southeast of Bali, renowned for its breathtaking natural beauty, dramatic coastal landscapes, and vibrant marine life. With its crystal-clear waters, striking cliffs, and pristine beaches, it offers an idyllic escape for nature lovers and adventure seekers alike. The island is known for its picturesque spots such as Keling King Beach, Angel's Billabong, and Broken Beach, each providing unique and awe-inspiring views. Whether you're looking to explore its diverse underwater world or simply relax on its serene shores, Nusa Penida promises an unforgettable experience.</p>
                                <h5>Tour Packages to Nusa Penida</h5>
                                <p> East Tour: $64.58/day/pax<br>
                                    West Tour: $64.58/day/pax<br>
                                    Tour Mix Trips: $77.49/day/pax</p>

                                <h5>This package includes:</h5>
                                <p>Minimum order: 2 pax<br>
                                    Return Speed Boat ticket (Sanur port - Nusa Penida)<br>
                                    One day trip<br>
                                    Entrance tickets to all destinations<br>
                                    Transport (car + fuel)<br>
                                    Experienced local driver/tour guide who is also a photographer<br>
                                    Private tour (not combined with other groups)<br>
                                    Lunch at a restaurant</p>
                                <h3>Places Of Interest :</h3>
                                <h5>West</h5>
                                <!-- Gambar Tambahan -->
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/penida1.jpg" alt="penida1 - Additional View 1">
                                        <p><b>Broken Beach </b> is an incredible little cove on Nusa Penida Island. The highlight of the cove and the reason it is called Broken Beach is due to the archway that wraps around the bay allowing water to flow in and out from the ocean.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/penida2.jpg" alt="penida2 - Additional View 2">
                                        <p><b>Angel’s Billabong </b> is another popular attractions on Nusa Penida with natural infinity pool is framed by rock cliffs and hangs out over the ocean overlooking Manta Point Beach.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/penida3.jpg" alt="penida3 - Additional View 3">
                                        <p><b>Kelingking Beach</b> is a place that has a well-known spot for diving because it presents a very rare sight. This spot is known as Manta Point. The history of Kelingking Beach Manta Point is known for its Manta fish (the world’s largest stingray).</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/penida4.jpg" alt="penida4 - Additional View 5">
                                        <p><b>Crystal Bay</b> is a stunning beach on the island of Nusa Penida, Bali. Crystal Bay is also a famous place for scuba diving or snorkling. And if you are very lucky you might see dolphins there.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/penida5.jpg" alt="penida5 - Additional View 6">
                                        <p><b>Paluang Cliff</b> is another amazing viewpoint and temple that is just a 5 minute drive from famous Kelingking Cliff.</p>
                                    </div>
                                    <br>
                                    <h5>East</h5>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/penida6.jpg" alt="penida6 - Additional View 7">
                                        <p><b>Diamond Beach</b> most beautiful beach on Nusa Penida, Bali. The view from the top of Diamond Beach is directly from a postcard. A stunning white beach, silky blue water, limestones and palm trees are creating a dream destination.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/penida7.jpg" alt="penida7 - Additional View 8">
                                        <p><b>Raja Lima or Thousand Islands</b> is a recommended destination located on the east coast of Nusa Penida Island. One of the various attractions offered by Pulau Seribu is the viewpoint.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/penida8.jpg" alt="penida8 - Additional View 9">
                                        <p><b>Bukit Atuh (Atuh Hill)</b> on the island of Nusa Penida has extraordinary views with the formation of small islands in the form of sharp cliffs. Tourists often capture views of the sea from the top of the hill lined with small islands when traveling to this place.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/penida9.jpg" alt="penida9 - Additional View 10">
                                        <p><b>The Batu Molenteng Tree House</b> offers an interesting experience because it can be both a tourist attraction and accommodation. The specialty of Molenteng lies in the views and natural beauty that can be seen from the tree house. The charming maritime expanse of Atuh Beach is perfect to enjoy while sitting on the balcony. Apart from that, visitors can also enjoy the best golden yellow sunrise.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/penida10.jpg" alt="penida10 - Additional View 11">
                                        <p><b>Bukit Teletubbies</b> Many of you must have watched, at least once, the Teletubbies show when you were children. The place where the Teletubbies live is a large, beautiful green land which forms green mounds resembling hills which have become known as Teletubbies Hill.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="booking.html" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Package 4 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.4s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/bedugul.jpg" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>Bedugul</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">$51.65/Car</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p>Ready for an unforgettable trip? We offer travel packages designed to satisfy your desire to explore interesting places with the best service. From exciting adventures to relaxing relaxation, we have everything you need for a dream vacation. Order now and enjoy the beauty of Indonesia!</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-sm btn-primary px-3 border-end" data-toggle="modal" data-target="#package4Modal" style="border-radius: 30px 0 0 30px;">Read More</button>
                                <a href="booking.html" class="btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Package 4 -->
                <div class="modal fade" id="package4Modal" tabindex="-1" role="dialog" aria-labelledby="package4ModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header sticky-header">
                                <h5 class="modal-title" id="package4ModalLabel">Package Details - Bedugul</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Gambar Utama -->
                                <img class="img-fluid mb-3" src="img/bedugul.jpg" alt="Bedugul">

                                <!-- Deskripsi Paket -->
                                <p>Bedugul is a famous mountain tourist area in Bali, Indonesia. Located in Tabanan Regency, about 50 kilometers from Denpasar, Bedugul is a favorite destination because of its cool air and beautiful natural views. Bedugul is surrounded by green hills, lakes and lush gardens.</p>
                                <h5>Bedugul tour package: $51.65/car (3-4 destinations).</h5>
                                <h3>Places Of Interest :</h3>
                                <!-- Gambar Tambahan -->
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/bedugul1.jpg" alt="bedugul1 - Additional View 1">
                                        <p><b>Handara iconic Gate in Bedugul</b> Bali. It’s located in the heart of Bali’s natural beauty, and our iconic gate is one of the most recognizable landmarks on the island. With its stunning architecture and picturesque surroundings, the Handara iconic Gate is the perfect spot for photos and Instagram—orthy moments.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/bedugul2.jpg" alt="bedugul2 - Additional View 2">
                                        <p><b>Banyumala Waterfall</b> is a beautiful waterfall and has 3 water drop formations. The biggest one is in the middle. The smalles ones are on the left and right. A natural pool is below it.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/bedugul3.jpg" alt="bedugul3 - Additional View 3">
                                        <p><b>Tanah Lot</b> is a rock formation off the Indonesian island of Bali. It is home to the ancient Hindu pilgrimage temple Pura Tanah Lot. Tanah Lot is claimed to be the work of the 16th-century Dang Hyang Nirartha.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/bedugul4.jpg" alt="bedugul5 - Additional View 5">
                                        <p><b>Hot Chocolate (BEDUGUL)</b> iis a center for dishes or food made from chocolate, for those of you who like dishes made from selected chocolate with a special taste, then Hot Chocolate House will be a special destination for you..</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/bedugul5.jpg" alt="bedugul6 - Additional View 6">
                                        <p><b>Hidden Hills Villas (BEDUGUL)</b> poised on the magnificent southwestern ‘Bukit’ tip of Bali with a 180 degrees unobstructured view of the infamous Uluwatu sunset, Hidden Hills Villas is the epitome of luxury and hospitality at affordable pricing.</p>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/bedugul6.jpg" alt="bedugul7 - Additional View 7">
                                        <p><b>Ulun Danu Beratan Temple (BEDUGUL)</b> is one of the nine Khayangan Jagat temples that surround the island of Bali. This temple is a place used by Hindus in Bali and Indonesia to worship the Almighty God in his manifestation as the "Tri Murti" (Brahma, Vishnu & Shiva) in his hope for the fertility of the land, prosperity and human welfare, including for the preservation of the universe.</p>
                                    </div>

                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="booking.html" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Package 5 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/gili.jpeg" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>Gili Island</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">$41.43</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p>Ready for an unforgettable trip? We offer travel packages designed to satisfy your desire to explore interesting places with the best service. From exciting adventures to relaxing relaxation, we have everything you need for a dream vacation. Order now and enjoy the beauty of Indonesia!</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-sm btn-primary px-3 border-end" data-toggle="modal" data-target="#package5Modal" style="border-radius: 30px 0 0 30px;">Read More</button>
                                <a href="booking.html" class="btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Package 5 -->
                <div class="modal fade" id="package5Modal" tabindex="-1" role="dialog" aria-labelledby="package5ModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header sticky-header">
                                <h5 class="modal-title" id="package5ModalLabel">Package Details - Gili Island</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Gambar Utama -->
                                <img class="img-fluid mb-3" src="img/gili.jpeg" alt="Gili Island">

                                <!-- Deskripsi Paket -->
                                <p>Gili Islands are a group of three small islands located off the northwest coast of Lombok, Indonesia. These islands are popular tourist destinations known for their stunning beaches, crystal-clear waters, and vibrant underwater life, making them ideal for snorkeling, diving, and relaxation.</p>
                                <h5>Gili Island tour package: $41.43/car.</h5>
                                <p> Include :<br>
                                    • Snorkling equipment<br>
                                    • Gopro camera<br>
                                    • Guide instructor<br>
                                    • Small water on the boat<br>
                                    • Max 5 person<br>
                                </p>
                                <h3>Places Of Interest :</h3>
                                <!-- Gambar Tambahan -->
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/gili1.jpg" alt="gili1 - Additional View 1">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/gili2.jpg" alt="gili2 - Additional View 2">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/gili3.jpg" alt="gili3 - Additional View 3">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/gili4.jpg" alt="gili5 - Additional View 5">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/gili5.jpg" alt="gili6 - Additional View 6">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/gili6.jpg" alt="gili7 - Additional View 7">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="booking.html" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Package 6 -->
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.6s">
                    <div class="package-item">
                        <div class="overflow-hidden">
                            <img class="img-fluid" src="img/labuhanbajo.jpg" alt="">
                        </div>
                        <div class="d-flex border-bottom">
                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-map-marker-alt text-primary me-2"></i>Labuan Bajo</small>
                        </div>
                        <div class="text-center p-4">
                            <h3 class="mb-0">$500.00</h3>
                            <div class="mb-3">
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                                <small class="fa fa-star text-primary"></small>
                            </div>
                            <p>Ready for an unforgettable trip? We offer travel packages designed to satisfy your desire to explore interesting places with the best service. From exciting adventures to relaxing relaxation, we have everything you need for a dream vacation. Order now and enjoy the beauty of Indonesia!</p>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-sm btn-primary px-3 border-end" data-toggle="modal" data-target="#package6Modal" style="border-radius: 30px 0 0 30px;">Read More</button>
                                <a href="booking.html" class="btn btn-sm btn-primary px-3" style="border-radius: 0 30px 30px 0;">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Package 6 -->
                <div class="modal fade" id="package6Modal" tabindex="-1" role="dialog" aria-labelledby="package6ModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header sticky-header">
                                <h5 class="modal-title" id="package6ModalLabel">Package Details - Gili Island</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Gambar Utama -->
                                <video class="img-fluid mb-3" controls>
                                    <source src="img/labuanbajo.mp4" type="video/mp4">
                                </video>

                                <!-- Deskripsi Paket -->
                                <p>Labuan Bajo is a small fishing town located on the western tip of Flores Island in Indonesia. It serves as the gateway to the world-renowned Komodo National Park, home to the famous Komodo dragons. Over the years, Labuan Bajo has transformed from a quiet fishing village into a thriving tourist hub, attracting visitors from around the globe.</p>
                                <h3>LABUAN BAJO TOUR PACKAGE</h3>
                                <h5>Prices start from 500$ /pax
                                    (Depending on the ship used)</h5>
                                <p><b>Price includes:</b><br>
                                    -Private Ship <br>
                                    - Professional tour guide<br>
                                    -Complete Documentation (Pilot, Drone, Camera, Gopro)<br>
                                    -car in and out<br>
                                    -2x lunch<br>
                                    -1x dinner<br>
                                    -breakfast during the trip<br>
                                    -Snorkeling equipment<br>
                                    -life jacket<br>
                                    - tourist entry ticket<br>
                                    -Ranger ticket<br>
                                    -snorkeling tickets<br>
                                    -Trekking ticket<br>
                                    -retda ticket<br>
                                    -mineral water <br>
                                    -coffee<br>
                                    -tea <br>
                                    -boat parking <br><br>




                                    Not included :<br>
                                    -flight ticket <br>
                                    -tours outside the program<br>
                                    -tiping<br><br></p>

                                <h5>3 Days 2 Nights Labuan Bajo Package</h5>

                                <p><b>I T I N E R A R Y</b>
                                    Day 1:<br>
                                    -From hometown<br>
                                    -pick up from Komodo Labuan Bajo Airport<br>
                                    -check in the ship<br>
                                    - Kelor Island (trekking, photos)<br>
                                    -Screaming (snorkeling)<br>
                                    -Kalong Island (sunset)<br>
                                    (LD)<br><br>

                                    Day 2:<br>
                                    - Padar Island (sunrise trekking)<br>
                                    -Pink Beach (photos)<br>
                                    -Komodo Island (short tree)<br>
                                    -Taka Makasar (photos)<br>
                                    -Manta Point (Snorkeling)<br>
                                    -Night rest<br>
                                    (LD)<br><br>

                                    Day 3:<br>
                                    -Kanawa Island (photos, snorkeling)<br>
                                    -sailing back to Labuan Bajo<br>
                                    -Delivery to hotel/airport<br>
                                    -trip completed (BL)<br>


                                    NB: The program can change depending on conditions and weather<br><br></p>

                                <h5>4 Days 3 Nights Labuan Bajo Package</h5>
                                <p><b>I T I N E R A R Y</b><br>
                                    day 1:<br>
                                    -From hometown<br>
                                    -Pick up at Komodo Labuan Bajo Airport<br>
                                    -Check at the Hotel<br>
                                    - dinner at a local restaurant<br>
                                    -drop hotel for a night's rest (D)<br><br>

                                    day 2:<br>
                                    - pick up from hotel to ship<br>
                                    -Kanawa Island (beach, photos, snorkeling)<br>
                                    - Kelor Island (Trekking photos, beach)<br>
                                    -Screaming (snorkeling)<br>
                                    -Kalong Island (sunset) (LD)<br><br>

                                    Day 3:<br>
                                    - Padar Island (sunrise trekking, photos)<br>
                                    -Pink Beach (relaxing on the beach, taking photos)<br>
                                    -Komodo Island (short tree)<br>
                                    -return to Labuan Bajo<br>
                                    -Drop Hotel (free time)<br><br>

                                    day 4:<br>
                                    - Amelia Ocean View<br>
                                    -Typical Flores souvenirs<br>
                                    -check at Komodo Labuan Bajo Airport<br>
                                    -trip completed (BL)<br>


                                    NB: The program can change according to conditions and weather<br><br></p>


                                <h3>Labuan Bajo trip :</h3>
                                <!-- Gambar Tambahan -->
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/labuan1.jpeg" alt="labuanbajo1 - Additional View 1">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/labuan2.jpeg" alt="labuanbajo2 - Additional View 2">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/labuan3.jpeg" alt="labuanbajo3 - Additional View 3">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/labuan4.jpeg" alt="labuanbajo4 - Additional View 5">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/labuan5.jpeg" alt="labuanbajo4 - Additional View 5">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/labuan6.jpeg" alt="labuanbajo4 - Additional View 5">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/labuan7.jpeg" alt="labuanbajo4 - Additional View 5">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/labuan8.jpeg" alt="labuanbajo4 - Additional View 5">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/labuan9.jpeg" alt="labuanbajo4 - Additional View 5">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <img class="img-fluid" src="img/labuan10.jpeg" alt="labuanbajo4 - Additional View 5">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a href="booking.html" class="btn btn-primary">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Package End -->


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


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Contact</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Jl. Mekar II Blok C 2 No.2 Pemogan, Denpasar Selatan, Indonesia</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+62 822-3690-6042</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>explorebali52@gmail.com</p>

                </div>
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Gallery</h4>
                    <div class="row g-2 pt-2">
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/dokumentasi8.jpeg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/dokumentasi2.jpeg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/dokumentasi6.jpeg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/dokumentasi5.jpeg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/dokumentasi4.jpeg" alt="">
                        </div>
                        <div class="col-4">
                            <img class="img-fluid bg-light p-1" src="img/dokumentasi3.jpeg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url() ?>asset_user/lib/wow/wow.min.js"></script>
    <script src="<?= base_url() ?>asset_user/lib/easing/easing.min.js"></script>
    <script src="<?= base_url() ?>asset_user/lib/waypoints/waypoints.min.js"></script>
    <script src="<?= base_url() ?>asset_user/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="<?= base_url() ?>asset_user/lib/tempusdominus/js/moment.min.js"></script>
    <script src="<?= base_url() ?>asset_user/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="<?= base_url() ?>asset_user/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url() ?>asset_user/js/main.js"></script>
</body>

</html>