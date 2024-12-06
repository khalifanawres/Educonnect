<?php 

class forum{

   private $categorie;
   private $titre;
   private $message;
   private $image;
   private $date;
   private $rate;

    public $userAttributeCount=7;

    function getcategorie(){
        return $this->categorie;
    }
    function gettitre(){
        return $this->titre;
    }
    function getmessgae(){
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

    
    function __construct($categorie,$titre,$message,$image,$date,$rate){
        $this->categorie = $categorie;
        $this->titre = $titre;
        $this->image = $image;
        $this->message = $message;
        $this->date = $date;
        $this->rate=$rate;
    }
    


    function affichage(){  
    } 
}
?>


