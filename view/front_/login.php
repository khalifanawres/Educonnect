<?php

include '../../controller/UserController.php';


$error = "";

$offer= null;
// create an instance of the controller
$UserController = new UserController();


if (
    isset($_POST["nom"])  && $_POST["email"] && $_POST["mot_de_passe"] && $_POST["role"] 
) {
    if (
        !empty($_POST["nom"])  && !empty($_POST["email"]) && !empty($_POST["mot_de_passe"]) && !empty($_POST["role"]))
    
     {
        
        $offer = new User(
            null,
            $_POST['nom'],
            $_POST['email'],
            $_POST['mot_de_passe'],
            $_POST['role']
        );
        //
            
        $UserController->addUser($offer);

       header('Location:login.php');
    } else
        $error = "Missing information";
}




?>

<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUCONNECT</title>

    <!--Favicon img-->
   <link rel="shortcut icon" href="assets/img/favicon/favicon.png">
   <!--Bootstarp min css-->
   <link rel="stylesheet" href="assets/css/bootstrap.min.css">
   <!--Bootstarp map css-->
   <link rel="stylesheet" href="assets/css/bootstrap.css.map">
   <!--Odometer css-->
   <link rel="stylesheet" href="assets/css/odometer.css">
   <!--Owl Carousel css-->
   <link rel="stylesheet" href="assets/css/owl.min.css">
   <!--Owl Carousel Theme css-->
   <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
   <!--All min css-->
   <link rel="stylesheet" href="assets/css/all.min.css">
   <!--Animate css-->
   <link rel="stylesheet" href="assets/css/animate.css">
   <!--Owl Nice select css-->
   <link rel="stylesheet" href="assets/css/nice-select.css">
   <link rel="stylesheet" href="assets/css/magnific-popup.css">
   <!--main css-->
   <link rel="stylesheet" href="assets/css/main.css">
   <link rel="stylesheet" href="assets/css/style-login.css">


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


  

<!--Banner Start-->
<section class="breadcumnd__banner">
  <div class="container">
     <div class="row align-items-center">
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
           <div class="banner__content">
              <h4>
                 About
              </h4>
              <ul>
                 <li>
                    <a href="#0">
                       Home
                    </a>
                 </li>
                 <li>
                    <i class="fa-solid fa-arrow-right"></i>
                 </li>
                 <li>
                    About
                 </li>
              </ul>
           </div>
        </div>
        <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
           <div class="banner__Thumb">
              <img src="assets/img/about/ab.png" alt="about-img">
           </div>
        </div>
     </div>
  </div>
