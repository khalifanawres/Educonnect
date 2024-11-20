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

    public function getNom() {
        return $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getSujet() {
        return $this->sujet;
    }

    public function getMessage() {
        return $this->message;
    }

    // Setter for ID if needed (for update operations)
    public function setId(int $id) {
        $this->id = $id;
    }
}



?>

