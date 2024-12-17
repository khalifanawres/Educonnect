<?php
include_once('../../../controller/CompetitionController.php');
include_once('../../../Model/Competition.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
    $competitionController = new CompetitionController();

    $competitionData = $competitionController->getCompetitionById($id);

    if (!$competitionData) {
        die("Competition not found!");
    }
} else {
    header("Location: ../../FrontOffice/Competitions/list_competitions_form.php");
    exit;
}

// Handle form submission (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = trim($_POST['nom']);
    $description = trim($_POST['description']);
    $duree = trim($_POST['duree']);
    $contenu = trim($_POST['contenu']);

    // Server-side validation
    $errors = [];

    if (empty($nom)) {
        $errors[] = "Nom is required.";
    }
    if (empty($description)) {
        $errors[] = "Description is required.";
    }
    if (empty($duree) || !is_numeric($duree)) {
        $errors[] = "Duration must be a number.";
    }
    if (empty($contenu)) {
        $errors[] = "Content is required.";
    }

    if (empty($errors)) {
        $competition = new Competition($id, $nom, $description, $duree, $contenu); 
        $competitionController->updateCompetition($competition); 
        header("Location: list_competitions.php");
        exit;
    }
}
?>
<?php 
include_once('../../BackOffice/Competitions/update_competition.php'); 
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
   <link rel="stylesheet" href="../assets/css/update_competition.css">
   <style>
       /* General table styling */
       .competitions-table {
           width: 100%;
           border-collapse: collapse;
           margin-top: 20px;
           font-size: 16px;
       }

       .competitions-table th, 
       .competitions-table td {
           border: 1px solid #ddd;
           padding: 12px;
           text-align: center;
       }

       .competitions-table th {
           background-color: #2c3e50;
           color: #fff;
           font-weight: bold;
           text-transform: uppercase;
       }

       .competitions-table tr:nth-child(even) {
           background-color: #f9f9f9;
       }

       .competitions-table tr:hover {
           background-color: #f1f1f1;
       }

       .cmn--btn {
           display: inline-block;
           padding: 8px 12px;
           margin: 0 5px;
           background-color: #3498db;
           color: #fff;
           text-decoration: none;
           border-radius: 4px;
           font-size: 14px;
           transition: background-color 0.3s;
       }

       .cmn--btn:hover {
           background-color: #2980b9;
       }

       .competitions__section {
           padding: 40px 20px;
           background-color: #ecf0f1;
       }

       .competitions__section h2 {
           font-size: 28px;
           color: #34495e;
           margin-bottom: 10px;
       }

       .competitions__section p {
           color: #7f8c8d;
           font-size: 18px;
       }

       .add-competition-btn {
           margin-top: 20px;
       }

       .add-competition-btn a {
           padding: 12px 20px;
           background-color: #27ae60;
           color: #fff;
           text-decoration: none;
           border-radius: 4px;
           font-size: 16px;
           transition: background-color 0.3s;
       }

       .add-competition-btn a:hover {
           background-color: #229954;
       }
   </style>
</head>

<body>


<!--==== Scrool Top Bottom Here ======= -->
<div id="progress">
   <span id="valiu"><i class="fas fa-arrow-up"></i></span>
</div>
<!--==== Scrool Top Bottom End ======= -->


<!--Update Competitions Here-->
<div class="competitions__section pt-80">
       <div class="competitions_inner">
           <div class="container">
             <div class="section__header center mb-5">
                <h2 class="text-black wow fadeInDown" data-wow-delay="0.2s">
                   Modifier la <span class="text-base">Compétition</span>
                </h2>
                <p class="text-black wow fadeInDown" data-wow-delay="0.4s">
                   Mettez à jour les informations de la compétition.
                </p>
             </div>

             <div class="row justify-content-center align-items-center">
                <div class="col-lg-12">
                  <div class="competitions__card__wrap">
                      <?php if (!empty($errors)): ?>
                          <div class="error-messages">
                              <?php foreach ($errors as $error): ?>
                                  <p class="error-message"><?= htmlspecialchars($error); ?></p>
                              <?php endforeach; ?>
                          </div>
                      <?php endif; ?>

                      <form method="POST">
                            
                            <div class="form-group">
                              <label for="nom">Nom :</label>
                              <input type="text" id="nom" name="nom" value="<?php echo htmlspecialchars($competitionData['nom']); ?>" required>
                          </div>

                          <div class="form-group">
                              <label for="description">Description :</label>
                              <textarea id="description" name="description" required><?php echo htmlspecialchars($competitionData['description']); ?></textarea>
                          </div>

                          <div class="form-group">
                              <label for="duree">Durée (en jours) :</label>
                              <input type="number" id="duree" name="duree" value="<?php echo htmlspecialchars($competitionData['duree']); ?>" required>
                          </div>

                          <div class="form-group">
                              <label for="contenu">Contenu :</label>
                              <textarea id="contenu" name="contenu" required><?php echo htmlspecialchars($competitionData['contenu']); ?></textarea>
                          </div>

                          <div class="form-group">
                              <button type="submit" class="cmn--btn">Mettre à jour la compétition</button>
                          </div>
                      </form>
                  </div>
               </div>
             </div>
           </div>
       </div>
    </div>
<!--Update Competitions End-->


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