(function ($) {
  "use strict";

  // Spinner
  var spinner = function () {
    setTimeout(function () {
      if ($("#spinner").length > 0) {
        $("#spinner").removeClass("show");
      }
    }, 1);
  };
  spinner();

  // Initiate the wowjs
  new WOW().init();

  // Sticky Navbar
  $(window).scroll(function () {
    if ($(this).scrollTop() > 45) {
      $(".navbar").addClass("sticky-top shadow-sm");
    } else {
      $(".navbar").removeClass("sticky-top shadow-sm");
    }
  });

  // Dropdown on mouse hover
  $(document).ready(function () {
    const $dropdownToggle = $(".dropdown-toggle");

    $dropdownToggle.on("click", function (e) {
      const $dropdownMenu = $(this).next(".dropdown-menu");

      // Tampilkan dropdown yang diklik
      $dropdownMenu.addClass("show");
      $(this).attr("aria-expanded", "true");
    });

    // Tutup dropdown saat klik di luar dropdown
    $(document).on("click", function (e) {
      if (!$(e.target).closest(".dropdown").length) {
        $(".dropdown-menu").removeClass("show");
        $(".dropdown-toggle").attr("aria-expanded", "false");
      }
    });
  });

  // Back to top button
  $(window).scroll(function () {
    if ($(this).scrollTop() > 300) {
      $(".back-to-top").fadeIn("slow");
    } else {
      $(".back-to-top").fadeOut("slow");
    }
  });
  $(".back-to-top").click(function () {
    $("html, body").animate({ scrollTop: 0 }, 1500, "easeInOutExpo");
    return false;
  });

  // Testimonials carousel
  $(".testimonial-carousel").owlCarousel({
    autoplay: true,
    smartSpeed: 1000,
    center: true,
    margin: 24,
    dots: true,
    loop: true,
    nav: false,
    responsive: {
      0: {
        items: 1,
      },
      768: {
        items: 2,
      },
      992: {
        items: 3,
      },
    },
  });
})(jQuery);
