<?php 
include_once "../model/sponsor.php";  
include_once "../controller/sponsorC.php";  

if (isset($_GET['idarticle'])) {
    $id_article = $_GET['idarticle'];
}

if (isset($_POST['idarticle'])) {
    // Updated class and method names to reflect the changes
    $sponsor1 = new sponsor($_POST['idarticle'], $_POST['contenu_'], $_POST['address'], $_POST['number'], $_POST['name'], $_POST['likee'] = 0); 
    $r = new sponsorC();  
    $r->addsponsor($sponsor1);  
    var_dump($r);
    
    header('Location: afficher.php');
} else {
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="NextGenerationDev">
    <title>Add Sponsor</title>
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
                        <img src="assets/img/logo/logo2.png" alt="Add Sponsor">
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
                        <h4>Add Sponsor</h4>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><i class="fa-solid fa-arrow-right"></i></li>
                            <li>Add Sponsor</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Add Sponsor Form -->
    <section class="atos__hosting pt-120 pb-120">
        <div class="container">
            <h2 class="text-center mb-5">Add a New Sponsor</h2>
            <div class="card">
                <div class="card-body">
                    <form method="POST" id="Form">
                        <div class="row">
                            <div class="col-lg-12 mb-3">
                                <input type="hidden" value="<?php echo $id_article ?>" id="idarticle" name="idarticle" class="form-control"/>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <input type="text" placeholder="Content" name="contenu_" class="form-control" id="contenu_" required/>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <input type="text" placeholder="Address" name="address" class="form-control" id="address" required/>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <input type="text" placeholder="Number" name="number" class="form-control" id="number" required/>
                            </div>
                            <div class="col-lg-12 mb-3">
                                <input type="text" placeholder="Name" name="name" class="form-control" id="name" required/>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-success">Save Sponsor</button>
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
        // Validation for the form
        let myForm = document.getElementById('Form');
        myForm.addEventListener('submit', function(e) {
            let myInput = document.getElementById('contenu_');
            let myRegex = /^[a-zA-Z-1-9\s]+$/;
            if (myInput.value.trim() == "") {
                alert("Content is required.");
                e.preventDefault();
            } else if (myRegex.test(myInput.value) == false) {
                alert("Incorrect content input.");
                e.preventDefault();
            }
        });
    </script>
</body>
</html>

<?php } ?>
