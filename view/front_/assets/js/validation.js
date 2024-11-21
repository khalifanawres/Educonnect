// Validation du nom complet
function validateFullName() {
    const fullName = document.getElementById("nom").value.trim();
    const feedback = document.getElementById("nom_feedback");

    if (fullName.length === 0) {
        setFeedback(feedback, "Full Name is required.", "error");
    } else if (fullName.length < 3) {
        setFeedback(feedback, "Full Name must have at least 3 characters.", "warning");
    } else {
        setFeedback(feedback, "Full Name is correct.", "success");
    }
}

// Validation de l'email
function validateEmail() {
    const email = document.getElementById("email").value.trim();
    const feedback = document.getElementById("email_feedback");
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (email.length === 0) {
        setFeedback(feedback, "Email is required.", "error");
    } else if (!emailPattern.test(email)) {
        setFeedback(feedback, "Invalid email format. Make sure it contains '@' and a domain.", "warning");
    } else {
        setFeedback(feedback, "Email is correct.", "success");
    }
}

// Validation du mot de passe
function validatePassword() {
    const password = document.getElementById("mot_de_passe").value;
    const feedback = document.getElementById("password_feedback");
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/;

    if (password.length === 0) {
        setFeedback(feedback, "Password is required.", "error");
    } else if (!passwordPattern.test(password)) {
        setFeedback(feedback, "Password must include at least 1 lowercase, 1 uppercase letter, and 1 number.", "warning");
    } else {
        setFeedback(feedback, "Password is strong.", "success");
    }
}

// Validation de la confirmation du mot de passe
function validateConfirmPassword() {
    const password = document.getElementById("mot_de_passe").value;
    const confirmPassword = document.getElementById("confirm_password").value;
    const feedback = document.getElementById("confirm_password_feedback");

    if (confirmPassword.length === 0) {
        setFeedback(feedback, "Please confirm your password.", "error");
    } else if (password !== confirmPassword) {
        setFeedback(feedback, "Passwords do not match.", "warning");
    } else {
        setFeedback(feedback, "Passwords match.", "success");
    }
}

// Fonction pour définir le message et la classe de feedback
function setFeedback(element, message, type) {
    element.textContent = message;
    element.className = `feedback ${type}`;
}

// Validation finale avant l'envoi du formulaire
function validateForm() {
    validateFullName();
    validateEmail();
    validatePassword();
    validateConfirmPassword();

    // Vérifiez si tous les champs sont corrects avant d'envoyer
    const feedbacks = document.querySelectorAll(".feedback");
    for (let feedback of feedbacks) {
        if (feedback.classList.contains("error") || feedback.classList.contains("warning")) {
            alert("Please correct the errors before submitting.");
            return false;
        }
    }

    return true;
}

