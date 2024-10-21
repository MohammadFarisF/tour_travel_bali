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
<script>
        function redirectToWhatsApp(event) {
            event.preventDefault();

            // Retrieve form data
            const name = document.getElementById("name").value;
            const email = document.getElementById("email").value;
            const date = document.getElementById("date").value;
            const destination = document.getElementById("select1").value;
            const message = document.getElementById("message").value;

            // Construct the WhatsApp URL with pre-filled message
            const whatsappURL = `https://wa.me/+6282236906042?text=${encodeURIComponent(`Hello, I want to book a trip\nName: ${name}\nEmail: ${email}\nDate: ${date}\nDestination: ${destination}\nMessage: ${message}`)}`;

            // Redirect to WhatsApp
            window.location.href = whatsappURL;
        }
    </script>
</body>

</html>