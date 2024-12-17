<?php
class Reclamation {
    public ?int $id;
    public $nom;
    public $email;
    public $sujet;
    public $message;

    // Constructor with id as nullable
    public function __construct($nom, $email, $sujet, $message, ?int $id = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->sujet = $sujet;
        $this->message = $message;
    }

    // Getter methods
    public function getId() {
        return $this->id;
    }


    public $nom;
    public $email;
    public $telephone;  // Ajout du champ téléphone
    public $sujet;
    public $message;
    public $id;
    public $statut;  // Ajout de la propriété statut

    // Constructeur avec téléphone et statut
    public function __construct($nom, $email, $telephone, $sujet, $message = null, $statut = 'en cours', $id = null) {
        $this->nom = $nom;
        $this->email = $email;
        $this->telephone = $telephone;  // Initialisation du téléphone
        $this->sujet = $sujet;
        $this->message = $message;
        $this->statut = $statut;  // Initialisation du statut (par défaut à 'en cours')
        $this->id = $id;
    }

    // Getter et Setter pour 'nom'
    public function getNom() {
        return $this->nom;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    // Getter et Setter pour 'email'
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
    
    // Getter et Setter pour 'telephone'
    public function getTelephone() {
        return $this->telephone;
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    // Getter et Setter pour 'sujet'
    public function getSujet() {
        return $this->sujet;
    }

    public function setSujet($sujet) {
        $this->sujet = $sujet;
    }

    // Getter et Setter pour 'message'
    public function getMessage() {
        return $this->message;
    }

    // Setter for ID if needed (for update operations)
    public function setId(int $id) {
        $this->id = $id;
    }
}

public function setMessage($message) {
    $this->message = $message;
}

// Getter et Setter pour 'statut'
public function getStatut() {
    return $this->statut;
}

public function setStatut($statut) {
    $this->statut = $statut;
}

// Getter et Setter pour 'id'
public function getId() {
    return $this->id;
}

public function setId($id) {
    $this->id = $id;
}

?>



