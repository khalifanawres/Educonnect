<?php 
// include_once('../../BackOffice/Competitions/list_competitions.php');
require('../../../controller/CompetitionController.php');

$compController = new CompetitionController();
$competitions =  $compController->listCompetitions();

?>

<!DOCTYPE html>
<html lang="zxx">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="author" content="NextGenerationDev">
   <title>Atos - Multipurpose Web Hosting HTML Template</title>
   <!--Favicon img-->
   <link rel="shortcut icon" href="../assets/img/favicon/favicon.png">
   <!--Bootstarp min css-->
   <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
   <!--Bootstarp map css-->
   <link rel="stylesheet" href="../assets/css/bootstrap.css.map">
   <!--Odometer css-->
   <link rel="stylesheet" href="../assets/css/odometer.css">
   <!--Owl Carousel css-->
   <link rel="stylesheet" href="../assets/css/owl.min.css">
   <!--Owl Carousel Theme css-->
   <link rel="stylesheet" href="../assets/css/owl.theme.default.min.css">
   <!--All min css-->
   <link rel="stylesheet" href="../assets/css/all.min.css">
   <!--Animate css-->
   <link rel="stylesheet" href="../assets/css/animate.css">
   <!--Owl Nice select css-->
   <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
   <!--main css-->
   <link rel="stylesheet" href="../assets/css/main.css">
   <!--competition css-->
   <link rel="stylesheet" href="../assets/css/list_competitions.css">
</head>

<body>


<!--==== Scrool Top Bottom Here ======= -->
<div id="progress">
   <span id="valiu"><i class="fas fa-arrow-up"></i></span>
</div>
<!--==== Scrool Top Bottom End ======= -->

<div class="signin__signup__wrap">
   <a href="#0" class="cmn--btn" data-bs-toggle="modal" data-bs-target="#register">
      <span>Sign In</span>
   </a>
   <a href="#0" class="cmn--btn" data-bs-toggle="modal" data-bs-target="#login">
      <span>Sign Up</span>
   </a>
</div>

<!--Header Here-->
   <header class="header-section">
      <div class="container">
         <div class="header-wrapper">
            <div class="logo-menu">
               <a href="index.html" class="logo">
                  <img src="../assets/img/logo/logo2.png" alt="img">
               </a>
            </div>
            <div class="header-bar d-lg-none">
               <span></span>
               <span></span>
               <span></span>
            </div>
            <ul class="main-menu">
               <li class="active">
                  <a href="#0">Accueil <i class="fas fa-chevron-down"></i></a>
                  
               </li>
               <li>
                  <a href="about.html">Nos offres</a>
               </li>
               <li>
                  <a href="pricing.html">Nos cours</a>
               </li>
               <li>
                  <a href="list_competitions_form.php">compétitions</a>
               </li>
               <li>
                  <a href="vpshost.html">Projets</a>
               </li>
               <li>
                  <a href="#0">Réclamation<i class="fas fa-chevron-down"></i></a>
                  <ul class="sub-menu">
                     <li class="subtwohober">
                        <a href="../contact professeur.html">
                           <span class="icon"><i class="fa-brands fa-audible"></i></span>
                           <span>contact professeur</span>
                        </a>
                     </li>
                     <li class="subtwohober">
                        <a href="../contact administrateur.html">
                           <span class="icon"><i class="fa-solid fa-server"></i></span>
                           <span>contact administrateur</span>
                        </a>
                     </li>
                     
                  </ul>
               </li>
               <li class="btn--items">
                  <a href="contact.html" class="cmn--btn">
                     <span>contact</span>
                  </a>
               </li>
            </ul>
            <a href="contact.html" class="cmn--btn">
               <span>contact</span>
            </a>
         </div>
      </div>
   </header>
<!--Header End-->

<!--Banner Start-->
<section class="breadcumnd__banner">
   <div class="container">
      <div class="row align-items-center">
         <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
            <div class="banner__content">
               <h4>
                  contact,
                  Feel free to contact
               </h4>
               <p class="b__space">
                  
               </p>
               <ul class="ssd__list">
                  <li>
                    <span><i class="fa-solid fa-arrow-right"></i></span> <span>Unlimited Contact</span>
                  </li>
                  <li>
                     <span><i class="fa-solid fa-arrow-right"></i></span> <span>Contact For Support Team</span>
                  </li>
                  <li>
                     <span><i class="fa-solid fa-arrow-right"></i></span> <span>24/Hours Contact Our Team</span>
                  </li>
               </ul>
               <a href="#0" class="cmn--btn border__trans">
                  <span>contact</span>
               </a>
            </div>
         </div>
         <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
            <div class="banner__Thumb">
               <img src="../assets/img/hosting/contact.png" alt="about-img">
            </div>
         </div>
      </div>
   </div>
