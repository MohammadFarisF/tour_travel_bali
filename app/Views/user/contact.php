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

<!-- Contact Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h6 class="section-title bg-white text-center text-primary px-3">Hubungi Kami</h6>
            <h1 class="mb-5">Hubungi Untuk Pertanyaan Apapun</h1>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                <h5>Hubungi Kami</h5>
                <p class="mb-4">Jika Anda memiliki keluhan atau masukan, silakan isi formulir berikut, terima kasih :)</p>
                <div class="d-flex align-items-center mb-4">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                        <i class="fa fa-map-marker-alt text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-primary">Kantor</h5>
                        <p class="mb-0">Jl. Mekar II Blok C 2 No.2 Pemogan, Denpasar Selatan, Indonesia</p>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-4">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                        <i class="fa fa-phone-alt text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-primary">Nomor Telepon</h5>
                        <p class="mb-0">+62 822-3690-6042</p>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary" style="width: 50px; height: 50px;">
                        <i class="fa fa-envelope-open text-white"></i>
                    </div>
                    <div class="ms-3">
                        <h5 class="text-primary">Email</h5>
                        <p class="mb-0">explorebali52@gmail.com</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                <iframe class="position-relative rounded w-100 h-100"
                    src="https://www.google.com/maps/d/u/0/embed?mid=1FAiK8VckB_-cQtEWm8u7IahZvEE&hl=en&ie=UTF8&msa=0&t=h&ll=-8.450639000000017%2C115.13397199999999&spn=0.950856%2C1.167297&z=9&output=embed"
                    frameborder="0" style="min-height: 300px; border:0;" allowfullscreen="" aria-hidden="false"
                    tabindex="0"></iframe>
            </div>
            <div class="col-lg-4 col-md-12 wow fadeInUp" data-wow-delay="0.5s">
                <form onsubmit="sendWhatsAppMessage(event)">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" placeholder="Nama Anda">
                                <label for="name">Nama Anda</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" placeholder="Email Anda">
                                <label for="email">Email Anda</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="subject" placeholder="Subjek">
                                <label for="subject">Subjek</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Tinggalkan pesan di sini" id="message" style="height: 100px"></textarea>
                                <label for="message">Pesan</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-3" type="submit">Kirim Pesan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<!-- Custom Email Integration Script -->
<script>
    function sendEmail(event) {
        event.preventDefault();
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var subject = document.getElementById('subject').value;
        var message = document.getElementById('message').value;

        var recipientEmail = 'explorebali52@gmail.com'; // Ganti dengan alamat email Anda
        var mailSubject = encodeURIComponent(subject);
        var mailBody = encodeURIComponent(`Nama: ${name}\nEmail: ${email}\n\nPesan:\n${message}`);

        var mailtoLink = `mailto:${recipientEmail}?subject=${mailSubject}&body=${mailBody}`;

        window.open(mailtoLink, '_self');
    }
</script>