<?php
include_once "../controller/forumC.php";

$forumC = new forumC();
$var = $forumC->allforum();

if (isset($_POST['choix'])) {
    if ($_POST['choix'] == 'categorie') {
        $var = $forumC->recherchercotegorie($_POST['Search']);
    }
    if ($_POST['choix'] == 'titre') {
        $var = $forumC->recherchertitre($_POST['Search']);
    }
}

// Sorting
if (isset($_GET['sort'])) {
    $sort = $_GET['sort'];
    $order = $sort === 'desc' ? 'DESC' : 'ASC';
    $sql = "SELECT * FROM forum ORDER BY id $order";
    $db = config::getConnexion();
    try {
        $query = $db->prepare($sql);
        $query->execute();
        $var = $query->fetchAll();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="NextGenerationDev">
    <title>Forum</title>
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
                        <img src="assets/img/logo/logo2.png" alt="Forum">
                    </a>
                </div>
                <ul class="main-menu">
                    <li><a href="index.html">Accueil</a></li>
                    <li><a href="about.html">Nos offres</a></li>
                    <li><a href="category.html">Nos cours</a></li>
                    <li><a href="pricing.html">Compétitions</a></li>
                    <li><a href="contact.html">Réclamation</a></li>
                    
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
                        <h4>EVENTS</h4>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><i class="fa-solid fa-arrow-right"></i></li>
                            <li>EVENTS</li>
                        </ul>
                    </div>
                </div>
                <div class="col-xxl-6 col-lg-6">
                    <div class="banner__Thumb">
                        <img src="assets/img/about/ab.png" alt="Forum">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--Forum Content-->
    <section class="atos__hosting pt-120 pb-120">
        <div class="container">
            <!-- Add Post and Administration Buttons -->
            <div class="d-flex justify-content-between mb-4">
                <a href="ajoutera.php" class="btn btn-success">Add an event</a>
                <a href="http://localhost/forum/back/pages/dashboard.php" class="btn btn-secondary">Administration</a>
            </div>

            <!-- Sorting Buttons -->
            <div class="d-flex justify-content-start mb-4">
                <form method="GET" action="" class="me-2">
                    <input type="hidden" name="sort" value="asc">
                    <button type="submit" class="btn btn-primary">Sort Ascending</button>
                </form>
                <form method="GET" action="">
                    <input type="hidden" name="sort" value="desc">
                    <button type="submit" class="btn btn-primary">Sort Descending</button>
                </form>
            </div>

            <!-- Search Bar -->
            <form method="POST" action="" class="d-flex mb-5">
                <select name="choix" id="choix" class="form-select me-2">
                    <option selected>Select Filter</option>
                    <option value="categorie">Category</option>
                    <option value="titre">Title</option>
                </select>
                <input type="text" name="Search" class="form-control me-2" placeholder="Search">
                <button type="submit" class="btn btn-dark">Search</button>
            </form>

            <!-- Forum Posts -->
            <div class="row">
                <?php foreach ($var as $row): ?>
                    <div class="col-md-4">
                        <div class="card">
                            <img src="<?php echo $row['image']; ?>" class="card-img-top" alt="<?php echo $row['titre']; ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $row['titre']; ?></h5>
                                <p class="card-text"><?php echo $row['message']; ?></p>
                                <p><strong>Category:</strong> <?php echo $row['categorie']; ?></p>
                                <p><strong>Date:</strong> <?php echo $row['date']; ?></p>

                                <!-- Show the star image based on the rate -->
                                <div class="star-rating">
                                    <?php 
                                        $rate = $row['rate'];  // Rating value from the database (0 to 5)
                                        // Display the corresponding star image based on the rate
                                        echo '<img src="assets/img/stars/'.$rate.'star.png" alt="Rating: '.$rate.'">';
										
                                    ?>
                                </div>

                                <div class="d-flex justify-content-between">
                                    <a href="edit_a.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">Edit</a>
                                    <a href="supprimer_a.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                                </div>
                                <div class="mt-3">
                                    <a href="ajouterc.php?idarticle=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">Add SPONSOR</a>
                                    <a href="afficherc.php?idarticle=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">View SPONSORS</a>
                                    <a href="rate.php?idarticle=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Rate</a>
                                    <a href="sendmail.php?idarticle=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Report</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
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
