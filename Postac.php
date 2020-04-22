<?php

abstract class Postac{
    
    public $nick;
    public $klasa;
    public $obrazenia;
    public $zycie;
    public $mana;
    public $obrona;
    public $unik;
    
    function __construct($nick,$klasa){
        $this->nick=$nick;
        $this->klasa=$klasa;
    }
    function getObrazenia(){
        return (int)$this->obrazenia;
    }
    function getZycie(){
        return (int)$this->zycie;
    }
    function getMana(){
        return (int)$this->mana;
    }
    function getObrona(){
        return (int)$this->obrona;
    }
    function getUnik(){
        return (int)$this->unik;
    }
    function __toString(){
        return "<h2>".$this->nick."</h2><br> Twoja klasa to ".$this->klasa."<br><img src='images/".$this->klasa.".png' width='300px' height='300px'></img><br> Zadajesz: ".$this->obrazenia." pkt. obrażeń<br>Życie: ".$this->zycie."<br>Mana: ".$this->mana."<br> Obrona: ".$this->obrona."<br>Szansa na unik: ".$this->unik;
    }
}
class Wojownik extends Postac{
    public $obrazenia = 50;
    public $zycie = 1200;
    public $mana=300;
    public $obrona=50;
    public $unik=30;
}
class Łucznik extends Postac{
    public $obrazenia = 75;
    public $zycie = 700;
    public $mana=500;
    public $obrona=40;
    public $unik=40;
}
class Mag extends Postac{
    public $obrazenia = 100;
    public $zycie = 500;
    public $mana=1200;
    public $obrona=30;
    public $unik=20;
}




?>