<?php
include_once('../../controller/ReclamationController.php');
include_once('../../model/Reclamation.php');
include_once('../../controller/ReponseController.php');
include_once('../../model/Reponse.php');

// Récupération de l'ID de la réclamation
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Récupérer la réclamation associée à l'ID
    $reclamationController = new ReclamationController();
    $reclamation = $reclamationController->getReclamationById($id);
} else {
    // Redirection si l'ID n'est pas passé
    header("Location: reclamations.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer le message de la réponse
    $message_reponse = $_POST['message'];

    // Créer un objet Reponse
    $reponse = new Reponse($id, $message_reponse);
    $reponseController = new ReponseController();
    $reponseController->addReponse($reponse);

    // Mettre à jour le statut de la réclamation à "Répondu"
    $reclamationController->updateStatutReclamation($id);

    // Redirection vers la page des réclamations après l'ajout de la réponse
    header("Location: ../BackOffice/pages/tables.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>Répondre à la réclamation</title>

  <!-- CSS Files -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.1.0" rel="stylesheet" />

  <style>
    body {
      background-color: #f0f2f5;
      font-family: 'Arial', sans-serif;
    }
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .card-header {
      background-color: #28a745;
      color: white;
      text-align: center;
      font-weight: bold;
      border-radius: 10px 10px 0 0;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-control {
      border-radius: 8px;
      font-size: 14px;
      padding: 15px;
    }
    .form-control:focus {
      border-color: #28a745;
      box-shadow: 0 0 10px rgba(40, 167, 69, 0.5);
    }
    .textarea-container {
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 10px;
      background-color: white;
      margin-bottom: 20px;
    }
    textarea.form-control {
      height: 250px;
      font-size: 16px;
      line-height: 1.6;
      border: none;
      resize: none;
    }
    .btn-success {
      background-color: #28a745;
      border-color: #28a745;
      width: 100%;
      padding: 12px;
      font-size: 16px;
      border-radius: 8px;
      font-weight: bold;
    }
    .btn-success:hover {
      background-color: #218838;
      border-color: #1e7e34;
    }
    .container {
      max-width: 800px;
      margin-top: 50px;
    }
    .card-body {
      padding: 30px;
    }
    .card-title {
      font-size: 24px;
      font-weight: bold;
      color: #333;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="card">
      <div class="card-header">
        <h6>Répondre à la réclamation de <?= htmlspecialchars($reclamation['nom']); ?></h6>
      </div>
      <div class="card-body">
        <form action="addReponse.php?id=<?= $id_reclamation ?>" method="POST">
          <div class="form-group">
            <label for="message_reponse" class="card-title">Votre Réponse</label>
            <div class="textarea-container">
              <textarea name="message_reponse" id="message_reponse" class="form-control" rows="6" required></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-success">Envoyer la réponse</button>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