</section>
<!--Banner End-->

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
                                   <img src="assets/img/modal/flowers.png" alt="f-img">
                                </div>
                                <form action="" method="POST" onsubmit="return validateForm();">
                                <div>
            <ul class="nav nav-tabs" id="myTabing" role="tablist">
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link" id="student-tab" onclick="setRole('student')" data-bs-toggle="tab" role="tab" aria-controls="student" aria-selected="true">STUDENT</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button type="button" class="nav-link active" id="prof-tab" onclick="setRole('prof')" data-bs-toggle="tab" role="tab" aria-controls="prof" aria-selected="false">PROF</button>
                </li>
            </ul>
        </div>
        <input type="hidden" name="role" id="role" value="prof">
    <div class="form__grp">
        <label for="nom">Full Name</label>
        <input type="text" id="nom" name="nom" placeholder="Your Full Name" oninput="validateFullName()" required>
        <span id="nom_feedback" class="feedback"></span>
    </div>
    <div class="form__grp">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Your Email Address" oninput="validateEmail()" required>
        <span id="email_feedback" class="feedback"></span>
    </div>
    <div class="form__grp">
        <label for="mot_de_passe">Your Password</label>
        <input id="mot_de_passe" type="password" name="mot_de_passe" placeholder="Your Password" oninput="validatePassword()" required>
        <span id="password_feedback" class="feedback"></span>
    </div>
    <div class="form__grp">
        <label for="confirm_password">Confirm Password</label>
        <input id="confirm_password" type="password" placeholder="Confirm Password" oninput="validateConfirmPassword()" required>
        <span id="confirm_password_feedback" class="feedback"></span>
    </div>
    <div class="form-check form__check d-flex align-items-center">
        <input class="form-check-input" type="checkbox" id="agree" required>
        <label class="form-check-label" for="agree">
            I agree with <a href="#0">user agreement</a> and confirm that I am at least 18 years old!
        </label>
    </div>
    <div class="create__btn">
        <button type="submit" class="cmn--btn">
            <span>Create an account</span>
        </button>
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
                                   <img src="assets/img/modal/flowers.png" alt="f-img">
                                </div>
                                <form id="loginForm">
    <div>
        <ul class="nav nav-tabs" id="myTabing" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="student-tab " type="button" onclick="setRole('student')" role="tab" aria-controls="homeemail" aria-selected="true" data-bs-toggle="tab">STUDENT</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="prof-tab" type="button" onclick="setRole('prof')" role="tab" aria-controls="contactup" aria-selected="false" data-bs-toggle="tab">PROF</button>
            </li>
        </ul>
    </div>
    <input type="hidden" id="role" value="prof">
    <div class="form__grp">
        <label for="emailg">Email Address</label>
        <input type="email" id="emailg" placeholder="Your Email Address.">
    </div>
    <div class="login__signup">
        <a href="#0">Forgot Your Password?</a>
    </div>
    <div class="form__grp">
        <label for="password-field7">Your Password</label>
        <input id="password-field7" type="password" placeholder="Your Password">
        <span id="#password-field7" class="fa fa-fw fa-eye field-icon toggle-password7"></span>
    </div>    
    <div class="create__btn">
        <button type="button" class="cmn--btn" onclick="handleLogin()">
            <span>Login account</span>
        </button>
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
                          <button class="nav-link active" id="home-tab1" data-bs-toggle="tab" data-bs-target="#home2" type="button" role="tab" aria-controls="home" aria-selected="true">Sign Up</button>
                       </li>
                       <li class="nav-item" role="presentation">
                          <button class="nav-link" id="contact-tab3" data-bs-toggle="tab" data-bs-target="#contact2" type="button" role="tab" aria-controls="contact2" aria-selected="false">Sign In</button>
                       </li>
                    </ul>
                       <div class="tab-content" id="myTabContent2">
                       <div class="tab-pane fade show active" id="home2" role="tabpanel">
                          <div class="form__tabs__wrap">
                                <div class="focus__icon">
                                   <img src="assets/img/modal/flowers.png" alt="f-img">
                                </div>
   <form action="validation.js" method="POST">
         <div>
        <!-- Boutons pour sélectionner le rôle -->
        <ul class="nav nav-tabs" id="myTabing" role="tablist">
            <li class="nav-item" role="presentation">
                <button type="button" class="nav-link" id="student-tab" onclick="setRole('student')" data-bs-toggle="tab" role="tab" aria-controls="student" aria-selected="true">
                    STUDENT
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button type="button" class="nav-link active" id="prof-tab" onclick="setRole('prof')" data-bs-toggle="tab" role="tab" aria-controls="prof" aria-selected="false">
                    PROF
                </button>
            </li>
        </ul>
         </div>

         <!-- Champ caché pour stocker le rôle -->
      <input type="hidden" name="role" id="role" value="student">

        
        <div class="form__grp">
            <label for="nom">Full Name</label>
            <input type="text" id="nom" name="nom" placeholder="Your Full Name" required>
        </div>
        <div class="form__grp">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Your Email Address" required>
        </div>
        <div class="form__grp">
            <label for="mot_de_passe">Your Password</label>
            <input id="mot_de_passe" type="password" name="mot_de_passe" placeholder="Your Password" required>
        </div>
        <div class="form__grp">
            <label for="confirm_password">Confirm Password</label>
            <input id="confirm_password" type="password" placeholder="Confirm Password" required>
        </div>
        <div class="form-check form__check d-flex align-items-center">
            <input class="form-check-input" type="checkbox" id="agree" required>
            <label class="form-check-label" for="agree">
                I agree with <a href="#0">user agreement</a> and confirm that I am at least 18 years old!
            </label>
        </div>
        <div class="create__btn">
            <button type="submit" class="cmn--btn">
                <span>Create an account</span>
            </button>
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
                                   <img src="assets/img/modal/flowers.png" alt="f-img">
                                </div>
                                <form action="#0">
                                  <div>
                                    <ul class="nav nav-tabs" id="myTabing" role="tablist">
                                      <li class="nav-item" role="presentation">
                                         <button class="nav-link " id="home-tabemail" data-bs-toggle="tab"  type="button" role="tab" aria-controls="homeemail" aria-selected="true">STUDENT</button>
                                      </li>
                                      <li class="nav-item" role="presentation">
                                         <button class="nav-link active" id="contact-tabup" data-bs-toggle="tab"  type="button" role="tab" aria-controls="contactup" aria-selected="false">PROF</button>
                                      </li>
                                   </ul>
                                  </div>
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