</section>
<!--Banner End-->

<!--Competitions Here-->
<div class="competitions__section pt-80">
   <div class="competitions_inner">
       <div class="container">
         <div class="section__header center mb-5">
            <h2 class="text-black wow fadeInDown" data-wow-delay="0.2s">
               Liste des <span class="text-base">Compétitions</span>
            </h2>
            <p class="text-black wow fadeInDown" data-wow-delay="0.4s">
               Consultez et gérez les compétitions en toute simplicité.
            </p>
         </div>
           <div class="row justify-content-center align-items-center">
            <div class="col-lg-12">
              <div class="competitions__card__wrap">
                  <table class="competitions-table">
                      <thead>
                          <tr>
                              <th>user</th>
                              <th>Nom</th>
                              <th>Description</th>
                              <th>Durée</th>
                              <th>Contenu</th>
                              <th>Actions</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          if ($competitions) {
                              foreach ($competitions as $competition) {
                                  echo "<tr>";
                                  echo "<td><img src='/Educonnect/user.png' alt='Image par défaut' style='width: 50px; height: 50px;'></td>";
                                  echo "<td>" . htmlspecialchars($competition['nom']) . "</td>";
                                  echo "<td>" . htmlspecialchars($competition['description']) . "</td>";
                                  echo "<td>" . htmlspecialchars($competition['duree']) . " jours</td>";
                                  echo "<td>" . htmlspecialchars($competition['contenu']) . "</td>";
                                  echo "<td>
                                          <a href='update_competition_form.php?id=" . $competition['id'] . "' class='cmn--btn'>Details</a>
                                        </td>";
                                  echo "</tr>";
                              }
                          } else {
                              echo "<tr><td colspan='5'>Aucune compétition trouvée.</td></tr>";
                          }
                          ?>
                      </tbody>
                  </table>
              </div>
           </div>
            <div class="col-lg-12 text-center">
                  <a href="add_competition_form.php" class="cmn--btn"><span>Ajouter une nouvelle compétition</span></a>
            </div>
           </div>
       </div>
   </div>
</div>
<!--Competitions End-->

<!--Footer Here-->
<footer class="footer-section section-bg pt-120">
   <div class="container">
      <div class="footer-top pb-120">
         <div class="row g-4">
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 ">
               <div class="widget-items">
                  <div class="footer-head">
                     <a href="index.html" class="footer-logo">
                        <img src="../assets/img/logo/logo-black.png" alt="f-logo">
                     </a>
                  </div>
                  <div class="content-area">
                     <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quibusdam voluptate minus minima.
                     </p>
                     <ul class="social">
                        <li>
                           <a href="#" class="icon">
                              <i class="fa-brands fa-facebook-f"></i>
                           </a>
                        </li>
                        <li>
                           <a href="#" class="icon">
                              <i class="fa-brands fa-instagram"></i>
                           </a>
                        </li>
                        <li>
                           <a href="#" class="icon">
                              <i class="fa-brands fa-twitter"></i>
                           </a>
                        </li>
                        <li>
                           <a href="#" class="icon">
                              <i class="fa-brands fa-whatsapp"></i>
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-6 col-sm-6 ">
               <div class="widget-items">
                  <div class="footer-head">
                     <h5 class="title">
                        Services
                     </h5>
                  </div>
                  <div class="content-area">
                     <ul class="quick-link">
                        <li>
                           <a href="#0">
                              <i class="fas fa-caret-right"></i> Shared Hosting
                           </a>
                        </li>
                        <li>
                           <a href="#0">
                              <i class="fas fa-caret-right"></i> WordPress Hosting
                           </a>
                        </li>
                        <li>
                           <a href="#0">
                              <i class="fas fa-caret-right"></i> VPS Hosting
                           </a>
                        </li>
                        <li>
                           <a href="#0">
                              <i class="fas fa-caret-right"></i> Reseller Hosting
                           </a>
                        </li>
                        <li>
                           <a href="#0">
                              <i class="fas fa-caret-right"></i> Dedicated Server
                           </a>
                        </li>
                        <li>
                           <a href="#0">
                              <i class="fas fa-caret-right"></i> Window Hosting
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 ">
               <div class="widget-items">
                  <div class="footer-head">
                     <h5 class="title">
                        Domains
                     </h5>
                  </div>
                  <div class="content-area">
                     <ul class="quick-link">
                        <li>
                           <a href="#0">
                              <i class="fas fa-caret-right"></i> Register Domains
                           </a>
                        </li>
                        <li>
                           <a href="#0">
                              <i class="fas fa-caret-right"></i> Transfer
                           </a>
                        </li>
                        <li>
                           <a href="#0">
                              <i class="fas fa-caret-right"></i> Transfer Domains
                           </a>
                        </li>
                        <li>
                           <a href="#0">
                              <i class="fas fa-caret-right"></i> Manage Domains
                           </a>
                        </li>
                        <li>
                           <a href="#0">
                              <i class="fas fa-caret-right"></i> Personal 
                           </a>
                        </li>
                        <li>
                           <a href="#0">
                              <i class="fas fa-caret-right"></i> Premium Domains
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 ">
               <div class="widget-items">
                  <div class="footer-head">
                     <h5 class="title">
                        contact
                     </h5>
                  </div>
                  <div class="content-area">
                     <ul class="contact">
                        <li>
                           <div class="phone-icon">
                              <img src="../assets/img/footer/email.png" alt="email">
                           </div>
                           <a href="#0" class="email-part">
                              <span>Email:</span>
                              support@example.com
                           </a>
                        </li>
                        <li>
                           <div class="phone-icon">
                              <img src="../assets/img/footer/phone.png" alt="phone">
                           </div>
                           <a href="#0" class="email-part">
                              <span>Phone:</span>
                              +879 624 548
                           </a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="footer-bottom">
         <p>
            Copyright &copy; 2023 Atos | Designed by <a href="#0">NextGenerationDev</a>
         </p>
         <ul class="footer-bottom-link">
            <li>
               <a href="#0">
                  Privacy
               </a>
            </li>
            <li>
               <a href="#0">
                  Terms & Conditions
               </a>
            </li>
         </ul>
      </div>
   </div>
