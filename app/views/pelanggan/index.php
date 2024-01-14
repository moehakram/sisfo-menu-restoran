<!-- ======= Hero Section ======= -->
<section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
      <div class="row justify-content-between gy-5">
        <div
          class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
          <h2 data-aos="fade-up">Nikmati Hidangan Halal dan Lezat</h2>
          <p data-aos="fade-up" data-aos-delay="100">"Halal dan Lezat: Sentuhan Kelezatan dalam Setiap Gigitan!"</p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="/pesan-menu" class="btn-book-a-table">pesan menu</a>
          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
          <img src="assets/img/hero-img.png" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>
    </div>
  </section><!-- End Hero Section -->
<!-- ======= Menu Section ======= -->
<section id="menu" class="menu">
 <div class="container" data-aos="fade-up">

   <div class="section-header">
     <h2>Menu Kami</h2>
     <p>cek Menu<span>FOODHUNT</span></p>
   </div>

   <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
     <li class="nav-item">
       <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#menu-makanan">
         <h4>Makanan</h4>
       </a>
     </li><!-- End tab nav item -->

     <li class="nav-item">
       <a class="nav-link" data-bs-toggle="tab" data-bs-target="#menu-minuman">
         <h4>Minuman</h4>
       </a><!-- End tab nav item -->
   </ul>

   <div class="tab-content" data-aos="fade-up" data-aos-delay="300">

     <div class="tab-pane fade active show" id="menu-makanan">

       <div class="tab-header text-center">
         <p>Menu</p>
         <h3>Makanan</h3>
       </div>

       <div class="row gy-5">

       <?php foreach($data['makanan'] as $makanan): ?>
         <div class="col-lg-4 menu-item">
           <a href="<?= SRC_UPLOAD.'entri-makanan/'.$makanan->gambar; ?>" class="glightbox"><img src="<?= SRC_UPLOAD.'entri-makanan/'.$makanan->gambar; ?>"
               class="menu-img img-fluid" alt=""></a>
           <h4><?= $makanan->nama ; ?></h4>
           <p class="ingredients">
           </p>
           <p class="price">
           <?= formatRupiah($makanan->harga) ; ?>
           </p>
         </div>
      <?php endforeach; ?>
       </div>
     </div>
     <!-- End Menu makanan Content -->

     <div class="tab-pane fade" id="menu-minuman">

       <div class="tab-header text-center">
         <p>Menu</p>
         <h3>Minuman</h3>
       </div>

       <div class="row gy-5">

       <?php foreach($data['minuman'] as $minuman): ?>
        <div class="col-lg-4 menu-item">
           <a href="<?= SRC_UPLOAD.'entri-minuman/'.$minuman->gambar; ?>" class="glightbox"><img src="<?= SRC_UPLOAD.'entri-minuman/'.$minuman->gambar; ?>"
               class="menu-img img-fluid" alt=""></a>
           <h4><?= $minuman->nama ; ?></h4>
           <p class="ingredients">
           </p>
           <p class="price">
           <?= formatRupiah($minuman->harga) ; ?>
           </p>
         </div>
      <?php endforeach; ?>
       </div>
     </div><!-- End minuman Menu Content -->
   
   </div>

 </div>
</section><!-- End Menu Section -->

