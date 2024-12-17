<?php
class User {
    private ?int $id;
    private ?string $nom;
    private ?string $email;
    private ?string $mot_de_passe;
    private ?string $role;

    // Constructor
    public function __construct(?int $id, ?string $nom, ?string $email, ?string $mot_de_passe, ?string $role) {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->mot_de_passe = $mot_de_passe;
        $this->role = $role;
    }

    // Getters and Setters
    public function getId(): ?int {
        return $this->id;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function getMDP(): ?string {
        return $this->mot_de_passe;
    }

    public function getRole(): ?string {
        return $this->role;
    }
}
?>