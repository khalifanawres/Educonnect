<?php
include '../../controller/UserController.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $secretKey = "6Lcq-ZkqAAAAACFuEKYvZ-Io0PWJQC6M9oEmDr-7";
    $response = $_POST['g-recaptcha-response'];
    $remoteIp = $_SERVER['REMOTE_ADDR'];

    $url = "https://www.google.com/recaptcha/api/siteverify";
    $data = [
        'secret' => $secretKey,
        'response' => $response,
        'remoteip' => $remoteIp
    ];

    $options = [
        'http' => [
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data),
        ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $json = json_decode($result);

    if ($json->success) {
        $userController = new UserController();

        $user = new User(
            null,
            $_POST['nom'],
            $_POST['email'],
            $_POST['mot_de_passe'],
            $_POST['role']
        );

        $result = $userController->addUser($user);

        if ($result['status'] === 'success') {
            // Générer un token de vérification
            $verificationToken = bin2hex(random_bytes(16));
            $userController->updateVerificationToken($user->getEmail(), $verificationToken);

            // Envoyer l'email de vérification
            $mail = new PHPMailer(true);

            try {
                // Configuration du serveur SMTP
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com'; // Remplacez par votre serveur SMTP
                $mail->SMTPAuth = true;
                $mail->Username = 'spouz2003@gmail.com'; // Remplacez par votre email
                $mail->Password = 'fdbx olhy sjgg wdwr'; // Remplacez par votre mot de passe
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Destinataire
                $mail->setFrom('your_email@example.com', 'Your Name');
                $mail->addAddress($user->getEmail(), $user->getNom());

                // Contenu de l'email
                $mail->isHTML(true);
                $mail->Subject = 'Email Verification';
                $mail->Body    = 'Please click the following link to verify your email: <a href="https://yourdomain.com/verify.php?token=' . $verificationToken . '">Verify Email</a>';
                $mail->AltBody = 'Please click the following link to verify your email: https://yourdomain.com/verify.php?token=' . $verificationToken;

                $mail->send();
                echo json_encode(['status' => 'success', 'message' => 'Registration successful. Please check your email to verify your account.']);
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo]);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => $result['message']]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'CAPTCHA failed.']);
    }
}
$UserController = new UserController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (!empty($_POST["nom"]) && !empty($_POST["email"]) && !empty($_POST["mot_de_passe"]) && isset($_POST["role"])) {
       $user = new User(null, $_POST['nom'], $_POST['email'], $_POST['mot_de_passe'], $_POST['role']);
       $UserController->addUser($user);

       // Générer un code de vérification
       $verificationCode = bin2hex(random_bytes(16)); 
       $UserController->saveVerificationCode($_POST['email'], $verificationCode);

       // Envoyer l'e-mail de vérification
       $UserController->sendVerificationEmail($_POST['email'], $verificationCode);

       echo '<script>alert("A verification email has been sent to your address. Please verify to complete registration.");</script>';
      } else {
         echo '<script>alert("Please fill in all fields.");</script>';
      }
}
?>



<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUCONNECT</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    
    <script src="https://accounts.google.com/gsi/client" async defer></script>
    <meta name="google-signin-client_id" content="683896753133-t1u8r32o6tep42a6pkujund3j1ramn5i.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>



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
   
   <script>
        function translatePage() {
            // Traduction des éléments par id ou par classe
            $('#banner h4').text('À propos');
            $('#register label[for="nom"]').text("Nom Complet");
            $('#register label[for="email"]').text("Adresse Email");
            $('#register label[for="mot_de_passe"]').text("Votre Mot de Passe");
            $('#register label[for="confirm_password"]').text("Confirmez le Mot de Passe");
            $('#loginForm label[for="emailg"]').text("Adresse Email");
            $('#loginForm label[for="password-field7"]').text("Votre Mot de Passe");
            $('.forgot-password a').text("Mot de passe oublié ?");
        }
    </script>
    

</head>
<body id="body">
<header>
        <button id="toggle-dark-mode">Toggle Dark Mode</button>
    </header>
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

