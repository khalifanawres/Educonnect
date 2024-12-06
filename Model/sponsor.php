<?php

class sponsor {

    private $idsponsor;
    private $idarticle;
    private $contenu_;
    private $address;
    private $number;
    private $name;
    private $likee;
    
    public $userAttributeCount = 8;  // Update if necessary to reflect total attributes

    // Getter and setter methods for all attributes

    function getidsponsor() {
        return $this->idsponsor;
    }

    function getidarticle() {
        return $this->idarticle;
    }

    function getcontenu_() {
        return $this->contenu_;
    }

    function getaddress() {
        return $this->address;
    }

    function getnumber() {
        return $this->number;
    }

    function getname() {
        return $this->name;
    }

    function getlike() {
        return $this->likee;
    }

    function setlike($like) {
         $this->likee = $like;
    }

    // Constructor updated for the new class attributes
    function __construct($idarticle, $contenu_, $address, $number, $name, $likee = 0) {
        $this->idarticle = $idarticle;
        $this->contenu_ = $contenu_;
        $this->address = $address;
        $this->number = $number;
        $this->name = $name;
        $this->likee = $likee;
    }

    // Optional: Add a method to display the sponsor information
    function affichage() {  
        // Display the sponsor details, possibly as HTML or JSON
        // Example: echo "ID: {$this->idsponsor}, Name: {$this->name}, Address: {$this->address}";
    }

}
?>
