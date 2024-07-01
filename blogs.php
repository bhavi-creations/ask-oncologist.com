<?php
include './db.connection/db_connection.php';
// Fetch blog data
$sql = "SELECT * FROM blog";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Ask-Oncologist</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/oncoligist//Oncology logo.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="main_images">
        <div class="container d-flex align-items-center">

            <a href="index.php" class="logo m-auto" style="z-index: 999;">
                <img src="assets/img/oncoligist/Oncology logo.png" alt="">
            </a>

            <nav id="navbar" class="navbar order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto" href="index.php">Home</a></li>
                    <li><a class="nav-link scrollto" href="index.php#about">About</a></li>
                    <li><a class="nav-link scrollto" href="index.php#facilities">Facilities</a></li>
                    <!-- <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li> -->
                    <li><a class="nav-link" href="blogs.php">Blogs</a></li>
                    <li><a class="nav-link scrollto" href="index.php#contact">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            <a href="index.php#appointment" class="appointment-btn scrollto" style="z-index: 999;">
                <span class="d-none d-md-inline">Make an</span> Appointment
            </a>

        </div>
    </header>


    <main>
        <!-- ======= Blogs Section ======= -->
        <section id="blogs">
            <div class="container">
                <div class="section-title" style="margin-top: 100px;">
                    <h2>Blogs</h2>
                </div>

                <div class="row" id="blogRow">
                    <?php
                    $counter = 0;
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            if ($counter === 0) {
                                echo '
                                    <div class="col-md-9  order-1 order-md-1" id="selectedblog">
                                    <div id="selectedBlogId" style="display: none">' . $counter . '</div>
                                    <h2 class="mb-3">' . $row['title'] . '</h2>
                                    <video class="custom-video" muted  autoplay    controls style="width: 100%; height: auto;">
                                    <source src="admin/public/uploads/videos/' . $row['video'] . '" type="video/mp4">
                                    Your browser does not support the video tag.
                                    </video>
                                    <p>Published On  ';
                    ?>




                                <?php echo date("Y-m-d H:i:s", strtotime($row['time']));
                                echo '</p>
                                    
                                    <div class="row d-flex my-3">';



                                echo '<div>';
                                ?>
                                <?php if (!empty($row['photos'])) : ?>
                                    <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                                        <div class="swiper-wrapper row"> <!-- Added 'row' class for Bootstrap grid -->

                                            <?php foreach (json_decode($row['photos']) as $photo) : ?>
                                                <div class="testimonial-item col-6 col-md-4 col-lg-3"> <!-- Added Bootstrap grid classes -->
                                                    <img src="admin/public/uploads/photos/<?php echo htmlspecialchars($photo); ?>" alt="Blog Photo" class="img-fluid my-2">
                                                </div>
                                            <?php endforeach; ?>

                                        </div>
                                    </div>
                                <?php else : ?>
                                    <p>No photos available.</p>
                                <?php endif; ?>
                                <?php echo '</div>';

                                echo '
                                        </div>';
                                echo $row['content'];
                                echo '
                                            <div style="display: none" id="lastchild">
                                                    <video onclick="swapDivs(`' . $counter . '`)"
                                                        class="custom-video" controls muted autoplay style="width: 100%; height: auto;">
                                                        <source src="admin/public/uploads/videos/' . $row['video'] . '" type="video/mp4">
                                                        Your browser does not support the video tag.
                                                    </video>
                                                    <h6 class="mb-3" onclick="swapDivs(`' . $counter . '`)">' . $row['title'] . '</h6>
                                            </div>';
                                echo '</div>';





                                if ($result->num_rows > 1) {
                                    echo '<div class="col-md-3  order-2 order-md-2 scrollable-div">';
                                }
                            } else {
                                echo '<div id="sidebardiv' . $counter . '""><video
                                            class="custom-video" autoplay muted controls style="width: 100%; height: auto;" onclick="swapDivs(`' . $counter . '`)">
                                            <source src="admin/public/uploads/videos/' . $row['video'] . '" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <h6 class="mb-3" onclick="swapDivs(`' . $counter . '`)">' . $row['title'] . '</h6>';
                                echo '<div class="col-md-9  order-2 order-md-1" id="lastchild" style="display: none">
                                        <h2 class="mb-3" >' . $row['title'] . '</h2>
                                        <video class="custom-video" autoplay muted controls style="width: 100%; height: auto;" onclick="swapDivs(`' . $counter . '`)">
                                            <source src="admin/public/uploads/videos/' . $row['video'] . '" type="video/mp4">
                                            Your browser does not support the video tag.
                                        </video>
                                        <p>Published On ';
                                ?>
                                <?php echo date("Y-m-d H:i:s", strtotime($row['time']));

                                echo '</p>
                                         <div class="row d-flex my-3">
                                         <div class="row">
                                         <div class="col-9"></div>
                                         <button onclick="hideDiv()" class="btn btn-primary col-3 readmore_btn" id="read">Read More</button>
                                         
                                           </div>
                                         ';


                                echo '<div id="images" style="display:none;">'; ?>
                                <?php if (!empty($row['photos'])) : ?>
                                    <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                                        <div class="swiper-wrapper row"> <!-- Added 'row' class for Bootstrap grid -->

                                            <?php foreach (json_decode($row['photos']) as $photo) : ?>
                                                <div class="testimonial-item col-6 col-md-4 col-lg-3"> <!-- Added Bootstrap grid classes -->
                                                    <img src="admin/public/uploads/photos/<?php echo htmlspecialchars($photo); ?>" alt="Blog Photo" class="img-fluid my-2">
                                                </div>
                                            <?php endforeach; ?>

                                        </div>
                                    </div>
                                <?php else : ?>
                                    <p>No photos available.</p>
                                <?php endif;
                                echo $row['content'];
                                ?>
                    <?php echo '</div>';




                                echo '
                                        </div>';
                                echo '</div></div>';
                            }
                            $counter++;
                        }
                        if ($result->num_rows > 1) {
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
        </section>


        <script>
            state = 1;

            function hideDiv() {

                if (state == 0) {
                    var div = document.getElementById('images');
                    document.getElementById('read').innerHTML = "Read More";
                    div.style.display = 'none';
                    state = 1;
                } else {
                    var div = document.getElementById('images');
                    div.style.display = 'block';
                    document.getElementById('read').innerHTML = "Read less";
                    state = 0;
                }

            }


            function swapDivs(currentDivId) {
                var currentDiv = document.getElementById('sidebardiv' + currentDivId);
                currentDiv.setAttribute('id', 'sidebardiv' + document.getElementById('selectedBlogId').innerText);
                console.log(document.getElementById('selectedBlogId').innerText);
                let selectedBlog = document.getElementById('selectedblog');
                let currentDivLastChild = currentDiv.querySelector('#lastchild');
                let selectedDivLastChild = selectedBlog.querySelector('#lastchild');
                var currentDivNewDiv = document.createElement('div');
                currentDivNewDiv.innerHTML = selectedBlog.querySelector('#lastchild').innerHTML;
                let currentDivNewDivLastChild = document.createElement('div');
                currentDivNewDivLastChild.id = 'lastchild';
                currentDivNewDivLastChild.style.display = 'none';
                selectedBlog.removeChild(selectedDivLastChild);
                selectedBlog.removeChild(document.getElementById('selectedBlogId'));
                currentDivNewDivLastChild.innerHTML = selectedBlog.innerHTML;
                currentDivNewDiv.appendChild(currentDivNewDivLastChild);
                let selectedBlogNewDiv = document.createElement('div');
                selectedBlogNewDiv.innerHTML = currentDiv.querySelector('#lastchild').innerHTML;
                let selectedBlogIDNewDiv = document.createElement('div');
                selectedBlogIDNewDiv.id = 'selectedBlogId';
                selectedBlogIDNewDiv.innerText = currentDivId;
                let selectedBlogNewDivLastChild = document.createElement('div');
                selectedBlogNewDivLastChild.id = 'lastchild';
                selectedBlogNewDivLastChild.style.display = 'none';
                currentDiv.removeChild(currentDivLastChild);
                selectedBlogNewDivLastChild.innerHTML = currentDiv.innerHTML;
                selectedBlogNewDiv.appendChild(selectedBlogIDNewDiv);
                selectedBlogNewDiv.appendChild(selectedBlogNewDivLastChild);
                currentDiv.innerHTML = currentDivNewDiv.innerHTML;
                selectedBlog.innerHTML = selectedBlogNewDiv.innerHTML;

                // Manage volume
                let currentDivVideo = currentDiv.querySelector('video');
                let selectedBlogVideo = selectedBlog.querySelector('video');
                if (currentDivVideo) currentDivVideo.muted = true; // Mute the sidebar video
                if (selectedBlogVideo) selectedBlogVideo.muted = false; // Unmute the main video

                // Scroll to main video section
                selectedBlog.scrollIntoView({
                    behavior: 'smooth'
                });




            }
        </script>

    </main>
    <!-- ======= Footer ======= -->
    <footer id="footer">
     <div class="footer-top">
       <div class="container">
         <div class="row">

           <div class=" col-md-6 d-flex flex-row justify-content-center">
             <div class="footer-info  ">
               <!-- <a href="index.php" class="logo me-auto "><img src="assets/img/oncoligist/Oncology logo.png" style="height:350px;" alt=""></a> -->
               <a href="index.php" class=" img-fluid "> <img src="assets/img/oncoligist/footer_logo.png" style="height:350px;" alt=""></a>

             </div>
             <!-- <div class="footer-info d-block d-xl-none">
               <a href="index.php" class="logo me-auto "><img src="assets/img/oncoligist/Oncology logo.png" class="img-fluid" alt=""></a>

             </div> -->
           </div>



           <div class=" col-md-6 footer-newsletter  onl_top">

             <p class="mt-2">
               <span class="phone_email"> <strong><i class="fa-solid fa-phone colr_purple"> &nbsp;</i></strong></span> <span class="mini_text"> +91 84069 07980 </span>
               <br>
               <span class="phone_email"> <strong><i class="fa-solid fa-envelope colr_purple"></i> &nbsp;</strong></span> <span class="mini_text">
                 prabhaleo2003@gmail.com</span> <br>
             </p>
             <p class="mt-4 mini_text last_padding_text">
               Get the latest updates on cancer treatments, research, and patient care. Our blog helps patients and families navigate cancer diagnosis and treatment.
             </p>
             <div class="social-links mt-3">
             <a href="https://www.facebook.com/askoncologist" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
               <a href="https://www.instagram.com/ask_oncologist/" target="_blank" class="instagram"><i class="bx bxl-instagram"></i></a>
               <a href="https://in.pinterest.com/askoncologist/" target="_blank" class="pinterest"><i class="bx bxl-pinterest"></i></a>
               <a href="https://www.youtube.com/@askoncologist" target="_blank" class="twitter"><i class="bx bxl-youtube"></i></a>

             </div>

           </div>

         </div>
       </div>
     </div>

     <div class="footer-area-bottom theme-bg">
       <div class="container">
         <div class="row  pt-4">
           <div class="col-xl-8 col-lg-9 col-md-12 col-12">
             <div class="footer-widget__copyright">
               <p class="mini_text  last_text" style="color: #737373"> ©2024 Ask-Oncologist . All Rights Reserved. Designed &
                 Developed by <a href="https://bhavicreations.com/" target="_blank" style="text-decoration: none;color:#737373">Bhavi
                   Creations</a></p>
             </div>
           </div>
           <div class="col-xl-4 col-lg-3 col-md-12 col-12">
             <div class="footer-widget__copyright-info info-direction ">
               <p class="mini_text last_text"><a href="terms.html" style="text-decoration: none;color:#737373">Terms & conditions
                 </a>
                 <a href="privacy.html" style="text-decoration: none;color:#737373"> Privacy & policy</a>
               </p>
             </div>
           </div>
         </div>
       </div>
     </div>
   </footer>

   <!-- End Footer -->

   <!-- WhatsApp link -->


   <!-- Scroll Up Button  -->
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

    


 </body>

 </html>