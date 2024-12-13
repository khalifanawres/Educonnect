<?php
require_once('../../../controller/ReclamationController.php');
require_once('../../../model/Reclamation.php');
// Créer une instance du contrôleur
$reclamationController = new ReclamationController();

// Obtenir les statistiques des réclamations
$statistiquesReclamations = $reclamationController->getStatistiques();

// Obtenir les statistiques des réponses
$statistiquesReponses = $reclamationController->getStatistiquesReponses();

// Initialiser des variables pour les données du graphique
$statutsReclamation = [];
$countsReclamation = [];
$statutsReponse = [];
$countsReponse = [];

// Remplir les données des réclamations
foreach ($statistiquesReclamations as $statistique) {
    $statutsReclamation[] = $statistique['statut'];
    $countsReclamation[] = $statistique['count'];
}

// Remplir les données des réponses
foreach ($statistiquesReponses as $statistiqueReponse) {
    $statutsReponse[] = $statistiqueReponse['statut'];
    $countsReponse[] = $statistiqueReponse['count'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Statistiques des Réclamations et Réponses - Dashboard
  </title>
  <!-- Fonts and icons -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/argon-dashboard-pro/assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Chart.js -->
  
  <style>
     
    /* Graphique avec bordures arrondies et ombre douce */
    #statistiquesChart {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    /* Design général plus raffiné */
    .card {
        border-radius: 15px;
        border: 1px solid #e0e0e0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #fff;
        border-bottom: 2px solid #e0e0e0;
    }

    .card-body {
        padding: 30px;
    }

    h6 {
        font-size: 1.5rem;
        font-weight: 600;
        color: #333;
    }

    /* Légende élégante avec style */
    .legend {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .legend-item {
        display: flex;
        align-items: center;
    }

    .legend-item span {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        margin-right: 8px;
    }

    /* Typographie améliorée */
    body {
        font-family: 'Roboto', sans-serif;
    }
  </style>
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
          <a class="nav-link active" href="../pages/tables.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
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
</head>


  <main class="main-content position-relative border-radius-lg">
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Statistiques</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0">Graphique des Réclamations et Réponses</h6>
        </nav>
      </div>
    </nav>

    <!-- Section du graphique -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-lg-12 col-md-6">
          <div class="card">
            <div class="card-header pb-0">
              <h6 class="text-primary">Statistiques des Réclamations et des Réponses</h6>
            </div>
            <div class="card-body">
              <!-- Canvas pour le graphique -->
              <canvas id="statistiquesChart" width="400" height="200"></canvas>
            </div>
            <div class="card-footer">
              <!-- Légende élégante -->
              <div class="legend">
                <div class="legend-item">
                  <span style="background-color: #42a5f5;"></span>
                  <small>Réclamations </small>
                </div>
                <div class="legend-item">
                  <span style="background-color: #66bb6a;"></span>
                  <small>Réponses </small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Script pour générer le graphique -->
    <script>
        // Récupérer les données PHP dans JavaScript
        var statutsReclamation = <?php echo json_encode($statutsReclamation); ?>;
        var countsReclamation = <?php echo json_encode($countsReclamation); ?>;
        var statutsReponse = <?php echo json_encode($statutsReponse); ?>;
        var countsReponse = <?php echo json_encode($countsReponse); ?>;

        // Création du graphique
        var ctx = document.getElementById('statistiquesChart').getContext('2d');
        var statistiquesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: statutsReclamation,
                datasets: [
                    {
                        label: 'Réclamations ',
                        data: countsReclamation,
                        backgroundColor: '#42a5f5', 
                        borderColor: '#1e88e5',
                        borderWidth: 2
                    },
                    {
                        label: 'Réponses ',
                        data: countsReponse,
                        backgroundColor: '#66bb6a',
                        borderColor: '#43a047',
                        borderWidth: 2
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            min: 0
                        }
                    },
                    x: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top',
                        labels: {
                            font: {
                                size: 14,
                                weight: '500',
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.raw + ' éléments';
                            }
                        }
                    }
                }
            }
        });
    </script>
  </main>
</body>
</html>
