// Gérer le rôle sélectionné (Student ou Prof)
function setRole(role) {
    document.getElementById('role').value = role;

    // Gérer les classes actives sur les boutons
    const studentTab = document.getElementById('student-tab');
    const profTab = document.getElementById('prof-tab');
    if (role === 'student') {
        studentTab.classList.add('active');
        profTab.classList.remove('active');
    } else if (role === 'prof') {
        profTab.classList.add('active');
        studentTab.classList.remove('active');
    }
}

// Gestion de la visibilité du mot de passe
function togglePasswordVisibility(fieldId) {
    const passwordField = document.getElementById(fieldId);
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
}