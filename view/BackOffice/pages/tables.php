
<?php
include('../../../controller/ReclamationController.php');

// Récupération des réclamations
$controller = new ReclamationController();
$reclamations = $controller->getAllReclamations();
$reclamationController = new ReclamationController();
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Récupération des réclamations, en passant le terme de recherche à la méthode
$controller = new ReclamationController();
$reclamations = $controller->getAllReclamations($search);


// Obtenir le nombre de réclamations non répondues
$nonReponduCount = $reclamationController->getNonReponduCount();
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Argon Dashboard 3 by Educonnect
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
  <!-- Modal CSS -->
  <style>
    .modal-backdrop.show {
      opacity: 0.5;
    }
    .modal-content {
      width: 130%; /* Augmenter la largeur de la fenêtre */
      margin: 0 auto; /* Centrer la fenêtre modale */
      border-radius: 10px;
      height: 200%; /* Augmenter la hauteur de la fenêtre */
    }
    .modal-header .close {
      font-size: 2rem; /* Agrandir la taille de la croix */
      position: absolute;
      right: 10px;
      top: 10px;
      z-index: 1;
    }
    .nav-item {
      position: relative;
    }
    .badge-danger {
      position: absolute;
      top: -5px;
      right: -5px;
      background-color: red;
      color: white;
      border-radius: 50%;
      padding: 5px 10px;
      font-size: 12px;
    }
    /* Style général des boutons pour uniformiser la taille */
.custom-btn {
  width: 120px; /* Largeur uniforme */
  height: 40px; /* Hauteur uniforme */
  margin-right: 10px; /* Espace entre les boutons */
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 14px; /* Taille du texte */
  transition: transform 0.2s ease, box-shadow 0.2s ease; /* Animation au survol */
}

/* Animation au survol */
.custom-btn:hover {
  transform: scale(1.1); /* Agrandissement */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Ombre */
}

/* Suppression de la marge pour le dernier bouton */
.button-container form .custom-btn {
  margin-right: 0;
}

  </style>
</head>


<body class="g-sidenav-show bg-gray-100">
  <div class="min-height-300 bg-dark position-absolute w-100"></div>
  <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
        <img src="../assets/img/logo-ct-dark.png" width="100px" style="height:100px" alt="main_logo">
        <span class="ms-1 font-weight-bold">Educonnect</span>
      </a>
    </div>
    
   
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link " href="../pages/dashboard.html">
            
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
              
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
        <a class="nav-link active" href="../pages/tables.html">
  <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center position-relative">
    <!-- Icône de Réclamation -->
    <i class="ni ni-calendar-grid-58 text-dark text-sm opacity-10"></i>
   
  
  </div>
  <span class="nav-link-text ms-1">Réclamation</span>
</a>


        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/statistiques.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Statistique</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/virtual-reality.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Virtual Reality</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/rtl.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-world-2 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">RTL</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/profile.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Profile</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/sign-in.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Sign In</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/sign-up.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-collection text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Sign Up</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
      <div class="card card-plain shadow-none" id="sidenavCard">
        <img class="w-50 mx-auto" src="../assets/img/illustrations/icon-documentation.svg" alt="sidebar_illustration">
        <div class="card-body text-center p-3 w-100 pt-0">
          <div class="docs-info">
            <h6 class="mb-0">Need help?</h6>
            <p class="text-xs font-weight-bold mb-0">Please check our docs</p>
          </div>
        </div>
      </div>
      <a href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard" target="_blank" class="btn btn-dark btn-sm w-100 mb-3">Documentation</a>
      <a class="btn btn-primary btn-sm mb-0 w-100" href="https://www.creative-tim.com/product/argon-dashboard-pro?ref=sidebarfree" type="button">Upgrade to pro</a>
    </div>
      </ul>
    </div>
  </aside>
  
  <main class="main-content position-relative border-radius-lg">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Réclamations</li>
            
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Tables</h6>
          
          
        </nav>
      </div>
    </nav>
    
    <div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
     <!-- Inclure Font Awesome dans l'en-tête de ton fichier HTML -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<div class="d-flex align-items-center">
  <!-- Icône de notification avec badge au-dessus à droite -->
  <div class="icon icon-shape icon-lg border-radius-md text-center position-relative">
    <!-- Icône de notification -->
    <i class="fas fa-comment-dots text-dark text-lg opacity-10"></i>

    <!-- Badge rouge au-dessus de l'icône, aligné à droite -->
    <?php if ($nonReponduCount > 0): ?>
      <span class="badge badge-danger position-absolute top-0 end-0 translate-middle p-2" style="font-size: 12px; border-radius: 50%; background-color: #dc3545; color: white; box-shadow: 0 0 2px rgba(0, 0, 0, 0.2); margin-right: 15px; margin-top: 15px;">
        <?= $nonReponduCount ?>
      </span>
    <?php endif; ?>
  </div>

  <!-- Texte à côté de l'icône -->
  <span class="ms-2">Réclamations non répondues</span>