<!-- Traduction Button -->



  

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
        <button onclick="translatePage()">Traduire en Français</button>
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
            <input type="text" id="nom" name="nom" placeholder="Your Full Name" oninput="validateFullName()" >
            <span id="nom_feedback" class="feedback"></span>
        </div>
        <div class="form__grp">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Your Email Address" oninput="validateEmail()" >
            <span id="email_feedback" class="feedback"></span>
        </div>
        <div class="form__grp">
        <label for="mot_de_passe">Your Password</label>
        <div class="password-wrapper">
            <input id="mot_de_passe" type="password" name="mot_de_passe" placeholder="Your Password" oninput="validatePassword()" >
            <span class="toggle-password" onclick="togglePasswordVisibility('mot_de_passe')">&#128065;</span>
        </div>
        <button type="button" onclick="generateRandomPassword()">Generate Password</button>
        <span id="password_feedback" class="feedback"></span>
    </div>
    <div class="form__grp">
        <label for="confirm_password">Confirm Password</label>
        <div class="password-wrapper">
            <input id="confirm_password" type="password" placeholder="Confirm Password" oninput="validateConfirmPassword()" >
            <span class="toggle-password" onclick="togglePasswordVisibility('confirm_password')">&#128065;</span>
        </div>
        <span id="confirm_password_feedback" class="feedback"></span>
    </div>
        <div class="form-check form__check d-flex align-items-center">
            <input class="form-check-input" type="checkbox" id="agree" required>
            <label class="form-check-label" for="agree">
                I agree with <a href="user_agreement.php" >user agreement</a> and confirm that I am at least 18 years old!
            </label>
        </div>
        <div class="g-recaptcha" data-sitekey="6Lcq-ZkqAAAAAAA8FnVHscQT9niyxkhqn_eUSjEo"></div>
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
                                <form id="loginForm" method="POST">
    

    <!-- Champ email -->
    <div class="form__grp">
        <label for="emailg">Email Address</label>
        <input type="email" id="emailg" name="email" placeholder="Your Email Address" >
        <span id="email_error" class="feedback" style="color: red;"></span>
    </div>

    <!-- Champ mot de passe -->
    <div class="form__grp">
        <label for="password-field7">Your Password</label>
        <div class="password-wrapper">
            <input id="password-field7" type="password" name="password" placeholder="Your Password" >
            <span class="toggle-password" onclick="togglePasswordVisibility('password-field7')">&#128065;</span>
        </div>
        <span id="password_error" class="feedback" style="color: red;"></span>
    </div>

    
    <div class="g-recaptcha" data-sitekey="6Lcq-ZkqAAAAAAA8FnVHscQT9niyxkhqn_eUSjEo"></div>




    <div class="create__btn">
        <button type="button" class="cmn--btn" onclick="submitLoginForm();">
            <span>Login account</span>
        </button>
    </div>
    <div class="forgot-password">
        <a href="forgot_password.php">forgot password ?</a>
    </div>
</form>




                                <div class="social__head">
                                   <div class="border__static"></div>
                                   <span>
                                      Or log in directly with
                                   </span>
                                   <ul class="social">
                                   <li>
    <a href="javascript:void(0);" onclick="loginWithFacebook()">
        <i class="fa-brands fa-facebook-f"></i>
    </a>
</li>

<!-- Fenêtre modale pour le rôle -->
<div id="roleModal" style="display: none;">
    <div class="modal-content">
        <h2>Choose Your Role</h2>
        <p>Select your role to complete your registration:</p>
        <button onclick="setUserRole('student')" class="role-button">Student</button>
        <button onclick="setUserRole('prof')" class="role-button">Prof</button>
    </div>
</div>

<style>
    #roleModal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 8px;
        text-align: center;
    }
    .role-button {
        padding: 10px 20px;
        margin: 10px;
        cursor: pointer;
        border: none;
        border-radius: 5px;
        background-color: #007BFF;
        color: white;
        font-size: 16px;
    }
</style>
                                      
<li>
<a href="#0" onclick="googleSignIn()">
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
            <input type="text" id="nom" name="nom" placeholder="Your Full Name" >
        </div>
        <div class="form__grp">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" placeholder="Your Email Address" >
        </div>
        <div class="form__grp">
            <label for="mot_de_passe">Your Password</label>
            <input id="mot_de_passe" type="password" name="mot_de_passe" placeholder="Your Password" >
        </div>
        <div class="form__grp">
            <label for="confirm_password">Confirm Password</label>
            <input id="confirm_password" type="password" placeholder="Confirm Password" >
        </div>
        <div class="form-check form__check d-flex align-items-center">
    <input class="form-check-input" type="checkbox" id="agree" required>
    <label class="form-check-label" for="agree">
        I agree with <a href="user_agreement.php" >user agreement</a> and confirm that I am at least 18 years old!
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
 <script src="https://cdn.jsdelivr.net/npm/jwt-decode/build/jwt-decode.min.js"></script>
 
 <script>
    

    function validateLoginForm() {
        var email = document.getElementById('emailg').value;
        var password = document.getElementById('password-field7').value;

        var isValid = true;
        document.getElementById('email_error').innerText = '';
        document.getElementById('password_error').innerText = '';
        document.getElementById('general_error').innerText = '';

        if (!email) {
            document.getElementById('email_error').innerText = 'Email is required.';
            isValid = false;
        }

        if (!password) {
            document.getElementById('password_error').innerText = 'Password is required.';
            isValid = false;
        }

        return isValid;
    }

    // Fonction pour gérer le clic sur le bouton de connexion
