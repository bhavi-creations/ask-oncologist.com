 <!-- ======= Footer ======= -->
 <footer id="footer">
     <div class="footer-top">
       <div class="container">
         <div class="row">
           <div class="col-md-4 d-flex flex-row justify-content-center">
             <div class="footer-info">
               <!-- <a href="index.php" class="logo me-auto "><img src="assets/img/oncoligist/Oncology logo.png" style="height:350px;" alt=""></a> -->
               <a href="index.php" class="img-fluid">
                 <img
                   src="assets/img/oncoligist/Oncology logo.png"
                   style="height: 350px"
                   alt="" /></a>
             </div>
             <!-- <div class="footer-info d-block d-xl-none">
              <a href="index.php" class="logo me-auto "><img src="assets/img/oncoligist/Oncology logo.png" class="img-fluid" alt=""></a>

            </div> -->
           </div>

           <div class="col-md-4 d-flex flex-row justify-content-center">
             <div class="footer-info  d-none d-lg-block">

               <a href="index.php" class="img-fluid">
                 <img
                   src="assets/img/oncoligist/ask_text.png"
                   style="height: 350px;"
                   alt=""
                   class="txt_ask" /></a>
             </div>
             <div class="footer-info  d-none d-md-block d-lg-none">

               <a href="index.php" class="img-fluid">
                 <img
                   src="assets/img/oncoligist/ask_text.png"
                   style="height: 250px;margin-top: 50px;"
                   alt="" /></a>
             </div>
             <div class="footer-info   d-md-none ">

               <a href="index.php" class="img-fluid">
                 <img
                   src="assets/img/oncoligist/ask_text.png"
                   style="height: 250px;margin-top: -190px;margin-bottom: -100px; "
                   alt="" /></a>
             </div>

           </div>

           <div class="col-md-4 footer-newsletter  onl_top">
             <p class="mt-2">
               <span class="phone_email">
                 <strong><i class="fa-solid fa-phone colr_purple">
                     &nbsp;</i></strong></span>
               <span class="mini_text"> +91 84069 07980 </span>
               <br />
               <span class="phone_email">
                 <strong><i class="fa-solid fa-envelope colr_purple"></i>
                   &nbsp;</strong></span>
               <span class="mini_text"> prabhaleo2003@gmail.com</span> <br />
             </p>
             <p class="mt-4 mini_text last_padding_text">
               Get the latest updates on cancer treatments, research, and
               patient care. Our blog helps patients and families navigate
               cancer diagnosis and treatment.
             </p>
             <div class="social-links mt-3">
               <a
                 href="https://www.facebook.com/askoncologist"
                 target="_blank"
                 class="facebook"><i class="bx bxl-facebook"></i></a>
               <a
                 href="https://www.instagram.com/ask_oncologist/"
                 target="_blank"
                 class="instagram"><i class="bx bxl-instagram"></i></a>
               <a
                 href="https://in.pinterest.com/askoncologist/"
                 target="_blank"
                 class="pinterest"><i class="bx bxl-pinterest"></i></a>
               <a
                 href="https://www.youtube.com/@askoncologist"
                 target="_blank"
                 class="twitter"><i class="bx bxl-youtube"></i></a>
             </div>
           </div>

         </div>
       </div>
     </div>


     <div
       class="footer-area-bottom theme-bg"
       style="background-color: #000a2d">
       <div class="container">
         <div class="row pt-4">

           <div class="  col-md-6 col-12">
             <div class="footer-widget__copyright-info info-direction">
               <p class="  last_text">
                 <a
                   href="terms.php"
                   style="text-decoration: none; color: #ffffff">Terms & conditions
                 </a>
                 <a
                   href="privacy.php"
                   style="text-decoration: none; color: #ffffff">
                   Privacy & policy</a>
               </p>
             </div>
           </div>

           <div class="col-md-6 col-12 second_divv_end_brand">
             <div class="footer-widget__copyright-info info-direction d-flex flex-row justify-content-end align-items-center">
               <a href="https://bhavicreations.com/" target="_blank" style="text-decoration: none; color: #ffffff; display: flex; align-items: center;">
                 <p class="mini_text last_text mb-0">
                   Branding By @
                 </p>
                 <img src="assets/img/bhavi_logo/Bhavi_Branding_Stamp.png" class="img-fluid brand_image" alt="">
               </a>
             </div>
           </div>

         </div>
       </div>
     </div>

     <style>
       @media (min-width: 1200px) {
         .second_divv_end_brand {
           padding-left: 35%;
           margin-top: -10px;
         }

         .brand_image {
           width: 23%;
           margin-top: 0%;
           margin-left: 5px;
         }
       }

       @media (min-width: 992px) and (max-width: 1200px) {
         .second_divv_end_brand {
           padding-left: 32%;
           margin-top: -10px;
         }

         .brand_image {
           width: 23%;
           margin-top: 0%;
           margin-left: 5px;
         }
       }

       @media (max-width: 768px) {
         .second_divv_end_brand {
           padding-left: 4%;
           margin-top: 0px;
         }

         .brand_image {
           width: 12%;
           margin-top: 0%;
           margin-left: 5px;
         }
       }

       @media (min-width: 768px) and (max-width: 992px) {
         .second_divv_end_brand {
           padding-left: 23%;
           margin-top: -10px;
         }

         .brand_image {
           width: 23%;
           margin-top: 0%;
           margin-left: 5px;
         }
       }
     </style>

   </footer>

 
   <button id="scrollBtn" onclick="scrollToTop()"><i class="fa-solid fa-arrow-up "></i></button>

   <script>
     // Function to scroll to the top of the page
     function scrollToTop() {
       window.scrollTo({
         top: 0,
         behavior: 'smooth' // Optional, smooth scrolling animation
       });
     }

     // Show scroll button when scrolling down
     window.onscroll = function() {
       scrollFunction()
     };

     function scrollFunction() {
       if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
         document.getElementById("scrollBtn").style.display = "block";
       } else {
         document.getElementById("scrollBtn").style.display = "none";
       }
     }
   </script>

   <style>
     #scrollBtn {
       display: none;
       /* Initially hide the button */
       position: fixed;
       /* Fix the position of the button */
       bottom: 20px;
       /* Adjust the bottom distance */
       right: 20px;
       /* Adjust the right distance */
       z-index: 999;
       /* Set a high z-index to ensure the button is on top */
       padding: 10px 15px;
       background-color: #01539D;
       ;
       color: white;
       border: none;
       border-radius: 50%;
       cursor: pointer;
     }
   </style>

   <a href="https://api.whatsapp.com/send?phone=918406907980" style="color: #fff;" class="whatsapp-link" target="_blank">
     <i class="fab fa-whatsapp"></i>
   </a>


   <div id="preloader"></div>
   <!-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a> -->

   <!-- Vendor JS Files -->
   <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
   <script src="assets/vendor/aos/aos.js"></script>
   <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
   <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
   <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
   <script src="assets/vendor/php-email-form/validate.js"></script>

   <!-- Template Main JS File -->
   <script src="assets/js/main.js"></script>

   <script>
     document.addEventListener('DOMContentLoaded', function() {
       var swiper = new Swiper('.mySwiper', {
         pagination: {
           el: '.swiper-pagination',
           clickable: true,
         },
         slidesPerView: 1,
         spaceBetween: 30,
         loop: false,
         autoplay: false,
       });

       // Add event listener to nav-links
       document.querySelectorAll('.nav-link').forEach(function(navLink) {
         navLink.addEventListener('click', function(event) {
           // Check if the link is not the "Blogs" link
           if (!navLink.href.includes('blogs.php')) {
             event.preventDefault();
             const target = navLink.getAttribute('data-bs-target');
             document.querySelectorAll('.tab-pane').forEach(function(tabPane) {
               tabPane.classList.remove('active', 'show');
             });
             document.querySelector(target).classList.add('active', 'show');
           }
         });
       });
     });
   </script>


 </body>

 </html>