</footer>
<!--Footer End-->


<!--Register Modal Start-->
<div class="modal register__modal fade" id="register" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog  modal-md">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="modal__right">
                     <ul class="nav nav-tabs" id="myTabing" role="tablist">
                        <li class="nav-item" role="presentation">
                           <button class="nav-link " id="home-tabemail" data-bs-toggle="tab" data-bs-target="#homeemail" type="button" role="tab" aria-controls="homeemail" aria-selected="true">Sign  Up</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link active" id="contact-tabup" data-bs-toggle="tab" data-bs-target="#contactup" type="button" role="tab" aria-controls="contactup" aria-selected="false">Sign In</button>
                        </li>
                     </ul>
                     <div class="tab-content" id="myTabContentents">
                        <div class="tab-pane fade" id="homeemail" role="tabpanel">
                           <div class="form__tabs__wrap">
                                 <div class="focus__icon">
                                    <img src="../assets/img/modal/flowers.png" alt="f-img">
                                 </div>
                                 <form action="#0">
                                    <div class="form__grp">
                                       <label for="email33">Email Address</label>
                                       <input type="email" id="email33" placeholder="Your Email Address.">
                                    </div>
                                    <div class="form__grp">
                                       <label for="password-field9">Your Password</label>
                                       <input id="password-field9" type="password" placeholder="Your Password">
                                       <span id="#password-field9" class="fa fa-fw fa-eye field-icon toggle-password9"></span>
                                    </div>
                                    <div class="form__grp">
                                       <label for="password-field5">Confirm Password</label>
                                       <input id="password-field5" type="password" placeholder="Confirm Password">
                                       <span id="#password-field5" class="fa fa-fw fa-eye field-icon toggle-password5"></span>
                                    </div>
                                    <div class="form-check form__check d-flex align-items-center">
                                       <input class="form-check-input" type="checkbox" id="checkiss2">
                                       <label class="form-check-label" for="checkiss2">
                                             I agree with <a href="#0"> user agreement,</a> and confirm that I am at least 18 years old!
                                       </label>
                                    </div>       
                                    <div class="create__btn">
                                       <a href="#0" class="cmn--btn">
                                             <span>Create an account</span>
                                       </a>
                                    </div>
                                 </form>
                                 <div class="social__head">
                                    <div class="border__static"></div>
                                    <span>
                                       Or log in directly with
                                    </span>
                                    <ul class="social">
                                       <li>
                                             <a href="#0">
                                                <i class="fa-brands fa-facebook-f"></i>
                                             </a>
                                       </li>
                                       <li>
                                             <a href="#0">
                                                <i class="fab fa-google"></i>
                                             </a>
                                       </li>
                                       <li>
                                             <a href="#0">
                                                <i class="fab fa-twitter"></i>
                                             </a>
                                       </li>
                                       <li>
                                             <a href="#0">
                                                <i class="fa-brands fa-linkedin-in"></i>
                                             </a>
                                       </li>
                                       <li>
                                             <a href="#0">
                                                <i class="fa-brands fa-telegram"></i>
                                             </a>
                                       </li>
                                    </ul>
                                 </div>
                           </div>
                        </div>
                        <div class="tab-pane fade show active" id="contactup" role="tabpanel">
                           <div class="form__tabs__wrap">
                                 <div class="focus__icon">
                                    <img src="../assets/img/modal/flowers.png" alt="f-img">
                                 </div>
                                 <form action="#0">
                                    <div class="form__grp">
                                       <label for="emailg">Email Address</label>
                                       <input type="email" id="emailg" placeholder="Your Email Address.">
                                    </div>
                                    <div class="login__signup">
                                       <a href="#0">
                                             Forgot Your Password?
                                       </a>
                                    </div>
                                    <div class="form__grp">
                                       <label for="password-field7">Your Password</label>
                                       <input id="password-field7" type="password" placeholder="Your Password">
                                       <span id="#password-field7" class="fa fa-fw fa-eye field-icon toggle-password7"></span>
                                    </div>    
                                    <div class="create__btn">
                                       <a href="#0" class="cmn--btn">
                                             <span>Login account</span>
                                       </a>
                                    </div>
                                    <div class="signup__text">
                                       <p>Don't have an account? <a href="#0">Sign Up</a></p>
                                    </div>
                                 </form>
                                 <div class="social__head">
                                    <div class="border__static"></div>
                                    <span>
                                       Or log in directly with
                                    </span>
                                    <ul class="social">
                                       <li>
                                             <a href="#0">
                                                <i class="fa-brands fa-facebook-f"></i>
                                             </a>
                                       </li>
                                       <li>
                                             <a href="#0">
                                                <i class="fab fa-google"></i>
                                             </a>
                                       </li>
                                       <li>
                                             <a href="#0">
                                                <i class="fab fa-twitter"></i>
                                             </a>
                                       </li>
                                       <li>
                                             <a href="#0">
                                                <i class="fa-brands fa-linkedin-in"></i>
                                             </a>
                                       </li>
                                       <li>
                                             <a href="#0">
                                                <i class="fa-brands fa-telegram"></i>
                                             </a>
                                       </li>
                                    </ul>
                                 </div>
                           </div>
                        </div>
                     </div>
               </div>
            </div>
         </div>
   </div>
