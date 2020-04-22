<?php

abstract class Potwor{
    
    protected $nazwa;
    public $zycie;
    public $obrona;
    public $obrazenia;

    function __construct($nazwa){
        $this->nazwa=$nazwa;
    }
    function getZycie(){
       return (int)$this->zycie=$zycie;
    }
    function getObrona(){
       return (int)$this->obrona=$obrona;
    }
    function getObrazenia(){
       return (int)$this->obrazenia=$obrazenia;
    }
    function __toString(){
        return $this->nazwa."<br>Życie: ".$this->zycie."<br>Obrazenia: ".$this->obrazenia."<br>Obrona: ".$this->obrona;
    }
}

class Szczur extends Potwor{
    public $zycie = 200;
    public $obrona = 5;
    public $obrazenia = 100;
    
}
class Zombie extends Potwor{
    public $zycie = 300;
    public $obrona = 15;
    public $obrazenia = 150;
    
}
class Wilkołak extends Potwor{
    public $zycie = 500;
    public $obrona = 25;
    public $obrazenia = 250;
    
}

class Ekwipunek{
    public $slot1;
    public $slot2;
    public $slot3;
    
    function __construct($slot1, $slot2, $slot3){
        $this->slot1=$slot1;
        $this->slot2=$slot2;
        $this->slot3=$slot3;
    }
    
    function __toString(){
        return 'Twoja broń: '.$this->slot1.'<br>Twoja zbroja to: '.$this->slot2.'<br> Twoje buty to '.$this->slot3;
    }
}


?>