</div>

          
        </div>
        
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
              <div class="card-header pb-0">
  <!-- Champ de recherche -->
  <form action="tables.php" method="GET" class="d-flex">
    <input type="text" name="search" class="form-control" placeholder="Rechercher..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
    <button type="submit" class="btn btn-primary ms-2">Rechercher</button>
  </form>
</div>

             
                
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nom</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sujet</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Message</th>
                  <th class="text-secondary opacity-7"></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($reclamations as $reclamation): ?>
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm"><?= htmlspecialchars($reclamation['nom']); ?></h6>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold"><?= htmlspecialchars($reclamation['sujet']); ?></span>
                    </td>
                    <td class="align-middle text-center">
                      <p class="text-xs text-secondary mb-0"><?= htmlspecialchars($reclamation['message']); ?></p>
                    </td> 
                    <td class="align-middle text-center">
 <!-- Conteneur pour les boutons alignés horizontalement avec un espacement -->
 <div class="d-flex justify-content-center button-container">
  <!-- Bouton Répondre -->
  <button class="btn btn-success custom-btn" data-toggle="modal" data-target="#modalReponse<?= $reclamation['id']; ?>">
    Répondre
  </button>

  <!-- Bouton Voir Réponse -->
  <a href="voir_reponse.php?id=<?= $reclamation['id']; ?>" class="btn btn-info custom-btn">
    Voir Réponse
  </a>

  <!-- Bouton Voir Détails -->
  <button class="btn btn-warning custom-btn" data-toggle="modal" data-target="#modalDetails<?= $reclamation['id']; ?>">
    Voir Détails
  </button>

  <!-- Formulaire pour supprimer -->
  <form action="../delete_reclamation.php" method="POST" style="display:inline;">
    <input type="hidden" name="id" value="<?= $reclamation['id']; ?>">
    <button type="submit" class="btn btn-danger custom-btn" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réclamation ?');">
      Supprimer
    </button>
  </form>
</div>



<!-- Modal de Détails -->
<div class="modal fade" id="modalDetails<?= $reclamation['id']; ?>" tabindex="-1" aria-labelledby="modalDetailsLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailsLabel">Détails de la réclamation de <?= htmlspecialchars($reclamation['nom']); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>ID :</strong> <?= htmlspecialchars($reclamation['id']); ?></p>
        <p><strong>Email :</strong> <?= htmlspecialchars($reclamation['email']); ?></p>
        <p><strong>Téléphone :</strong> <?= htmlspecialchars($reclamation['telephone']); ?></p>
        <p><strong>Date :</strong> <?= htmlspecialchars($reclamation['date']); ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

                 
                  <!-- Modal de Réponse -->
                  <div class="modal fade" id="modalReponse<?= $reclamation['id']; ?>" tabindex="-1" aria-labelledby="modalReponseLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="modalReponseLabel">Répondre à <?= htmlspecialchars($reclamation['nom']); ?></h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <form action="../addReponse.php?id=<?= $reclamation['id']; ?>" method="POST">
                            <div class="form-group">
                              <label for="message">Votre réponse :</label>
                              <textarea name="message" id="message" class="form-control" rows="10" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-success mt-3">Envoyer la réponse</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


  </main>

  <!-- Scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
