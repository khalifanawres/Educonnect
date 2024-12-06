<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

// Récupérer les informations de l'utilisateur depuis la session
$user = $_SESSION['user'];
$userId = $user['id']; // Par exemple, si l'ID est stocké dans 'id' dans la session
$userName = $user['nom']; // Nom de l'utilisateur
$userEmail = $user['email']; // Email de l'utilisateur
$userPhoto = isset($user['photo']) ? $user['photo'] : 'assets/img/profil/image.jpg'; // Photo de profil (par défaut si vide)
$userDob = isset($user['dob']) ? $user['dob'] : null; // Date de naissance
$userTel = isset($user['tel']) ? $user['tel'] : null; // Téléphone

/*if (isset($_SESSION['success'])) {
   echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
   unset($_SESSION['success']);
}

if (isset($_SESSION['error'])) {
   echo "<div class='alert alert-danger'>" . $_SESSION['error'] . "</div>";
   unset($_SESSION['error']);
}*/
?>
<!--Website: wwww.codingdung.com-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodingDung | Profile Template</title>
    <link rel="stylesheet" href="assets/css/style_profile.css">
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
   <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
<!--==== Scrool Top Bottom Here ======= -->
<div id="progress">
    <span id="valiu"><i class="fas fa-arrow-up"></i></span>
 </div>
 <!--==== Scrool Top Bottom End ======= -->
 
 
 
 <!--Header Here-->
    <header class="header-section">
       <div class="container">
          <div class="header-wrapper">
             <div class="logo-menu">
                <a href="index.html" class="logo">
                   <img src="assets/img/logo/logo2.png" alt="img">
                </a>
             </div>
             <div class="header-bar d-lg-none">
                <span></span>
                <span></span>
                <span></span>
             </div>
             <ul class="main-menu">
                <li class="active">
                   <a href="#0">Home <i class="fas fa-chevron-down"></i></a>
                   <ul class="sub-menu home__subs">
                      <li class="subtwohober">
                         <a href="index.html">
                            <span><i class="fa-solid fa-house"></i></span>
                            <span>Home One</span>
                         </a>
                      </li>
                      <li class="subtwohober">
                         <a href="home.html">
                            <span><i class="fa-solid fa-house"></i></span>
                            <span>Home Two</span>
                         </a>
                      </li>
                      <li class="subtwohober">
                         <a href="sharp-home.html">
                            <span><i class="fa-solid fa-house"></i></span>
                            <span>Home Three</span>
                         </a>
                      </li>
                   </ul>
                </li>
                <li>
                   <a href="about.html">About</a>
                </li>
                <li>
                   <a href="pricing.html">Pricing</a>
                </li>
                <li>
                   <a href="resserler.html">Hosting</a>
                </li>
                <li>
                   <a href="vpshost.html">Promos</a>
                </li>
                <li>
                   <a href="#0">Pages <i class="fas fa-chevron-down"></i></a>
                   <ul class="sub-menu">
                      <li class="subtwohober">
                         <a href="resserler.html">
                            <span class="icon"><i class="fa-brands fa-audible"></i></span>
                            <span>Reseller Hosting</span>
                         </a>
                      </li>
                      <li class="subtwohober">
                         <a href="sharehost.html">
                            <span class="icon"><i class="fa-solid fa-server"></i></span>
                            <span>Shared Hosting</span>
                         </a>
                      </li>
                      <li class="subtwohober">
                         <a href="cloudhost.html">
                            <span class="icon"><i class="fa-solid fa-cloud"></i></span>
                            <span>Vps Hosting</span>
                         </a>
                      </li>
                      <li class="subtwohober">
                         <a href="services.html">
                            <span class="icon"><i class="fa-solid fa-cloud"></i></span>
                            <span>Services</span>
                         </a>
                      </li>
                      <li class="subtwohober">
                         <a href="blog.html">
                            <span class="icon"><i class="fa-solid fa-sitemap"></i></span>
                            <span>Blog</span>
                         </a>
                      </li>
                   </ul>
                </li>
                <li class="btn--items">
                   <a href="contact.html" class="cmn--btn">
                      <span>Contact us</span>
                   </a>
                </li>
                <li class="active">
                    <a href="#0" class="profile-btn">
                        <img src="assets/img/profil/image.jpg" alt="Profile Picture">
                      </a>
                    <ul class="sub-menu home__subs">
                       <li class="subtwohober">
                          <a href="profile.php">
                             <span><i class="fa-solid fa-house"></i></span>
                             <span>Profile</span>
                          </a>
                       </li>
                       <li class="subtwohober">
                          <a href="login.php">
                             <span><i class="fa-solid fa-house"></i></span>
                             <span>Déconnecter</span>
                          </a>
                       </li>
                    </ul>
                 </li>
             </ul>
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
                   Profil
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
                      Profile
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

  <div id="bd" class="container light-style flex-grow-1 container-p-y">
    <div class="card overflow-hidden">
        <div class="row no-gutters row-bordered row-border-light">
            <div class="col-md-3 pt-0">
                <div class="list-group list-group-flush account-settings-links">
                    <a class="list-group-item list-group-item-action active" data-toggle="list" href="#account-general">General</a>
                    <a class="list-group-item list-group-item-action" data-toggle="list" href="#account-change-password">Change password</a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="account-general">
                        <div class="card-body media align-items-center">
                            <div class="bloc">
                                <div>
                                    <!-- Afficher l'image de profil -->
                                    <img src="<?= $userPhoto ?>" alt class="d-block ui-w-80">
                                </div>
                                <div>
                                    <p>ID: <?= $userId ?></p>
                                    <p>Nom: <?= $userName ?></p>
                                    <p>E-mail: <?= $userEmail ?></p>
                                </div>
                            </div>
                            <div class="media-body ml-4">
                                <label class="btn btn-outline-primary">
                                    Upload new photo
                                    <input type="file" class="account-settings-fileinput" name="profile_photo" onchange="uploadPhoto(event)">
                                </label> 
                                <button type="button" class="btn btn-default md-btn-flat" onclick="resetPhoto()">Reset</button>
                                <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
                            </div>
                        </div>
                        <hr class="border-light m-0">
                        <div class="card-body">
                            <form method="POST" action="update_profile.php">
                                <div class="form-group">
                                    <label class="form-label">ID</label>
                                    <input type="text" class="form-control mb-1" value="<?= $userId ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" value="<?= $userName ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">E-mail</label>
                                    <input type="email" class="form-control mb-1" name="email" value="<?= $userEmail ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control mb-1" name="dob" value="<?= $userDob ?>">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Tel</label>
                                    <input type="text" class="form-control mb-1" name="tel" value="<?= $userTel ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="account-change-password">
    <form method="POST" action="update_password.php">
        <div class="card-body pb-2">
            <div class="form-group">
                <label class="form-label">Mot de passe actuel</label>
                <input type="password" class="form-control" name="current_password" required>
            </div>
            <div class="form-group">
                <label class="form-label">Nouveau mot de passe</label>
                <input type="password" class="form-control" name="new_password" required>
            </div>
            <div class="form-group">
                <label class="form-label">Répéter le nouveau mot de passe</label>
                <input type="password" class="form-control" name="repeat_password" required>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour le mot de passe</button>
        </div>
    </form>
</div>
                </div>
            </div>
        </div>
    </div>
</div>

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

   <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>
    <script>
    // Fonction pour mettre à jour l'image de profil (en cas de changement)
    function uploadPhoto(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('.ui-w-80').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    }

    // Fonction pour réinitialiser la photo à l'image par défaut
    function resetPhoto() {
        document.querySelector('.ui-w-80').src = 'assets/img/profil/image.jpg';
    }
</script>
</body>

</html>