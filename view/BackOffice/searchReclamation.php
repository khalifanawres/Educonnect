<?php
include_once('../../controller/ReclamationController.php');
// Vérification de la recherche
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Instanciation du contrôleur
$controller = new ReclamationController();

// Si une recherche est effectuée
if (!empty($search)) {
    // Rechercher les réclamations par nom ou sujet ou message
    $reclamations = $controller->getAllReclamations($search);
    echo json_encode($reclamations); // Retourne les résultats en JSON
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche des réclamations</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <!-- Champ de recherche -->
    <input type="text" id="searchInput" onkeyup="searchReclamations()" placeholder="Rechercher une réclamation...">
    
    <!-- Table des réclamations -->
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Sujet</th>
                <th>Message</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Les résultats de la recherche seront ajoutés ici -->
        </tbody>
    </table>

    <script>
    function searchReclamations() {
        var search = document.getElementById("searchInput").value;

        // Vérifie si le champ de recherche n'est pas vide
        if (search.length > 0) {
            // Utilise AJAX pour envoyer la recherche
            $.ajax({
                url: 'searchReclamation.php', // Ce fichier lui-même pour traiter la recherche
                method: 'GET',
                data: { search: search },
                success: function(response) {
                    // Parse la réponse JSON
                    var data = JSON.parse(response);

                    // Mettre à jour la table avec les résultats de la recherche
                    var tableBody = document.querySelector("table tbody");
                    tableBody.innerHTML = ''; // Efface le contenu actuel

                    // Ajouter les nouvelles lignes de réclamations
                    data.forEach(function(reclamation) {
                        var row = document.createElement("tr");

                        row.innerHTML = `
                            <td>${reclamation.nom}</td>
                            <td>${reclamation.sujet}</td>
                            <td>${reclamation.message}</td>
                            <td>
                                <button class="btn btn-success">Répondre</button>
                                <a href="voir_reponse.php?id=${reclamation.id}" class="btn btn-info">Voir Réponse</a>
                                <button class="btn btn-warning">Voir Détails</button>
                                <form action="../delete_reclamation.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="id" value="${reclamation.id}">
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réclamation ?');">Supprimer</button>
                                </form>
                            </td>
                        `;
                        tableBody.appendChild(row);
                    });
                }
            });
        } else {
            // Si la recherche est vide, recharger les réclamations
            location.reload();
        }
    }
    </script>
</body>
</html>
