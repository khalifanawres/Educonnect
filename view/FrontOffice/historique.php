<?php
// Inclure le controller et la classe Reclamation
include_once('../../controller/ReclamationController.php');
include_once('../../model/Reclamation.php');
// Inclure les fichiers nécessaires pour gérer les réclamations et les réponses
include_once('../../controller/ReponseController.php');  // Contrôleur pour gérer les réponses
include_once('../../model/Reponse.php');  // Modèle pour les réponses

// Instancier les contrôleurs
$reclamationController = new ReclamationController();
$reponseController = new ReponseController();

// Récupérer toutes les réclamations
$reclamations = $reclamationController->getAllReclamations();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_reclamation'])) {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
    $sujet = $_POST['sujet'];
    $message = $_POST['message'];

    // Mettre à jour la réclamation dans la base de données
    $reclamation = new Reclamation($nom, $email, $telephone, $sujet, $message, $id);
    $reclamationController->updateReclamation($reclamation);

    // Réactualiser la page pour afficher les modifications
    header('Location: historique.php');
    exit();
}
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
</head>

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
               <a href="#0">Accueil <i class="fas fa-chevron-down"></i></a>
               
            </li>
            <li>
               <a href="about.html">Nos offres</a>
            </li>
            <li>
               <a href="pricing.html">Nos cours</a>
            </li>
            <li>
               <a href="resserler.html">compétitions</a>
            </li>
            <li>
               <a href="vpshost.html">Projets</a>
            </li>
            <li>
               <a href="#0">Réclamation<i class="fas fa-chevron-down"></i></a>
               <ul class="sub-menu">
               
                 
                  <li class="subtwohober">
                     <a href="contact administrateur.html">
                        <span class="icon"><i class="fa-solid fa-server"></i></span>
                        <span>contact administrateur</span>
                     </a>
                  </li>
                  <li class="subtwohober">
                     <a href="resserler.html">
                        <span class="icon"><i class="fa-brands fa-audible"></i></span>
                        <span>Historique</span>
                     </a>
                  </li>
               </ul>
            </li>
            <li class="btn--items">
               <a href="contact.html" class="cmn--btn">
                  <span>contact</span>
               </a>
            </li>
         </ul>
         <a href="contact.html" class="cmn--btn">
            <span>contact</span>
         </a>
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
               
            </div>
         </div>
         <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6">
            <div class="banner__Thumb">
               <img src="assets/img/about/reserler.png" alt="about-img">
            </div>
         </div>
      </div>
   </div>
</section>
<!--Banner End-->

<body>
   <section class="historique__section pt-80 pb-80">
      <div class="container">
         <h3>Historique des Réclamations</h3>
         <table class="table table-bordered">
            <thead>
               <tr>
                  <th>Nom</th>
                  
                  <th>Sujet</th>
                  <th>Message</th>
                  <th>Statut</th>
                  <th>Actions</th>
               </tr>
            </thead>
            <tbody>


            
               <?php if (count($reclamations) > 0): ?>
                  <?php foreach ($reclamations as $reclamation): ?>
                     <tr>
                        <td><?php echo htmlspecialchars($reclamation['nom']); ?></td>
                       
                        <td><?php echo htmlspecialchars($reclamation['sujet']); ?></td>
                        <td><?php echo htmlspecialchars($reclamation['message']); ?></td>
                        
                        <td>
                        <?php
// Vérifier s'il y a des réponses associées à cette réclamation
$reponses = $reponseController->getReponsesByReclamation($reclamation['id']);
$statut = (count($reponses) > 0) ? 'Répondu' : 'Non répondu';
$statutClass = (count($reponses) > 0) ? 'badge-success' : 'badge-danger';
$statutIcon = (count($reponses) > 0) ? '✔' : '✖'; // Choisir l'icône correspondante
?>
<!-- Affichage du cercle avec l'icône "V" ou "X" -->
<span class="badge <?php echo $statutClass; ?>">
    <span class="statut-icon <?php echo ($statut == 'Répondu') ? 'statut-oui' : 'statut-non'; ?>">
        <?php echo $statutIcon; ?>
    </span>
