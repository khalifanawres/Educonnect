<?php
class User {
    private $id;
    private $nom;
    private $email;
    private $mot_de_passe;
    private $role;
    private $dob;
    private $tel;
    private $photo;
    public $verification_token;
    public $verified;

    public function __construct($id, $nom, $email, $mot_de_passe, $role, $dob = null, $tel = null, $photo = null , $verification_token = null, $verified = false) {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->mot_de_passe = $mot_de_passe;
        $this->role = $role;
        $this->dob = $dob;
        $this->tel = $tel;
        $this->photo = $photo;
        $this->verification_token = $verification_token;
        $this->verified = $verified;
    }

    // Getters et Setters pour chaque propriété
    public function getDob() {
        return $this->dob;
    }

    public function setDob($dob) {
        $this->dob = $dob;
    }

    public function getTel() {
        return $this->tel;
    }

    public function setTel($tel) {
        $this->tel = $tel;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
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