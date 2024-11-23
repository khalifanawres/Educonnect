<?php 
include_once('../../BackOffice/Competitions/list_competitions.php');
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Compétitions</title>
    <link rel="stylesheet" href="css/list_competitions.css">
</head>
<body>
    <div class="container">
        <h2>Liste des Compétitions</h2>
        <table class="competitions-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Durée</th>
                    <th>Contenu</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($competitions) {
                    foreach ($competitions as $competition) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($competition['nom']) . "</td>";
                        echo "<td>" . htmlspecialchars($competition['description']) . "</td>";
                        echo "<td>" . htmlspecialchars($competition['duree']) . " jours</td>";
                        echo "<td>" . htmlspecialchars($competition['contenu']) . "</td>";
                        echo "<td>
                                <a href='../../FrontOffice/Competitions/update_competition_form.php?id=" . $competition['id'] . "' class='edit-btn'>Modifier</a>
                                <a href='delete_competition_form.php?id=" . $competition['id'] . "' class='delete-btn' onclick='return confirm(\"Êtes-vous sûr de vouloir supprimer cette compétition ?\");'>Supprimer</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Aucune compétition trouvée.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <a href="add_competition_form.php" class="add-btn">Ajouter une nouvelle compétition</a>
    </div>
</body>
</html>
