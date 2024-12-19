<?php
class Reclamation {
    // Properties
    public ?int $id; // Nullable integer for ID
    public string $nom; // Name of the user
    public string $email; // Email of the user
    public ?string $telephone; // Optional phone number
    public string $sujet; // Subject of the claim
    public ?string $message; // Optional message content
    public string $statut; // Status of the claim

    // Constructor
    public function __construct(
        string $nom, 
        string $email, 
        ?string $telephone, 
        string $sujet, 
        ?string $message = null, 
        string $statut = 'en cours', 
        ?int $id = null
    ) {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->sujet = $sujet;
        $this->message = $message;
        $this->statut = $statut;
    }

    // Getter and Setter for 'nom'
    public function getNom(): string {
        return $this->nom;
    }

    public function setNom(string $nom): void {
        $this->nom = $nom;
    }

    // Getter and Setter for 'email'
    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

    // Getter and Setter for 'telephone'
    public function getTelephone(): ?string {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): void {
        $this->telephone = $telephone;
    }

    // Getter and Setter for 'sujet'
    public function getSujet(): string {
        return $this->sujet;
    }

    public function setSujet(string $sujet): void {
        $this->sujet = $sujet;
    }

    // Getter and Setter for 'message'
    public function getMessage(): ?string {
        return $this->message;
    }

    public function setMessage(?string $message): void {
        $this->message = $message;
    }

    // Getter and Setter for 'statut'
    public function getStatut(): string {
        return $this->statut;
    }

    public function setStatut(string $statut): void {
        $this->statut = $statut;
    }

    // Getter and Setter for 'id'
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }
}
?>