</span>

<style>
.statut-icon {
    font-size: 24px; /* Taille de l'icône */
    width: 40px; /* Largeur du cercle */
    height: 40px; /* Hauteur du cercle */
    border-radius: 50%; /* Forme circulaire */
    display: flex; /* Centrer l'icône */
    justify-content: center; /* Centrer horizontalement */
    align-items: center; /* Centrer verticalement */
    text-align: center; /* Centrer le texte */
    margin-right: 10px; /* Espacement à droite de l'icône */
}

.statut-oui {
    background-color: #28a745; /* Vert pour "Répondu" */
}

.statut-non {
    background-color: #dc3545; /* Rouge pour "Non répondu" */
}

.statut-icon {
    color: #fff; /* Couleur de l'icône en blanc */
}


</style>



                     
                        <td>
                           <div class="btn-group">
                           <style>
/* Style des boutons carrés et plus petits */
.action-btn {
   font-size: 14px; /* Augmenter légèrement la taille de la police */
   padding: 12px; /* Padding légèrement plus généreux */
   color: white; 
   border: 2px solid transparent; 
   border-radius: 8px; /* Coins plus arrondis pour un effet doux */
   cursor: pointer;
   transition: all 0.3s ease;
   width: 100px; /* Largeur légèrement plus grande */
   height: 50px; /* Hauteur équilibrée */
   text-align: center;
   font-weight: bold; /* Texte en gras */
   display: flex;
   justify-content: center;
   align-items: center; /* Centrer le texte dans le bouton */
   box-sizing: border-box; /* Assurer que padding est inclus dans les dimensions */
   text-transform: uppercase; /* Texte en majuscules */
   position: relative;
   overflow: hidden; /* Pour éviter que les bordures débordent lors de l'animation */
}

