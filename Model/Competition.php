<?php
class Competition
{
    private ?int $id;
    private string $nom;
    private string $description;
    private int $duree;
    private string $contenu;

    // Constructor with type hints
    public function __construct(?int $id, string $nom, string $description, int $duree, string $contenu)
    {
        $this->id = $id;  
        $this->nom = $nom;
        $this->description = $description;
        $this->duree = $duree;
        $this->contenu = $contenu;
    }

    // Getters and setters
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDuree(): int
    {
        return $this->duree;
    }

    public function getContenu(): string
    {
        return $this->contenu;
    }
}
?>