<!-- ======= About Section ======= -->
<section id="about" class="about">
 <div class="container" data-aos="fade-up">

   <div class="section-header">
     <h2>Tentang Kami</h2>
     <p>Pelajarai Lebih Lanjut <span>Tentang Kami</span></p>
   </div>

   <div class="row gy-4">
     <div class="col-lg-7 position-relative about-img" style="background-image: url(assets/img/about.jpg) ;"
       data-aos="fade-up" data-aos-delay="150">
       <div class="call-us position-absolute">
         <h4>kontak kami</h4>
         <p>+62 8125507527</p>
       </div>
     </div>
     <div class="col-lg-5 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300">
       <div class="content ps-0 ps-lg-5">
         <p class="fst-italic">
           Selamat datang di "FOODHUNT" kami! Kami bangga memperkenalkan diri sebagai mitra terpercaya dalam
           perjalanan reservasi Anda. Di sini, kami ingin membagikan wawasan mendalam tentang identitas kami,
           filosofi pelayanan, dan komitmen kami untuk memberikan pengalaman reservasi yang tak terlupakan.

         </p>
         <ul>
           <li><i class="bi bi-check2-all"></i> Kami bukan sekadar platform reservasi; kami adalah penyedia layanan
             yang berdedikasi untuk memastikan setiap langkah perjalanan Anda mulus dan memuaskan. Tim kami terdiri
             dari individu yang bersemangat dan berpengalaman, yang bersatu demi memberikan pengalaman reservasi
             yang luar biasa.
           </li>
           <li><i class="bi bi-check2-all"></i> Dengan keahlian kami dalam industri perjalanan, kami menawarkan
             meja di restoran favorit Anda. Kami memberikan pengalaman yang lebih, dengan pemikiran desain yang
             mengutamakan kebutuhan dan kenyamanan Anda.
           </li>
           <li><i class="bi bi-check2-all"></i>Pelajari proses reservasi kami yang mudah dan efisien. Dari
             pencarian hingga konfirmasi, kami berusaha menyederhanakan setiap langkah, memberikan Anda kendali
             penuh atas rencana perjalanan Anda. Temukan cara kami menjadikan reservasi sebagai pengalaman yang
             menyenangkan.
           </li>
         </ul>
         <p>
           Kami percaya dalam memberikan pelayanan pelanggan yang unggul. Jangan ragu untuk menghubungi tim
           dukungan kami jika Anda memiliki pertanyaan, masukan, atau butuh bantuan. Kami siap membantu Anda setiap
           saat.

           Terima kasih telah memilih kami sebagai mitra perjalanan Anda. Kami berharap Anda menikmati setiap momen
           perjalanan yang kami bantu fasilitasi. Untuk reservasi yang mudah, pengalaman yang tak terlupakan, dan
           pelayanan terbaik, Anda berada di tempat yang tepat.
         </p>

       </div>
     </div>
   </div>

 </div>
</section><!-- End About Section -->

<!-- ======= Why Us Section ======= -->
<section id="why-us" class="why-us section-bg">
 <div class="container" data-aos="fade-up">

   <div class="row gy-4">

     <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
       <div class="why-box">
         <h3>Mengapa harus pilih FOODHUNT ?</h3>
         <p>Kami bukan sekadar platform reservasi; kami adalah penyedia layanan yang berdedikasi untuk memastikan
           setiap langkah perjalanan Anda mulus dan memuaskan. Tim kami terdiri dari individu yang bersemangat dan
           berpengalaman, yang bersatu demi memberikan pengalaman reservasi yang luar biasa.
         </p>
         <div class="text-center">
           <a href="#" class="more-btn">Pelajari selengkapnya<i class="bx bx-chevron-right"></i></a>
         </div>
       </div>
     </div><!-- End Why Box -->

     <div class="col-lg-8 d-flex align-items-center">
       <div class="row gy-4">

         <div class="col-xl-4" data-aos="fade-up" data-aos-delay="200">
           <div class="icon-box d-flex flex-column justify-content-center align-items-center">
             <i class="bi bi-clipboard-data"></i>
             <h4>Pengalaman Reservasi yang Lebih</h4>
             <p>Dengan keahlian kami dalam industri perjalanan, kami menawarkan meja di restoran favorit Anda. Kami
               memberikan pengalaman yang lebih, dengan pemikiran desain yang mengutamakan kebutuhan dan kenyamanan
               Anda.</p>
           </div>
         </div><!-- End Icon Box -->

         <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
           <div class="icon-box d-flex flex-column justify-content-center align-items-center">
             <i class="bi bi-gem"></i>
             <h4>Bagaimana Kami Bekerja</h4>
             <p>
               Pelajari proses reservasi kami yang mudah dan efisien. Dari pencarian hingga konfirmasi, kami
               berusaha menyederhanakan setiap langkah, memberikan Anda kendali penuh atas rencana perjalanan Anda.
               Temukan cara kami menjadikan reservasi sebagai pengalaman yang menyenangkan.
             </p>
           </div>
         </div><!-- End Icon Box -->

         <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
           <div class="icon-box d-flex flex-column justify-content-center align-items-center">
             <i class="bi bi-inboxes"></i>
             <h4>Kemitraan dan Ulasan</h4>
             <p>
               Kami membangun kemitraan yang kuat dengan pemilik properti dan penyedia layanan untuk memastikan
               Anda mendapatkan yang terbaik dari destinasi pilihan Anda. Selain itu, baca ulasan dari pelanggan
               sebelumnya dan lihat bagaimana pengalaman mereka dengan kami.
             </p>
           </div>
         </div><!-- End Icon Box -->

       </div>
     </div>

   </div>

 </div>
