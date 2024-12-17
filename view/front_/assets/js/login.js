// Variable pour stocker le rôle (student ou prof)
var userRole = "prof"; // Valeur par défaut

// Fonction pour définir le rôle en fonction de l'onglet cliqué
function setRole(role) {
    userRole = role;
    document.getElementById("role").value = role; // Mettre à jour l'input caché
}

// Fonction pour gérer le clic sur le bouton de connexion
function handleLogin() {
    // Validation basique (optionnelle)
    const email = document.getElementById("emailg").value.trim();
    const password = document.getElementById("password-field7").value.trim();

    if (email === "" || password === "") {
        alert("Please fill in both email and password.");
        return;
    }
    userRole =document.getElementById("role").value;
    // Redirection en fonction du rôle
    if (userRole === "student") {
        window.location.href = "home.html";
    } else if (userRole === "prof") {
        window.location.href = "../back/tables.php";
    } else {
        alert("Invalid role. Please select a valid tab.");
    }
}