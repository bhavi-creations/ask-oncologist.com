
<?php
include './db.connection/db_connection.php'; // Include your database connection file

// Retrieve service filter from GET request
$service = isset($_GET['service']) ? $_GET['service'] : '';

// Prepare SQL query with optional service filter
$sql = "SELECT id, title, main_content, main_image, created_at FROM blogs";
if (!empty($service)) {
    $sql .= " WHERE service = ?";
}
$sql .= " ORDER BY created_at DESC";

// Initialize statement
$stmt = $conn->prepare($sql);

// Bind parameters if service is set
if (!empty($service)) {
    $stmt->bind_param("s", $service);
}

// Execute the statement
$stmt->execute();

// Get the result
$result = $stmt->get_result();
?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Ask-Oncologist</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />

    <!-- Favicons -->
    <link href="assets/img/oncoligist//Oncology logo.png" rel="icon" />
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
      rel="stylesheet"
    />

    <!-- Vendor CSS Files -->
    <link
      href="assets/vendor/fontawesome-free/css/all.min.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet" />
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link
      href="assets/vendor/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link
      href="assets/vendor/glightbox/css/glightbox.min.css"
      rel="stylesheet"
    />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />

<!-- canonical  -->
    <link rel="canonical" href="https://www.askoncologist.com<?php echo $_SERVER['REQUEST_URI']; ?>" />


    <!-- Bootstrap CSS -->
    <link
      href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <link
      rel="stylesheet"
      href="https://unpkg.com/swiper/swiper-bundle.min.css"
    />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  </head>

  <body>
    <!-- ======= Header ======= -->
    <header id="header" class="main_images">
      <div class="container d-flex align-items-center">
        <div
          class="logo-text-container d-flex align-items-center"
          style="z-index: 999"
        >
          <a href="index.php" class="logo" style="margin-right: 10px">
            <img src="assets/img/oncoligist/Oncology logo.png" alt="" />
          </a>
          <div class="logo-text side_logo_text">
            <p class="img_icon_logo">Dr. K Pradeep Bhaskar</p>
            <p class="degrees_logo_txt">MBBS,DNB(Rad Onc)</p>
            <p class="degrees_logo_txt">
              FIGRS(Fellowship in Stereotactic Radiosurgery)
            </p>
            <p class="degrees_logo_txt">consultant Radiation Oncologist</p>
          </div>
        </div>

        <nav id="navbar" class="navbar order-lg-0">
          <ul>
            <li><a class="nav-link scrollto" href="index.php">Home</a></li>
            <li>
              <a class="nav-link scrollto" href="index.php#about">About</a>
            </li>
            <li>
              <a class="nav-link scrollto" href="index.php#facilities"
                >Facilities</a
              >
            </li>
            <!-- <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li> -->
            <li><a class="nav-link" href="blogs.php">Blogs</a></li>
            <li>
              <a class="nav-link scrollto" href="index.php#contact">Contact</a>
            </li>
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->

        <a
          href="index.php#appointment"
          class="appointment-btn scrollto"
          style="z-index: 999"
        >
          <span class="d-none d-md-inline">Ask</span> Oncologist
        </a>
      </div>
    </header>

    <!-- End Header -->
    <main>
        <!-- Filter Buttons -->
        <div class="container new_space">
            <div class="filter_buttons redirect_section mt-4">
                <a href="blogs.php?service="><button class="redirect_blog_srivice">All</button></a>
                <a href="blogs.php?service=Bladder Cancer"><button class="redirect_blog_srivice">Bladder Cancer</button></a>
                <a href="blogs.php?service=Brain Cancer"><button class="redirect_blog_srivice">Brain Cancer</button></a>
                <a href="blogs.php?service=Cervical Cancer"><button class="redirect_blog_srivice">Cervical Cancer</button></a>
                <a href="blogs.php?service=Childhood Cancer"><button class="redirect_blog_srivice">Childhood Cancer</button></a>
                <a href="blogs.php?service=Colon Cancer"><button class="redirect_blog_srivice">Colon Cancer</button></a>
                <a href="blogs.php?service=Esophageal Cancer"><button class="redirect_blog_srivice">Esophageal Cancer</button></a>
                <a href="blogs.php?service=Kidney Cancer"><button class="redirect_blog_srivice">Kidney Cancer</button></a>
                <a href="blogs.php?service=Leiomyosarcoma Cancer"><button class="redirect_blog_srivice">Leiomyosarcoma Cancer</button></a>
                <a href="blogs.php?service=Leukemia Cancer"><button class="redirect_blog_srivice">Leukemia Cancer</button></a>
                <a href="blogs.php?service=Liver Cancer"><button class="redirect_blog_srivice">Liver Cancer</button></a>
                <a href="blogs.php?service=Lung Cancer"><button class="redirect_blog_srivice">Lung Cancer</button></a>
                <a href="blogs.php?service=Lymphoma Cancer"><button class="redirect_blog_srivice">Lymphoma Cancer</button></a>
                <a href="blogs.php?service=Melanoma Cancer"><button class="redirect_blog_srivice">Melanoma Cancer</button></a>
                <a href="blogs.php?service=Ovarian Cancer"><button class="redirect_blog_srivice">Ovarian Cancer</button></a>
                <a href="blogs.php?service=Pancreatic Cancer"><button class="redirect_blog_srivice">Pancreatic Cancer</button></a>
                <a href="blogs.php?service=Prostate Cancer"><button class="redirect_blog_srivice">Prostate Cancer</button></a>
                <a href="blogs.php?service=Sarcoma/Bone Cancer"><button class="redirect_blog_srivice">Sarcoma/Bone Cancer</button></a>
                <a href="blogs.php?service=Stomach Cancer"><button class="redirect_blog_srivice">Stomach Cancer</button></a>
                <a href="blogs.php?service=Testicular Cancer"><button class="redirect_blog_srivice">Testicular Cancer</button></a>
                <a href="blogs.php?service=Uterine Cancer"><button class="redirect_blog_srivice">Uterine Cancer</button></a>
                <a href="blogs.php?service=Head Neck Cancer"><button class="redirect_blog_srivice">Head & Neck Cancer</button></a>
                <a href="blogs.php?service=Breast Cancer"><button class="redirect_blog_srivice">Breast Cancer</button></a>
                <a href="blogs.php?service=Multiple Cancer"><button class="redirect_blog_srivice">Multiple Cancer</button></a>
                <a href="blogs.php?service=Honors Cancer"><button class="redirect_blog_srivice">Honors Cancer</button></a>



            </div>
        </div>

        <!-- Blogs Section -->
        <div class="container blog-sidebar-list" style="padding-top: 20px; padding-bottom: 20px;">
      <div class="row">
        <div class="col-lg-12">
          <div class="grid row">
            <?php
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $image_path = !empty($row['main_image']) ? "admin/uploads/photos/{$row['main_image']}" : "default_image.png";
                echo "
                                    <div class='grid-item col-sm-12 col-md-6 col-lg-4 mb-5 shadow_box'>
                                        <div class='post-box card_bg_div_box'>
                                            <figure>
                                                <a href='fullblog.php?id={$row['id']}'>
                                                    <img src='{$image_path}' alt='Blog Image' class='img-fluid blog_box_image'>
                                                </a>
                                            </figure>
                                            <div class='box-content'>
                                                <h5 class='box-title'><a  class='box-title' href='fullblog.php?id={$row['id']}'>" . htmlspecialchars($row['title']) . "</a></h5>
                                                <p class='post-desc  mt-5' style='text-align: justify;'>" . substr(strip_tags($row['main_content']), 0, 90) . "...</p>
                                                <a href='fullblog.php?id={$row['id']}'><button class='blog_main_btn'>Read More..</button></a>
                                            </div>
                                        </div>
                                    </div>";
              }
            } else {
              echo "<p>No blog posts found.</p>";
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    </main>
    <!-- End #main -->

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
                    alt=""
                /></a>
              </div>
              <!-- <div class="footer-info d-block d-xl-none">
              <a href="index.php" class="logo me-auto "><img src="assets/img/oncoligist/Oncology logo.png" class="img-fluid" alt=""></a>

            </div> -->
            </div>

            <div class="col-md-4 d-flex flex-row justify-content-center" >
              <div class="footer-info  d-none d-lg-block">
    
                <a href="index.php" class="img-fluid" >
                  <img
                    src="assets/img/oncoligist/ask_text.png"
                    style="height: 350px;"
                    alt=""
                    class="txt_ask"
                /></a>
              </div>
              <div class="footer-info  d-none d-md-block d-lg-none">
    
                <a href="index.php" class="img-fluid" >
                  <img
                    src="assets/img/oncoligist/ask_text.png"
                    style="height: 250px;margin-top: 50px;"
                    alt=""
               
                /></a>
              </div>
              <div class="footer-info   d-md-none ">
    
                <a href="index.php" class="img-fluid" >
                  <img
                    src="assets/img/oncoligist/ask_text.png"
                    style="height: 250px;margin-top: -190px;margin-bottom: -100px; "
                    alt=""
               
                /></a>
              </div>
     
            </div>

            <div class="col-md-4 footer-newsletter  onl_top"   >
              <p class="mt-2">
                <span class="phone_email">
                  <strong
                    ><i class="fa-solid fa-phone colr_purple">
                      &nbsp;</i
                    ></strong
                  ></span
                >
                <span class="mini_text"> +91 84069 07980 </span>
                <br />
                <span class="phone_email">
                  <strong
                    ><i class="fa-solid fa-envelope colr_purple"></i>
                    &nbsp;</strong
                  ></span
                >
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
                  class="facebook"
                  ><i class="bx bxl-facebook"></i
                ></a>
                <a
                  href="https://www.instagram.com/ask_oncologist/"
                  target="_blank"
                  class="instagram"
                  ><i class="bx bxl-instagram"></i
                ></a>
                <a
                  href="https://in.pinterest.com/askoncologist/"
                  target="_blank"
                  class="pinterest"
                  ><i class="bx bxl-pinterest"></i
                ></a>
                <a
                  href="https://www.youtube.com/@askoncologist"
                  target="_blank"
                  class="twitter"
                  ><i class="bx bxl-youtube"></i
                ></a>
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


    <!-- End Footer -->

    <!-- WhatsApp link -->

    <!-- Scroll Up Button  -->
    <button id="scrollBtn" onclick="scrollToTop()">
      <i class="fa-solid fa-arrow-up"></i>
    </button>

    <script>
      // Function to scroll to the top of the page
      function scrollToTop() {
        window.scrollTo({
          top: 0,
          behavior: "smooth", // Optional, smooth scrolling animation
        });
      }

      // Show scroll button when scrolling down
      window.onscroll = function () {
        scrollFunction();
      };

      function scrollFunction() {
        if (
          document.body.scrollTop > 20 ||
          document.documentElement.scrollTop > 20
        ) {
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
        background-color: #01539d;
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
      }
    </style>

    <a
      href="https://api.whatsapp.com/send?phone=918406907980"
      style="color: #fff"
      class="whatsapp-link"
      target="_blank"
    >
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
