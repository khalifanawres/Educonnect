<?php
include_once "../controller/sponsorC.php"; // Updated to reflect the new controller

// Check if the article ID is set in the URL
if (isset($_GET['idarticle'])) {
    $idarticle = $_GET['idarticle'];
} else {
    $idarticle = null; // Ensure $idarticle is defined
}

// Create a new instance of sponsorC class (replacing commentaireC)
$sponsorC = new sponsorC(); // Updated to reflect the new controller

// Retrieve sponsors for the specified article (replacing findbyarticle with an appropriate method)
$tab = $sponsorC->findbyarticle($idarticle); // Make sure this method is updated for sponsors

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['like_sponsor'])) {
    // Get the sponsor ID and current like count from the form submission
    $sponsorId = $_POST['sponsor_id']; // Updated to sponsor_id
    $likee = $_POST['likee'];
    
    // Increment the like count by 1
    $likee++;
    
    // Call the updateLikeValue method to increment likes for the sponsor (update this method if necessary)
    $sponsorC->updateLikeValue($sponsorId, $likee); // Updated to sponsorC
    
    // Redirect back to the same page after updating the like count
    header("Location: afficherC.php?idarticle=$idarticle"); // Updated to reflect sponsors
    exit();
}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="NextGenerationDev">
    <title>Sponsors</title> <!-- Updated title -->
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
    <!--Header-->
    <header class="header-section">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo-menu">
                    <a href="index.html" class="logo">
                        <img src="assets/img/logo/logo2.png" alt="Sponsors">
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

    <!--Banner-->
    <section class="breadcumnd__banner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xxl-6 col-lg-6">
                    <div class="banner__content">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Sponsors Section-->
    <section class="atos__hosting pt-120 pb-120">
        <div class="container">
            <?php if ($idarticle): ?>
                <h2 class="text-center mb-5">Sponsors for Article ID: <?php echo $idarticle; ?></h2> <!-- Updated heading -->
            <?php else: ?>
                <h2 class="text-center mb-5">No Article Selected</h2>
            <?php endif; ?>

            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID Sponsor</th>
                                <th>ID Article</th>
                                <th>Content</th>
                                <th>Address</th> <!-- Added new column for Address -->
                                <th>Number</th>  <!-- Added new column for Number -->
                                <th>Name</th>    <!-- Added new column for Name -->
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($tab as $row): ?>
                                <tr>
                                    <td><?php echo $row['idsponsor']; ?></td>
                                    <td><?php echo $row['idarticle']; ?></td>
                                    <td><?php echo $row['contenu_']; ?></td>
                                    <td><?php echo $row['address']; ?></td>  <!-- Displaying Address -->
                                    <td><?php echo $row['number']; ?></td>   <!-- Displaying Number -->
                                    <td><?php echo $row['name']; ?></td>     <!-- Displaying Name -->
                                    <td>
                                        <div class="d-flex">
                                            <a href="supprimer_c.php?idsponsor=<?php echo $row['idsponsor']; ?>" class="btn btn-danger me-2">Delete</a>
                                            <form method="POST">
                                                <input type="hidden" name="sponsor_id" value="<?php echo $row['idsponsor']; ?>">
                                                <input type="hidden" name="likee" value="<?php echo $row['likee']; ?>">
                                                <button type="submit" name="like_sponsor" class="btn btn-primary">
                                                    <i class="fa fa-thumbs-up"></i> <?php echo $row['likee']; ?>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!--Footer-->
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
</body>
</html>
