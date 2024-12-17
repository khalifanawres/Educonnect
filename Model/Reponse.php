<?php
class Reponse {
   public $id_reponse; // Identifiant de la réponse (clé primaire)
   public $id;         // Clé étrangère vers la table `reclamation`
   public $message_reponse;    // Contenu de la réponse
   public $date_reponse;       // Date de la réponse

    // Constructeur
    public function __construct($id, $message_reponse, ?int $id_reponse = null, ?string $date_reponse = null) {
        $this->id_reponse = $id_reponse;
        $this->id = $id;
        $this->message_reponse = $message_reponse;
        $this->date_reponse = $date_reponse ?? date('Y-m-d H:i:s'); // Si la date n'est pas donnée, on prend la date et heure actuelles
    }

    // Getters
    public function getIdReponse(): ?int {
        return $this->id_reponse;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getMessageReponse(): string {
        return $this->message_reponse;
    }

    public function getDateReponse(): string {
        return $this->date_reponse;
    }

    // Setters
    public function setIdReponse(int $id_reponse): void {
        $this->id_reponse = $id_reponse;
    }

    public function setMessageReponse(string $message_reponse): void {
        $this->message_reponse = $message_reponse;
    }

    public function setDateReponse(string $date_reponse): void {
        $this->date_reponse = $date_reponse;
    }
}
?>

