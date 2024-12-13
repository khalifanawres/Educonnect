<?php
// Inclure les fichiers nécessaires
include_once(__DIR__ . '/../../../Model/Reponse.php'); // Remonte de 3 niveaux pour accéder à Model/Reponse.php
include_once(__DIR__ . '/../../../Controller/ReponseController.php'); // Remonte de 3 niveaux pour accéder à Controller/ReponseController.php

// Si le formulaire de redirection est soumis, rediriger
if (isset($_POST['redirect'])) {
    header('Location: /Educonnect/view/BackOffice/pages/tables.php'); // Assurez-vous que le chemin vers tables.php est correct
    exit(); // Important de terminer le script après une redirection
}

// Initialisation des variables
$reclamation = null;
$id = null;

// Vérifier si l'ID de la réclamation est passé dans l'URL et est valide
if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = intval($_GET['id']); // Conversion en entier sécurisé

    // Récupérer les informations de la réclamation
    try {
        $sql = "SELECT * FROM reclamation WHERE id = :id";
        $db = Config::getConnexion();
        $query = $db->prepare($sql);
        $query->execute(['id' => $id]);
        $reclamation = $query->fetch(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        echo "Erreur lors de la récupération de la réclamation : " . $e->getMessage();
    }
} else {
    echo "<p>ID de la réclamation invalide ou non spécifié.</p>";
}

// Récupérer les réponses associées à cette réclamation si l'ID est valide
$reponses = [];
if ($reclamation) {
    $reponseController = new ReponseController();
    $reponses = $reponseController->getReponsesByReclamation($id);
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Voir Réponse - Réclamation
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

    <!-- Style pour la bordure blanche -->
    <style>
        .bordered-section {
            border: 2px solid white; /* Bordure blanche */
            padding: 20px; /* Espacement intérieur */
            background-color: #f8f9fa; /* Fond légèrement gris pour contraster avec la bordure blanche */
            border-radius: 10px; /* Coins arrondis pour un aspect plus doux */
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); /* Ombre légère pour un effet flottant */
        }
    </style>
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-dark position-absolute w-100"></div>
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html" target="_blank">
                <img src="../assets/img/logo-ct-dark.png" width="26px" height="26px" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">Creative Tim</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
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
                    <a class="nav-link " href="../pages/tables.php">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Tables</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../pages/billing.html">
                        <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-credit-card text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Billing</span>
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
    </aside>
    <main class="main-content position-relative border-radius-lg ">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-white active" aria-current="page">Réponse à la Réclamation</li>
                    </ol>
                    <h6 class="font-weight-bolder text-white mb-0">Réponse à la Réclamation</h6>
                </nav>
            </div>
        </nav>


<body class="g-sidenav-show bg-gray-100">
    <main class="main-content position-relative border-radius-lg">
        <div class="container mt-5 bordered-section">
            <?php if ($reclamation): ?>
                <h3>Réponses à la réclamation n°<?= htmlspecialchars($reclamation['id']); ?> - <?= htmlspecialchars($reclamation['nom']); ?></h3>
                <p><strong>Sujet :</strong> <?= htmlspecialchars($reclamation['sujet']); ?></p>
                <p><strong>Message :</strong> <?= nl2br(htmlspecialchars($reclamation['message'])); ?></p>

                <?php if (!empty($reponses)): ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID de la réponse</th>
                                <th>Date de Réponse</th>
                                <th>Message de Réponse</th>
                                <th>Envoyer par e-mail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($reponses as $reponse): ?>
                                <tr>
                                    <td><?= htmlspecialchars($reponse['id_reponse']); ?></td>
                                    <td><?= htmlspecialchars($reponse['date_reponse']); ?></td>
                                    <td><?= nl2br(htmlspecialchars($reponse['message_reponse'])); ?></td>
                                    <td> <form method="POST" action="sendReponseEmail.php">
                <input type="hidden" name="reponse_id" value="<?php echo $reponse['id_reponse']; ?>">
                <input type="hidden" name="reponse_message" value="<?php echo htmlspecialchars($reponse['message_reponse'], ENT_QUOTES); ?>">
                <input type="email" name="recipient_email" placeholder="Adresse e-mail du destinataire
" required>
                <button type="submit" class="btn btn-primary">Envoyer </button>
            </form></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Aucune réponse disponible pour cette réclamation.</p>
                <?php endif; ?>
            <?php else: ?>
                <p>Réclamation introuvable ou non spécifiée.</p>
            <?php endif; ?>

            <form action="" method="post">
                <button type="submit" name="redirect" class="btn btn-primary">Retour à la liste des réclamations</button>
            </form>
        </div>
    </main>
</body>

</html>
