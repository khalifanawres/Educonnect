<?php 

class forum {

   private $categorie;
   private $titre;
   private $message;
   private $image;
   private $date;
   private $rate;

    public $userAttributeCount = 7;

    function getcategorie(){
        return $this->categorie;
    }

    function gettitre(){
        return $this->titre;
    }

    // Corrected method name here
    function getmessage(){
        return $this->message;
    }

    function getimage(){
        return $this->image;
    }

    function getdate(){
        return $this->date;
    }

    function getrate(){
        return $this->rate;
    }

    function setrate(int $rate){
        $this->rate = $rate;
    }

    // Constructor with default value for rate (0)
    function __construct($categorie, $titre, $message, $image, $date, $rate = 0) {
        $this->categorie = $categorie;
        $this->titre = $titre;
        $this->message = $message;
        $this->image = $image;
        $this->date = $date;
        $this->rate = $rate;
    }

    function affichage(){  
        // Display function logic (if needed)
    }
}
?>