function handleLogin() {
    // Validation basique (optionnelle)
    const email = document.getElementById("emailg").value.trim();
    const password = document.getElementById("password-field7").value.trim();

    if (email === "" || password === "") {
        alert("Please fill in both email and password.");
        return;
    }
    userRole =document.getElementById("role").value;
    // Redirection en fonction du rôle
    if (userRole === "student") {
        window.location.href = "home.html";
    } else if (userRole === "prof") {
        window.location.href = "../back/tables.php";
    } else {
        alert("Invalid role. Please select a valid tab.");
    }
}

function submitLoginForm() {
    // Récupérer les données du formulaire
    const email = document.getElementById("emailg").value.trim();
    const password = document.getElementById("password-field7").value.trim();

    // Réinitialiser les messages d'erreur
    document.getElementById("email_error").innerText = "";
    document.getElementById("password_error").innerText = "";

    // Envoyer les données via AJAX
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "login_handler.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onload = function () {
        if (xhr.status === 200) {
            const response = JSON.parse(xhr.responseText);

            if (response.success) {
                // Redirection en fonction du rôle
                window.location.href = response.redirect;
            } else {
                // Afficher les erreurs séparées
                if (response.errors.email) {
                    document.getElementById("email_error").innerText = response.errors.email;
                }
                if (response.errors.password) {
                    document.getElementById("password_error").innerText = response.errors.password;
                }

                // Afficher une alerte si la seconde vérification échoue
                if (response.alert) {
                    alert(response.alert);
                }
            }
        }
    };

    // Envoyer les données
    xhr.send(`email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`);
}




document.getElementById('email').addEventListener('input', function () {
    const email = this.value.trim();
    const feedback = document.getElementById('email_feedback');
    const submitButton = document.querySelector('button[type="submit"]');

    // Réinitialiser le message d'erreur
    feedback.textContent = "";
    feedback.style.color = "";

    // Désactiver le bouton pendant la vérification
    submitButton.disabled = true;

    if (email !== "") {
        // Envoyer une requête AJAX
        fetch('check_email.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `email=${encodeURIComponent(email)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.exists) {
                feedback.textContent = "Cet email est déjà utilisé.";
                feedback.style.color = "red";
                submitButton.disabled = true; // Désactiver le bouton si l'email existe
            } else {
                submitButton.disabled = false; // Réactiver le bouton si l'email est disponible
            }
        })
        .catch(err => {
            console.error('Erreur lors de la vérification de l\'email', err);
            feedback.textContent = "Erreur lors de la vérification.";
            feedback.style.color = "red";
            submitButton.disabled = true;
        });
    } else {
        submitButton.disabled = false; // Réactiver le bouton si aucun email n'est saisi
    }
});
</script>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '580053194977914', // Remplacez par votre App ID
      cookie     : true,
      xfbml      : true,
      version    : 'v21.0' // Assurez-vous d'utiliser la version correcte
    });
    FB.AppEvents.logPageView();
  };
</script>
<script>
   function loginWithFacebook() {
    FB.login(function(response) {
        if (response.status === 'connected') {
            FB.api('/me', { fields: 'id,name,email' }, function(userInfo) {
                // Envoyer les informations à votre backend
                fetch('facebook_login_handler.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        id: userInfo.id,
                        name: userInfo.name,
                        email: userInfo.email,
                        accessToken: response.authResponse.accessToken
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'new_user') {
                        // Afficher la fenêtre modale pour le choix du rôle
                        document.getElementById('roleModal').style.display = 'flex';
                    } else if (data.status === 'success') {
                        if (data.role === 'prof') {
                            window.location.href = '../back/tables.php';
                        } else {
                            window.location.href = 'home.html';
                        }
                    } else {
                        alert(data.message);
                    }
                });
            });
        } else {
            alert('Facebook login failed!');
        }
    }, { scope: 'public_profile,email' });
}



function setUserRole(role) {
    fetch('set_user_role.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ role: role })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            // Fermer la modale et rediriger
            document.getElementById('roleModal').style.display = 'none';
            if (role === 'prof') {
                window.location.href = '../back/tables.php';
            } else {
                window.location.href = 'home.html';
            }
        } else {
            alert(data.message);
        }
    });
}




