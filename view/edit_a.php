<?php 
include_once "../model/forum.php";
include_once "../controller/forumC.php";

$rec = null;

$id = $_GET['id'];
$forumC = new forumC();
$currentforum = $forumC->findforum($id);

if (isset($_POST["categorie"])) {
    if (!empty($_POST["categorie"])) {

        // Handle the image upload
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $imagePath = "uploads/" . basename($_FILES['image']['name']); // Path for saving the uploaded image

            // Check if the 'uploads' folder exists, otherwise create it
            if (!file_exists("uploads")) {
                mkdir("uploads", 0777, true);
            }

            // Move the uploaded file to the uploads folder
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                echo "Image uploaded successfully.";
            } else {
                echo "Failed to upload image.";
            }
        } else {
            // If no new image is uploaded, keep the existing image
            $imagePath = $currentforum['image'];
        }

        // Create the forum object with the updated information
        $forum = new forum(
            $_POST['categorie'],
            $_POST['titre'],
            $_POST['message'],
            $imagePath,  // Use the uploaded or existing image path
            $_POST['date'],
            $_POST['rate'] = 0
        );

        // Update the forum post in the database
        $forumC->updateforum($forum, $id);
        header('Location: afficher.php');
    } else {
        $error = "Missing information";
    }
}
?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="NextGenerationDev">
    <title>Edit Post</title>
    <link rel="shortcut icon" href="assets/img/favicon/favicon.png">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/odometer.css">
    <link rel="stylesheet" href="assets/css/owl.min.css">
    <link rel="stylesheet" href="assets/css/all.min.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <!-- Header -->
    <header class="header-section">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo-menu">
                    <a href="index.html" class="logo">
                        <img src="assets/img/logo/logo2.png" alt="Forum">
                    </a>
                </div>
                <ul class="main-menu">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="category.html">Category</a></li>
                    <li><a href="pricing.html">Pricing</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="logout.php" class="cmn--btn"><span>Logout</span></a></li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Edit Post Form -->
    <section class="atos__hosting pt-120 pb-120">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Edit Post</h5>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="categorie">Category</label>
                                    <input value="<?= $currentforum['categorie']?>" type="text" name="categorie" class="form-control" id="categorie">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="titre">Title</label>
                                    <input value="<?= $currentforum['titre']?>" type="text" name="titre" class="form-control" id="titre">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="message">Message</label>
                                    <input value="<?= $currentforum['message']?>" type="text" name="message" class="form-control" id="message">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="image">Image</label>
                                    <!-- Image upload field -->
                                    <input type="file" name="image" class="form-control" id="image">
                                    <p>Current Image: <img src="<?= $currentforum['image']?>" alt="Current Image" width="100"></p>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input value="<?= $currentforum['date']?>" type="text" name="date" class="form-control" id="date">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group mrb-0">
                                    <button type="submit" class="btn btn-primary mt-3">Edit Post</button>
                                    <a href="afficher.php" class="btn btn-link mt-3">Display Forum</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-area section-gap">
        <div class="container">
            <div class="row">
                <div class="col-lg-3  col-md-12">
                    <div class="single-footer-widget">
                        <h6>Top Products</h6>
                        <ul class="footer-nav">
                            <li><a href="#">Managed Website</a></li>
                            <li><a href="#">Manage Reputation</a></li>
                            <li><a href="#">Power Tools</a></li>
                            <li><a href="#">Marketing Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6  col-md-12">
                    <div class="single-footer-widget newsletter">
                        <h6>Newsletter</h6>
                        <p>You can trust us. We only send promo offers, not a single spam.</p>
                        <div id="mc_embed_signup">
                            <form target="_blank" novalidate="true" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="form-inline">
                                <div class="form-group row" style="width: 100%">
                                    <div class="col-lg-8 col-md-12">
                                        <input name="EMAIL" placeholder="Enter Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Email '" required="" type="email">
                                        <div style="position: absolute; left: -5000px;">
                                            <input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <button class="nw-btn primary-btn">Subscribe<span class="lnr lnr-arrow-right"></span></button>
                                    </div>
                                </div>
                                <div class="info"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3  col-md-12">
                    <div class="single-footer-widget mail-chimp">
                        <h6 class="mb-20">Instagram Feed</h6>
                        <ul class="instafeed d-flex flex-wrap">
                            <li><img src="img/i1.jpg" alt=""></li>
                            <li><img src="img/i2.jpg" alt=""></li>
                            <li><img src="img/i3.jpg" alt=""></li>
                            <li><img src="img/i4.jpg" alt=""></li>
                            <li><img src="img/i5.jpg" alt=""></li>
                            <li><img src="img/i6.jpg" alt=""></li>
                            <li><img src="img/i7.jpg" alt=""></li>
                            <li><img src="img/i8.jpg" alt=""></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row footer-bottom d-flex justify-content-between">
                <p class="col-lg-8 col-sm-12 footer-text m-0 text-white">
                    Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved
                </p>
                <div class="col-lg-4 col-sm-12 footer-social">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-dribbble"></i></a>
                    <a href="#"><i class="fa fa-behance"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="assets/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="assets/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="assets/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="assets/js/owl.min.js"></script>
    <script src="assets/js/all.min.js"></script>
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <script src="assets/js/odometer.min.js"></script>
    <script src="assets/js/magnific-popup.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>
