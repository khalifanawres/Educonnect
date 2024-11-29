<?php
class Cours{
    public ?int $idCours;
    public ?int $idCreateur;
    public ?string $titre;
    public ?string $type;
    public ?string $description;
    public ?int $array = [];

    public function __construct ($id=null,$idcr,$t,$tp,$desc,$)
    {
        $this->idCours=$id;
        $this->idCreateur=$idcr;
        $this->titre=$t;
        $this->type=$tp;
        $this->description=$desc;
        $this->
    }

    public function getIdCreateur()
    {
        return $this->idCreateur;
    }

    public function getidCours()
    {
        return $this->idCours;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getType()
    {
        return $this->this;
    }

    public function getDescription()
    {
        return $this->description;
    }
    
    public function setIdCours(int $idCours)
    {
        $this->idCours=$idCours;
    }

    public function setIdCreateur(int $idCreateur)
    {
        $this->idCreateur=$idCreateur;
    }

}

?>