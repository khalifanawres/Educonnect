<?php
class Chapitre {
    public ?int $id;
    public ?int $idCours;
    public $nom;
    public $contenu;

    public function __construct($nom,$descript,$descript,$contenu,?int $id=null)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->descript = $descript;
        $this->contenu = $contenu;
    }

    public function getNom()
    {
        return $this->nom;
    }
    
    
    public function getContenu()
    {
        return $this->contenu;
    }

}
?>