// Fonction pour définir le rôle après choix dans le modal
function setRoleAndLogin(role) {
    fetch('facebook_login_handler.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            role: role
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            if (data.role === 'prof') {
                window.location.href = '../back/tables.php';
            } else {
                window.location.href = 'home.html';
            }
        } else {
            alert(data.message);
        }
    });
}
</script>
<script>
    function initGoogleSignIn() {
            window.onLoadCallback = function() {
                gapi.load('auth2', function() {
                    gapi.auth2.init({
                        client_id: '683896753133-t1u8r32o6tep42a6pkujund3j1ramn5i.apps.googleusercontent.com',
                    }).then(function() {
                        handleGoogleSignIn();
                    });
                });
            };
        }

        function handleGoogleSignIn() {
            gapi.auth2.getAuthInstance().signIn().then(function(googleUser) {
                var id_token = googleUser.getAuthResponse().id_token;
                fetch('google_callback.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id_token: id_token })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'new_user') {
                        document.getElementById('roleModal').style.display = 'flex';
                    } else if (data.status === 'existing_user') {
                        if (data.role === 'prof') {
                            window.location.href = '../back/tables.php';
                        } else {
                            window.location.href = 'home.html';
                        }
                    }
                });
            });
        }

</script>
<script>
   function googleInit() {
    gapi.load('auth2', function() {
      gapi.auth2.init({
        client_id: '683896753133-irr48t3kldu1on8hiurrl2ork2kij2r3.apps.googleusercontent.com', // Remplacez par votre propre client ID
        cookiepolicy: 'single_host_origin', // Pour sécuriser l'authentification cross-origin
        redirect_uri: 'http://localhost/projet/view/front_/login.php' // Remplacez par votre URL de redirection correcte
      });

      window.googleSignIn = function() {
        const authInstance = gapi.auth2.getAuthInstance();
        authInstance.signIn().then(user => {
          const idToken = user.getAuthResponse().id_token;

          fetch('verify_google_sign_in.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ idToken: idToken })
          })
          .then(response => response.json())
          .then(data => {
            if (data.status === 'new_user') {
              document.getElementById('roleModal').style.display = 'block';
            } else if (data.status === 'user_exists') {
              if (data.role === 'prof') {
                window.location.href = '../back/tables.php';
              } else {
                window.location.href = 'home.html';
              }
            }
          })
          .catch(error => {
            console.error('Erreur lors de la connexion Google :', error);
          });
        });
      };

      document.getElementById('googleSignInBtn').addEventListener('click', googleSignIn);
    });
  }

  // Initialisation de l'API Google Sign-In
  googleInit();

</script>
<script>
function translateContent() {
      // Fonction pour traduire le contenu en français
      document.querySelectorAll('h4, ul li a').forEach(element => {
        if (element.textContent === 'About') {
          element.textContent = 'À propos';
        } else if (element.textContent === 'Home') {
          element.textContent = 'Accueil';
        }
        // Ajoutez plus de traductions selon votre besoin
      });
    }
  </script>
  <script>
    function generateRandomPassword() {
        var password = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*()';
        for (var i = 0; i < 12; i++) {
            password += characters.charAt(Math.floor(Math.random() * characters.length));
        }
        document.getElementById('mot_de_passe').value = password;
        document.getElementById('confirm_password').value = password; // Réinitialise le champ de confirmation avec le même mot de passe
    }
    function togglePasswordVisibility(id) {
        var passwordField = document.getElementById(id);
        var passwordFieldType = passwordField.getAttribute('type');
        var toggleIcon = passwordField.nextElementSibling;

        if (passwordFieldType === 'password') {
            passwordField.setAttribute('type', 'text');
            toggleIcon.innerHTML = '&#128064;'; // change l'icône en œil barré
        } else {
            passwordField.setAttribute('type', 'password');
            toggleIcon.innerHTML = '&#128065;'; // change l'icône en œil
        }
    }
    // Toggle Dark Mode
const toggleDarkModeButton = document.getElementById('toggle-dark-mode');
const body = document.getElementById('body');

toggleDarkModeButton.addEventListener('click', function() {
    body.classList.toggle('dark-mode');
});

</script>
<style>
   /* Mode clair */
body {
    background-color: #fff;
    color: #000;
}

.form__grp {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
}

/* Mode sombre */
body.dark-mode {
    background-color: #121212;
    color: #fff;
}

body.dark-mode .form__grp {
    background-color: #1e1e1e;
    border: 1px solid #333;
}

.toggle-password {
    cursor: pointer;
}

</style>
</body>
</html>