<!--Footer Here-->
<footer id="footer" class="footer-section section-bg pt-120">
  <div class="container">
     <div class="footer-top pb-120">
        <div class="row g-4">
           <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 ">
              <div class="widget-items">
                 <div class="footer-head">
                    <a href="index.html" class="footer-logo">
                       <img src="assets/img/logo/logo-black.png" alt="f-logo">
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
                             <i class="fas fa-caret-right"></i> COURSE
                          </a>
                       </li>
                       <li>
                          <a href="#0">
                             <i class="fas fa-caret-right"></i> PROJECTS
                          </a>
                       </li>
                       <li>
                          <a href="#0">
                             <i class="fas fa-caret-right"></i> COMPETITIONS
                          </a>
                       </li>
                       <li>
                          <a href="#0">
                             <i class="fas fa-caret-right"></i>  QUIZ
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
                             <i class="fas fa-caret-right"></i> PYTHON
                          </a>
                       </li>
                       <li>
                          <a href="#0">
                             <i class="fas fa-caret-right"></i> C++
                          </a>
                       </li>
                       <li>
                          <a href="#0">
                             <i class="fas fa-caret-right"></i> C
                          </a>
                       </li>
                       <li>
                          <a href="#0">
                             <i class="fas fa-caret-right"></i> WEB
                          </a>
                       </li>
                       <li>
                        <a href="#0">
                           <i class="fas fa-caret-right"></i> IA
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
                       Contact Us
                    </h5>
                 </div>
                 <div class="content-area">
                    <ul class="contact">
                       <li>
                          <div class="phone-icon">
                             <img src="assets/img/footer/email.png" alt="email">
                          </div>
                          <a href="#0" class="email-part">
                             <span>Email:</span>
                             educonnect@gmail.com
                          </a>
                       </li>
                       <li>
                          <div class="phone-icon">
                             <img src="assets/img/footer/phone.png" alt="phone">
                          </div>
                          <a href="#0" class="email-part">
                             <span>Phone:</span>
                             71 100 100
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

 <!--Jquery 3 6 0 Min Js-->
 <script src="assets/js/jquery-3.6.0.min.js"></script>
 <!--Bootstrap bundle Js-->
 <script src="assets/js/bootstrap.bundle.js"></script>
 <!--Waypoint Jquery min Js-->
 <script src="assets/js/jquery.waypoints.min.js"></script>
 <!--Viewport Jquery Js-->
 <script src="assets/js/viewport.jquery.js"></script>
 <!--Wow min Js-->
 <script src="assets/js/wow.min.js"></script>
 <!--Odometer Up min Js-->
 <script src="assets/js/odometer.min.js"></script>
 <!--Owl Carousel min Js-->
 <script src="assets/js/owl.min.js"></script>
 <!--Owl nice Jquery min Js-->
 <script src="assets/js/jquery.nice-select.min.js"></script> 
 <script src="assets/js/magnific-popup.js"></script>
 <!--main Js-->
 <script src="assets/js/main.js"></script>
 <script src="assets/js/validation.js"></script>
 <script src="assets/js/login.js"></script>
 <script>
   function setRole(role) {
    document.getElementById('role').value = role;

    // Activer visuellement le bouton correspondant
    document.getElementById('student-tab').classList.remove('active');
    document.getElementById('prof-tab').classList.remove('active');
    if (role === 'student') {
       document.getElementById('student-tab').classList.add('active');
    } else {
       document.getElementById('prof-tab').classList.add('active');
    }
 }

   // Initialiser avec "student" par défaut
   setRole('student');
 </script>


</body>
</html>