/* Couleurs spécifiques aux boutons avec un bleu clair */
.action-btn-details {
   background: linear-gradient(45deg, #5DADE2, #2980B9); /* Dégradé bleu clair */
}

.action-btn-edit {
   background: linear-gradient(45deg, #27AE60, #1D8348); /* Dégradé vert foncé */
}

.action-btn-delete {
   background: linear-gradient(45deg, #E74C3C, #C0392B); /* Dégradé rouge foncé */
}

/* Effet de survol */
.action-btn:hover {
   transform: scale(1.1); /* Légère augmentation de la taille */
   box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Ombre au survol plus marquée */
   opacity: 0.9; /* Légère transparence au survol */
}

/* Effet au survol pour Voir Détails */
.action-btn-details:hover {
   background: linear-gradient(45deg, #3498DB, #2980B9); /* Bleu encore plus clair */
}

/* Effet au survol pour Modifier */
.action-btn-edit:hover {
   background: linear-gradient(45deg, #1D8348, #145A32); /* Vert encore plus foncé */
}

/* Effet au survol pour Supprimer */
.action-btn-delete:hover {
   background: linear-gradient(45deg, #C0392B, #9C2710); /* Rouge plus foncé */
}

/* Animation au clic */
.action-btn:active {
   transform: scale(0.95); /* Réduction de la taille du bouton au clic */
   transition: transform 0.1s ease-in-out; /* Rétablissement rapide */
}

/* Aligner les boutons sur la même ligne dans une cellule de tableau */
.btn-group {
   display: flex;
   justify-content: center;
   gap: 15px; /* Espacement plus réduit entre les boutons */
}

/* Centrer les boutons dans une cellule de tableau */
td .btn-group {
   display: flex;
   justify-content: center;
   gap: 15px;
}


</style>

<!-- Boutons dans un même groupe (ajout de la classe .btn-group) -->
<div class="btn-group">
   <button type="button" class="btn action-btn action-btn-details" 
      data-bs-toggle="modal" data-bs-target="#detailsModal"
      data-id="<?php echo $reclamation['id']; ?>"
      data-email="<?php echo $reclamation['email']; ?>"
      data-telephone="<?php echo $reclamation['telephone']; ?>"
      data-date="<?php echo $reclamation['date']; ?>">
      Voir Détails
   </button>
</div>


   

   <!-- Bouton "Modifier" -->
   <div class="btn-group">
   <button type="button" class="btn action-btn action-btn-edit" 
      data-bs-toggle="modal" data-bs-target="#editModal" 
      data-id="<?= $reclamation['id']; ?>" 
      data-nom="<?= htmlspecialchars($reclamation['nom']); ?>" 
      data-email="<?= htmlspecialchars($reclamation['email']); ?>" 
      data-telephone="<?= htmlspecialchars($reclamation['telephone']); ?>" 
      data-sujet="<?= htmlspecialchars($reclamation['sujet']); ?>" 
      data-message="<?= htmlspecialchars($reclamation['message']); ?>"
      <?php if (count($reponses) > 0): ?> 
         disabled
      <?php endif; ?>>
      Modifier
   </button>
   
 <!<!-- Bouton "Voir Réponse" -->
 <div class="btn-group">
<button type="button" class="btn action-btn action-btn-details" data-bs-toggle="modal" data-bs-target="#reponseModal<?= $reclamation['id']; ?>">
   Voir Réponse
</button>        

<!-- Modal pour afficher les réponses -->
<div class="modal fade" id="reponseModal<?= $reclamation['id']; ?>" tabindex="-1" aria-labelledby="reponseModalLabel<?= $reclamation['id']; ?>" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg"><!-- Taille de la fenêtre augmentée avec "modal-lg" -->
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="reponseModalLabel<?= $reclamation['id']; ?>">Réponses à la Réclamation n°<?= $reclamation['id']; ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <?php 
            // Récupérer les réponses spécifiques à cette réclamation
            $reponses = $reponseController->getReponsesByReclamation($reclamation['id']);
            if (count($reponses) > 0): ?>
               <h4>Réponses</h4>
               <table class="table table-bordered">
                  <thead>
                     <tr>
                        <th>ID de la Réponse</th>
                        <th>Date de Réponse</th>
                        <th>Message de Réponse</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php foreach ($reponses as $reponse): ?>
                        <tr>
                           <td><?= htmlspecialchars($reponse['id_reponse']); ?></td>
                           <td><?= htmlspecialchars($reponse['date_reponse']); ?></td>
                           <td><?= nl2br(htmlspecialchars($reponse['message_reponse'])); ?></td>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            <?php else: ?>
               <p>Aucune réponse n'a été fournie pour cette réclamation.</p>
            <?php endif; ?>

    
           
         </div>
      </div>
   </div>
</div>



  <!-- Formulaire de suppression -->
  
<form action="delete_reclamation.php" method="POST" style="display:inline;">
   <input type="hidden" name="id" value="<?= $reclamation['id']; ?>">
   <!-- Ajoutez la classe btn et action-btn ici -->
   <button type="submit" class="btn action-btn action-btn-delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réclamation ?');">
      Supprimer
   </button>
</form>




               <?php endforeach; ?>
            <?php else: ?>
               <tr>
                  <td colspan="6" class="text-center">Aucune réclamation disponible.</td>
               </tr>
            <?php endif; ?>
         </tbody>
      </table>
   </div>
</section>


<!-- Modal pour voir les détails -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="detailsModalLabel">Détails de la Réclamation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <p><strong>ID :</strong> <span id="details-id"></span></p>
            <p><strong>Email :</strong> <span id="details-email"></span></p>
            <p><strong>Téléphone :</strong> <span id="details-telephone"></span></p>
            <p><strong>Date et Heure :</strong> <span id="details-date"></span></p>
         </div>
      </div>
   </div>
</div>

<!-- Modal pour modifier la réclamation -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Modifier Réclamation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">
            <form method="POST" action="" id="editForm">
               <input type="hidden" name="id" id="reclamation-id">
               <div class="mb-3">
                  <label for="reclamation-nom" class="form-label">Nom</label>
                  <input type="text" name="nom" id="reclamation-nom" class="form-control" required>
               </div>
               <div class="mb-3">
                  <label for="reclamation-email" class="form-label">Email</label>
                  <input type="email" name="email" id="reclamation-email" class="form-control" required>
               </div>
               <div class="mb-3">
                  <label for="reclamation-telephone" class="form-label">Numéro de Téléphone</label>
                  <input type="text" name="telephone" id="reclamation-telephone" class="form-control" 
                         pattern="^\d{8}$" title="Le numéro de téléphone doit contenir exactement 8 chiffres." required>
               </div>
               <div class="mb-3">
                  <label for="reclamation-sujet" class="form-label">Sujet</label>
                  <input type="text" name="sujet" id="reclamation-sujet" class="form-control" 
                         minlength="5" title="Le sujet doit contenir au moins 5 caractères." required>
               </div>
               <div class="mb-3">
                  <label for="reclamation-message" class="form-label">Message</label>
                  <textarea name="message" id="reclamation-message" class="form-control" 
                            minlength="20" title="Le message doit contenir au moins 20 caractères." required></textarea>
               </div>
               <button type="submit" name="edit_reclamation" class="btn btn-primary">Enregistrer</button>
            </form>
         </div>
      </div>
   </div>
</div>
<script>
   document.getElementById('editForm').addEventListener('submit', function (event) {
      const email = document.getElementById('reclamation-email').value;
      const telephone = document.getElementById('reclamation-telephone').value;
      const sujet = document.getElementById('reclamation-sujet').value;
      const message = document.getElementById('reclamation-message').value;

      // Vérification du format de l'email
      if (!email.includes('@')) {
         alert("L'adresse email doit contenir le symbole '@'.");
         event.preventDefault();
         return;
      }

      // Vérification du numéro de téléphone
      if (!/^\d{8}$/.test(telephone)) {
         alert('Le numéro de téléphone doit contenir exactement 8 chiffres.');
         event.preventDefault();
         return;
      }

      // Vérification de la longueur du sujet
      if (sujet.length < 5) {
         alert('Le sujet doit contenir au moins 5 caractères.');
         event.preventDefault();
         return;
      }

      // Vérification de la longueur du message
      if (message.length < 20) {
         alert('Le message doit contenir au moins 20 caractères.');
         event.preventDefault();
      }
   });
</script>


   <!-- Modals for details and editing (no change) -->
   <!-- ... (modal code remains the same) ... -->

   <script src="assets/js/jquery-3.6.0.min.js"></script>
   <script src="assets/js/bootstrap.bundle.js"></script>
   <script>
     document.addEventListener('DOMContentLoaded', function () {
   var myModal = document.getElementById('detailsModal');
   myModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget; // Le bouton qui a déclenché l'événement
      var id = button.getAttribute('data-id');
      var email = button.getAttribute('data-email');
      var telephone = button.getAttribute('data-telephone');
      var date = button.getAttribute('data-date');

      // Mettre à jour les éléments du modal avec les valeurs récupérées
      document.getElementById('details-id').innerText = id;
      document.getElementById('details-email').innerText = email;
      document.getElementById('details-telephone').innerText = telephone;
      document.getElementById('details-date').innerText = date;
   });
});


      $('#editModal').on('show.bs.modal', function (event) {
         var button = $(event.relatedTarget);
         var id = button.data('id');
         var nom = button.data('nom');
         var email = button.data('email');
         var telephone = button.data('telephone');
         var sujet = button.data('sujet');
         var message = button.data('message');
         var modal = $(this);
         modal.find('#reclamation-id').val(id);
         modal.find('#reclamation-nom').val(nom);
         modal.find('#reclamation-email').val(email);
         modal.find('#reclamation-telephone').val(telephone);
         modal.find('#reclamation-sujet').val(sujet);
         modal.find('#reclamation-message').val(message);
      });
   </script>
</body>
</html>