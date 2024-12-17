<?php
include_once "../model/forum.php";
include_once "../controller/forumC.php";

if (isset($_POST['categorie'])) {
    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageExtension = pathinfo($imageName, PATHINFO_EXTENSION);

        // Ensure the file is an image
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array(strtolower($imageExtension), $allowedExtensions)) {
            $imageDestination = "../uploads/" . uniqid() . '.' . $imageExtension;  // Generate a unique filename
            // Move the uploaded image to the specified folder
            if (move_uploaded_file($imageTmpName, $imageDestination)) {
                $imagePath = $imageDestination;  // Store the path of the uploaded image
            } else {
                echo "Failed to upload image.";
                exit;
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
            exit;
        }
    } else {
        // Default image if none is uploaded
        $imagePath = 'default_image.jpg';
    }

    // Create the forum object with the uploaded image
    $forum1 = new forum($_POST['categorie'], $_POST['titre'], $_POST['message'], $imagePath, $_POST['date'], $_POST['rate'] = 0);
    $r = new forumC();
    $r->addforum($forum1);

    // Redirect after successful post
    header('Location: afficher.php');
} else {
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="NextGenerationDev">
    <title>Add Post</title>
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
                        <img src="assets/img/logo/logo2.png" alt="Add Post">
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

    <!-- Banner -->
    <section class="breadcumnd__banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xxl-6 col-lg-6">
                    <div class="banner__content">
                        
                    </div>
                </div>
                <div class="col-xxl-6 col-lg-6">
                    <div class="banner__Thumb">
                        
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add Post Form -->
    <section class="atos__hosting pt-120 pb-120">
        <div class="container">
            <h2 class="text-center mb-5">Add a New Post</h2>
            <div class="card">
                <div class="card-body">
                    <form method="POST" id="Form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <input type="text" placeholder="Category" name="categorie" class="form-control" id="categorie" required>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <input type="text" placeholder="Title" name="titre" class="form-control" id="titre" required>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <textarea placeholder="Message" name="message" class="form-control" id="message" rows="5" required></textarea>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <input type="file" name="image" class="form-control" id="image" accept="image/*" required>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <input type="date" name="date" class="form-control" id="date" required>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary">Add Post</button>
                                <a href="afficher.php" class="btn btn-secondary">View Posts</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer-section section-bg pt-120">
        <div class="container">
            <div class="footer-top pb-120">
                <div class="row g-4">
                    <div class="col-lg-4">
                        <a href="index.html" class="footer-logo">
                            <img src="assets/img/logo/logo-black.png" alt="Footer Logo">
                        </a>
                        <p>Lorem ipsum dolor sit amet consectetur.</p>
                    </div>
                    <div class="col-lg-4">
                        <h5>Quick Links</h5>
                        <ul class="footer-nav">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="about.html">About</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h5>Contact</h5>
                        <p>Email: support@example.com</p>
                        <p>Phone: +123456789</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        document.getElementById("date").value = new Date().toISOString().split("T")[0];
    </script>
</body>
</html>
<?php } ?>
