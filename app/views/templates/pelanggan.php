<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $data['title']??'FOODHUNT' ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <!-- <link href="assets/img/favicon.png" rel="icon"> -->
    <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= SRC_PUBLIC; ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= SRC_PUBLIC; ?>assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= SRC_PUBLIC; ?>assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= SRC_PUBLIC; ?>assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="<?= SRC_PUBLIC; ?>assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= SRC_PUBLIC; ?>assets/css/main.css" rel="stylesheet">


    <!-- tess -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <link href="<?= SRC_PUBLIC; ?>src/estilo.css" rel="stylesheet">
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="container d-flex align-items-center justify-content-between">

            <a href="/home" class="logo d-flex align-items-center me-auto me-lg-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <!-- <img src="assets/img/logo.png" alt=""> -->
                <h1><span>FOODHUNT</span></h1>
            </a>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a href="/home#hero">Home</a></li>
                    <li><a href="/home#menu">Menu</a></li>
                    <li><a href="/home#about">About</a></li>
                    <li><a href="/home#chefs">Chefs</a></li>
                    <li><a href="/home#gallery">Gallery</a></li>
                    <li><a href="/home#contact">Contact</a></li>
                    <li class="keranjanganku"><a href="/pesan-menu"><i class="fa-solid fa-bag-shopping"></i>Pesan</a></li>
                    <li class="dropdown"><a href="#"><span>Akun</span> <i
                                class="bi bi-chevron-down dropdown-indicator"></i></a>
                        <ul>
                            <li><a href="/user/profile">Profile</a></li>
                            <li><a href="/user/password">Password</a></li>
                        </ul>
                    </li>
                </ul>
            </nav><!-- .navbar -->

            <a class="btn-book-a-table" href="/user/logout">Logout</a>
            <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
            <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

        </div>
    </header><!-- End Header -->

    <main id="main">
        {{content}}
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="container">
            <div class="row gy-3">
                <div class="col-lg-3 col-md-6 d-flex">
                    <i class="bi bi-geo-alt icon"></i>
                    <div>
                        <h4>Address</h4>
                        <p>Jl. Perintis Kemerdekaan No.KM.9, Tamalanrea Indah, Kec. Tamalanrea, <br>Kota Makassar,
                            Sulawesi Selatan
                            90245<br>
                        </p>
                    </div>

                </div>

                <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-telephone icon"></i>
                    <div>
                        <h4>Reservations</h4>
                        <p>
                            <strong>Phone:</strong>082111333444<br>
                            <strong>Email:</strong> info@foodhunt.com<br>
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links d-flex">
                    <i class="bi bi-clock icon"></i>
                    <div>
                        <h4>Opening Hours</h4>
                        <p>
                            <strong>Senin-Sabtu: 11AM</strong> - 23PM<br>
                            Minggu: Tutup
                        </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 footer-links">
                    <h4>Follow Us</h4>
                    <div class="social-links d-flex">
                        <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container">
            <div class="copyright">
                &copy; Copyright <strong><span>FOODHUNT</span></strong>.MUH. AKRAM
            </div>
        </div>
        </div>

    </footer><!-- End Footer -->
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="<?= SRC_PUBLIC; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= SRC_PUBLIC; ?>assets/vendor/aos/aos.js"></script>
    <script src="<?= SRC_PUBLIC; ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="<?= SRC_PUBLIC; ?>assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="<?= SRC_PUBLIC; ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="<?= SRC_PUBLIC; ?>vendor/jquery/jquery.min.js"></script>
    <!-- Template Main JS File -->
    <script src="<?= SRC_PUBLIC; ?>assets/js/main.js"></script>
    
      <!-- sweet allert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
  <script src="<?= SRC_PUBLIC; ?>src/app.js"></script>

</body>

</html>