</section><!-- End Why Us Section -->

<!-- ======= Stats Counter Section ======= -->
<section id="stats-counter" class="stats-counter">
 <div class="container" data-aos="zoom-out">

   <div class="row gy-4">

     <div class="col-lg-3 col-md-6">
       <div class="stats-item text-center w-100 h-100">
         <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1"
           class="purecounter"></span>
         <p>Klien</p>
       </div>
     </div><!-- End Stats Item -->

     <div class="col-lg-3 col-md-6">
       <div class="stats-item text-center w-100 h-100">
         <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1"
           class="purecounter"></span>
         <p>Proyek</p>
       </div>
     </div><!-- End Stats Item -->

     <div class="col-lg-3 col-md-6">
       <div class="stats-item text-center w-100 h-100">
         <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1"
           class="purecounter"></span>
         <p>Jam Dukungan</p>
       </div>
     </div><!-- End Stats Item -->

     <div class="col-lg-3 col-md-6">
       <div class="stats-item text-center w-100 h-100">
         <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1"
           class="purecounter"></span>
         <p>Pekerja</p>
       </div>
     </div><!-- End Stats Item -->

   </div>

 </div>
</section><!-- End Stats Counter Section -->


<section id="chefs" class="chefs section-bg">
 <div class="container" data-aos="fade-up">

   <div class="section-header">
     <h2>Koki</h2>
     <p>Para Koki <span>Profesional</span> Kami</p>
   </div>

   <div class="row gy-4">

     <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
       <div class="chef-member">
         <div class="member-img">
           <img src="assets/img/chefs/chefs-1.jpg" class="img-fluid" alt="">
           <div class="social">
             <a href=""><i class="bi bi-twitter"></i></a>
             <a href=""><i class="bi bi-facebook"></i></a>
             <a href=""><i class="bi bi-instagram"></i></a>
             <a href=""><i class="bi bi-linkedin"></i></a>
           </div>
         </div>
         <div class="member-info">
           <h4>Risaldy</h4>
           <span>Master Chef</span>
           <p>Mau tidak mau karena melarikan diri. Penderitaan atau kebahagiaan dan waktu. Terikat pada diri
             sendiri yang terikat oleh yang otomatis. Pemakaian hak hukum minimal karena tubuh dan kebahagiaan.</p>
         </div>
       </div>
     </div><!-- End Chefs Member -->

     <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
       <div class="chef-member">
         <div class="member-img">
           <img src="assets/img/chefs/chefs-2.jpg" class="img-fluid" alt="">
           <div class="social">
             <a href=""><i class="bi bi-twitter"></i></a>
             <a href=""><i class="bi bi-facebook"></i></a>
             <a href=""><i class="bi bi-instagram"></i></a>
             <a href=""><i class="bi bi-linkedin"></i></a>
           </div>
         </div>
         <div class="member-info">
           <h4>Puput</h4>
           <span>Drink Maker</span>
           <p>hidup itu seperti secangkir teh, bagaimana rasanya tergantung bagaimana kamu meraciknya</p>
         </div>
       </div>
     </div><!-- End Chefs Member -->

     <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
       <div class="chef-member">
         <div class="member-img">
           <img src="assets/img/chefs/chefs-3.jpg" class="img-fluid" alt="">
           <div class="social">
             <a href=""><i class="bi bi-twitter"></i></a>
             <a href=""><i class="bi bi-facebook"></i></a>
             <a href=""><i class="bi bi-instagram"></i></a>
             <a href=""><i class="bi bi-linkedin"></i></a>
           </div>
         </div>
         <div class="member-info">
           <h4>Muh. Bahrul</h4>
           <span>Cook</span>
           <p>Memasak itu adalah seni, imajinasi, dan kreativitas yang sangat tinggi pada saat mengolah makanan </p>
         </div>
       </div>
     </div><!-- End Chefs Member -->

   </div>

 </div>
