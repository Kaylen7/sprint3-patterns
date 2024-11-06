<?php

class Rentar{
    public function start(string $objecte){
        echo "Rentant " . $objecte . "..." . PHP_EOL;
    }
}
class Ensabonar{
    public function start(string $objecte){
        echo "Ensabonant " . $objecte . "..." . PHP_EOL;
    }
}
class Aclarir{
    public function start(string $objecte){
        echo "Aclarint " . $objecte . "..." . PHP_EOL;
    }
}
class Eixugar{
    public function start(string $objecte){
        echo "Eixugant " . $objecte . "..." . PHP_EOL;
    }
}

class Rentaplats {
    private Rentar $rentar;
    private Ensabonar $ensabonar;
    private Aclarir $aclarir;
    private Eixugar $eixugar;

    public function __construct(
        private array $objectes
    ){
        $this->rentar = new Rentar();
        $this->ensabonar = new Ensabonar();
        $this->aclarir = new Aclarir();
        $this->eixugar = new Eixugar();
    }

    public function activar(){
        foreach($this->objectes as $objecte){
            $this->rentar->start($objecte);
            $this->ensabonar->start($objecte);
            $this->aclarir->start($objecte);
            $this->eixugar->start($objecte);
            echo PHP_EOL;
        }
        echo "Procés acabat! 🎉 ";
    }
}

$rentaplats = new Rentaplats(["plats", "coberts", "gots"]);
$rentaplats->activar();