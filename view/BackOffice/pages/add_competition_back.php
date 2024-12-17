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
   <link rel="stylesheet" href="../assets/css/add_competition.css">
</head>

<body>



<!--Add Competitions Here-->
<div class="competitions__section pt-80">
       <div class="competitions_inner">
           <div class="container">
             <div class="section__header center mb-5">
                <h2 class="text-black wow fadeInDown" data-wow-delay="0.2s">
                   Ajouter une <span class="text-base">Compétition</span>
                </h2>
                <p class="text-black wow fadeInDown" data-wow-delay="0.4s">
                   Remplissez les informations nécessaires pour ajouter une nouvelle compétition.
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

                      <form method="POST" action="../../BackOffice/Competitions/add_competition.php">
                          <div class="form-group">
                              <label for="nom">Nom :</label>
                              <input type="text" id="nom" name="nom" value="" >
                          </div>

                          <div class="form-group">
                              <label for="description">Description :</label>
                              <textarea id="description" name="description" ></textarea>
                          </div>

                          <div class="form-group">
                              <label for="duree">Durée (en jours) :</label>
                              <input type="number" id="duree" name="duree" value="" >
                          </div>

                          <div class="form-group">
                              <label for="contenu">Contenu :</label>
                              <textarea id="contenu" name="contenu" ></textarea>
                          </div>

                          <div class="form-group">
                              <button type="submit" class="cmn--btn">Ajouter la compétition</button>
                          </div>
                      </form>
                  </div>
               </div>
             </div>
           </div>
       </div>
    </div>
<!--Add Competitions End-->

</body>

</html>