</section><!-- End Chefs Section -->

<!-- ======= Gallery Section ======= -->
<section id="gallery" class="gallery section-bg">
 <div class="container" data-aos="fade-up">

   <div class="section-header">
     <h2>Galeri</h2>
     <p>Cek <span>Galeri Restoran Kami</span></p>
   </div>

   <div class="gallery-slider swiper">
     <div class="swiper-wrapper align-items-center">
       <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
           href="assets/img/gallery/gallery-1.jpg"><img src="assets/img/gallery/gallery-1.jpg" class="img-fluid"
             alt=""></a></div>
       <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
           href="assets/img/gallery/gallery-2.jpg"><img src="assets/img/gallery/gallery-2.jpg" class="img-fluid"
             alt=""></a></div>
       <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
           href="assets/img/gallery/gallery-3.jpg"><img src="assets/img/gallery/gallery-3.jpg" class="img-fluid"
             alt=""></a></div>
       <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
           href="assets/img/gallery/gallery-4.jpg"><img src="assets/img/gallery/gallery-4.jpg" class="img-fluid"
             alt=""></a></div>
       <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
           href="assets/img/gallery/gallery-5.jpg"><img src="assets/img/gallery/gallery-5.jpg" class="img-fluid"
             alt=""></a></div>
       <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
           href="assets/img/gallery/gallery-6.jpg"><img src="assets/img/gallery/gallery-6.jpg" class="img-fluid"
             alt=""></a></div>
       <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
           href="assets/img/gallery/gallery-7.jpg"><img src="assets/img/gallery/gallery-7.jpg" class="img-fluid"
             alt=""></a></div>
       <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
           href="assets/img/gallery/gallery-8.jpg"><img src="assets/img/gallery/gallery-8.jpg" class="img-fluid"
             alt=""></a></div>
     </div>
     <div class="swiper-pagination"></div>
   </div>

 </div>
</section><!-- End Gallery Section -->

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
 <div class="container" data-aos="fade-up">

   <div class="section-header">
     <h2>Kontak</h2>
     <p>Butuh Bantuan? <span>Hubungi Kami</span></p>
   </div>

   <div class="mb-3">
     <iframe style="border:0; width: 100%; height: 350px;"
       src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3973.772055874005!2d119.48308089999999!3d-5.140362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dbee33495a4f597%3A0xa374c458c000bb06!2sUniversitas%20DIPA%20Makassar!5e0!3m2!1sid!2sid!4v1701927936030!5m2!1sid!2sid"
       frameborder="0" allowfullscreen></iframe>
   </div><!-- End Google Maps -->

   <div class="row gy-4">

     <div class="col-md-6">
       <div class="info-item  d-flex align-items-center">
         <i class="icon bi bi-map flex-shrink-0"></i>
         <div>
           <h3>Alamat Kami</h3>
           <p>Jl. Perintis Kemerdekaan No.KM.9, Tamalanrea Indah, Kec. Tamalanrea, <br>Kota Makassar, Sulawesi
             Selatan 90245<br></p>
         </div>
       </div>
     </div><!-- End Info Item -->

     <div class="col-md-6">
       <div class="info-item d-flex align-items-center">
         <i class="icon bi bi-envelope flex-shrink-0"></i>
         <div>
           <h3>Email</h3>
           <p>akram@gmail.com</p>
         </div>
       </div>
     </div><!-- End Info Item -->

     <div class="col-md-6">
       <div class="info-item  d-flex align-items-center">
         <i class="icon bi bi-telephone flex-shrink-0"></i>
         <div>
           <h3>Hubungi Kami</h3>
           <p>081255075297</p>
         </div>
       </div>
     </div><!-- End Info Item -->

     <div class="col-md-6">
       <div class="info-item  d-flex align-items-center">
         <i class="icon bi bi-share flex-shrink-0"></i>
         <div>
           <h3>Jam Buka</h3>
           <div><strong>Senin-Sabtu:</strong> 09:00 Wita - 22:00 Wita;
             <strong>Minggu:</strong> Tutup
           </div>
         </div>
       </div>
     </div><!-- End Info Item -->

   </div>

 </div>
</section><!-- End Contact Section -->
