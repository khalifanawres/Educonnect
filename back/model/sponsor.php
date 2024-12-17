<?php 

class sponsor {

    private $idsponsor;
    private $idarticle;
    private $contenu_;

    private $likee;
    
    public $userAttributeCount = 5;

    // Getter and setter methods updated for new names
    function getidsponsor(){
        return $this->idsponsor;
    }

    function getidarticle(){
        return $this->idarticle;
    }

    function getcontenu_(){
        return $this->contenu_;
    }

    function getlike(){
        return $this->likee;
    }

    function setlike($like){
         $this->likee = $like;
    }

    // Constructor updated for the new class attributes
    function __construct($idarticle, $contenu_, $likee){
        $this->idarticle = $idarticle;
        $this->contenu_ = $contenu_;
        $this->likee = $likee;
    }

    function affichage(){  
        // LOCATION DEPENDS ON WHERE THE COLLEE AND CALLED FILE ARE, NO DEPENDENCY ON THE CLASS FILE'S POSITION
        //require_once "showUser.html";
    } 

}
?>