</div>
<!--Register Modal End-->

<!--Login Modal Start-->
<div class="modal register__modal fade" id="login" tabindex="-1" aria-hidden="true">
   <div class="modal-dialog  modal-md">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="modal__right">
                     <ul class="nav nav-tabs" id="myTab2" role="tablist">
                        <li class="nav-item" role="presentation">
                           <button class="nav-link active" id="home-tab1" data-bs-toggle="tab" data-bs-target="#home2" type="button" role="tab" aria-controls="home2" aria-selected="true">Sign Up</button>
                        </li>
                        <li class="nav-item" role="presentation">
                           <button class="nav-link" id="contact-tab3" data-bs-toggle="tab" data-bs-target="#contact2" type="button" role="tab" aria-controls="contact2" aria-selected="false">Sign In</button>
                        </li>
                     </ul>
                        <div class="tab-content" id="myTabContent2">
                        <div class="tab-pane fade show active" id="home2" role="tabpanel">
                           <div class="form__tabs__wrap">
                                 <div class="focus__icon">
                                    <img src="../assets/img/modal/flowers.png" alt="f-img">
                                 </div>
                                 <form action="#0">
                                    <div class="form__grp">
                                       <label for="email3">Email Address</label>
                                       <input type="email" id="email3" placeholder="Your Email Address.">
                                    </div>
                                    <div class="form__grp">
                                       <label for="password-field10">Your Password</label>
                                       <input id="password-field10" type="password" placeholder="Your Password">
                                       <span id="#password-field10" class="fa fa-fw fa-eye field-icon toggle-password10"></span>
                                    </div>
                                    <div class="form__grp">
                                       <label for="password-field6">Confirm Password</label>
                                       <input id="password-field6" type="password" placeholder="Confirm Password">
                                       <span id="#password-field6" class="fa fa-fw fa-eye field-icon toggle-password6"></span>
                                    </div>
                                    <div class="form-check form__check d-flex align-items-center">
                                       <input class="form-check-input" type="checkbox" id="checkiss">
                                       <label class="form-check-label" for="checkiss">
                                             I agree with <a href="#0"> user agreement,</a> and confirm that I am at least 18 years old!
                                       </label>
                                    </div>       
                                    <div class="create__btn">
                                       <a href="#0" class="cmn--btn">
                                             <span>Create an account</span>
                                       </a>
                                    </div>
                                 </form>
                                 <div class="social__head">
                                    <div class="border__static"></div>
                                    <span>
                                       Or log in directly with
                                    </span>
                                    <ul class="social">
                                       <li>
                                             <a href="#0">
                                                <i class="fa-brands fa-facebook-f"></i>
                                             </a>
                                       </li>
                                       <li>
                                             <a href="#0">
                                                <i class="fab fa-google"></i>
                                             </a>
                                       </li>
                                       <li>
                                             <a href="#0">
                                                <i class="fab fa-twitter"></i>
                                             </a>
                                       </li>
                                       <li>
                                             <a href="#0">
                                                <i class="fa-brands fa-linkedin-in"></i>
                                             </a>
                                       </li>
                                       <li>
                                             <a href="#0">
                                                <i class="fa-brands fa-telegram"></i>
                                             </a>
                                       </li>
                                    </ul>
                                 </div>
                           </div>
                        </div>
                        <div class="tab-pane fade" id="contact2" role="tabpanel">
                           <div class="form__tabs__wrap">
                                 <div class="focus__icon">
                                    <img src="../assets/img/modal/flowers.png" alt="f-img">
                                 </div>
                                 <form action="#0">
                                    <div class="form__grp">
                                       <label for="email34">Email Address</label>
                                       <input type="email" id="email34" placeholder="Your Email Address.">
                                    </div>
                                    <div class="login__signup">
                                       <a href="#0">
                                             Forgot Your Password?
                                       </a>
                                    </div>
                                    <div class="form__grp">
                                       <label for="password-field1">Your Password</label>
                                       <input id="password-field1" type="password" placeholder="Your Password">
                                       <span id="#password-field1" class="fa fa-fw fa-eye field-icon toggle-password1"></span>
                                    </div>    
                                    <div class="create__btn">
                                       <a href="#0" class="cmn--btn">
                                             <span>Login account</span>
                                       </a>
                                    </div>
                                    <div class="signup__text">
                                       <p>Don't have an account? <a href="#0">Sign Up</a></p>
                                    </div>
                                 </form>
                                 <div class="social__head">
                                    <div class="border__static"></div>
                                    <span>
                                       Or log in directly with
                                    </span>
                                    <ul class="social">
                                       <li>
                                             <a href="#0">
                                                <i class="fa-brands fa-facebook-f"></i>
                                             </a>
                                       </li>
                                       <li>
                                             <a href="#0">
                                                <i class="fab fa-google"></i>
                                             </a>
                                       </li>
                                       <li>
                                             <a href="#0">
                                                <i class="fab fa-twitter"></i>
                                             </a>
                                       </li>
                                       <li>
                                             <a href="#0">
                                                <i class="fa-brands fa-linkedin-in"></i>
                                             </a>
                                       </li>
                                       <li>
                                             <a href="#0">
                                                <i class="fa-brands fa-telegram"></i>
                                             </a>
                                       </li>
                                    </ul>
                                 </div>
                           </div>
                        </div>
                     </div>
               </div>
            </div>
         </div>
   </div>
</div>
<!--Login Modal End-->


   <!--Jquery 3 6 0 Min Js-->
   <script src="../assets/js/jquery-3.6.0.min.js"></script>
   <!--Bootstrap bundle Js-->
   <script src="../assets/js/bootstrap.bundle.js"></script>
   <!--Waypoint Jquery min Js-->
   <script src="../assets/js/jquery.waypoints.min.js"></script>
   <!--Viewport Jquery Js-->
   <script src="../assets/js/viewport.jquery.js"></script>
   <!--Wow min Js-->
   <script src="../assets/js/wow.min.js"></script>
   <!--Odometer Up min Js-->
   <script src="../assets/js/odometer.min.js"></script>
   <!--Owl Carousel min Js-->
   <script src="../assets/js/owl.min.js"></script>
   <!--Owl nice Jquery min Js-->
   <script src="../assets/js/jquery.nice-select.min.js"></script> 
   <script src="../assets/js/magnific-popup.js"></script> 
   <!--main Js-->
   <script src="../assets/js/main.js"></script>

</body>

</html>