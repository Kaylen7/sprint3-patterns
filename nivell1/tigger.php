<?php

class Tigger {
    private static ?Tigger $tigger = null;
    private int $counter = 0;

    private function __construct() {
            echo "Building character..." . PHP_EOL;
    }

    public static function getInstance(): Tigger{
        if(self::$tigger === null){
            self::$tigger = new self();
        }
        return self::$tigger;
    }

    public function roar(): void{
            echo "Grrr!" . PHP_EOL;
            $this->counter++;
    }

    public function getCount(): void{
        echo "Tigger ha realitzat " . $this->counter . " rugits." . PHP_EOL;
    }

    private function __clone(){}
    public function __wakeup(){
        throw new Exception("No es pot deserialitzar un Singleton");
    }
}

// TEST
$tigger = Tigger::getInstance();
$tigger->roar();
$tigger->getCount();

$tigger2 = Tigger::getInstance();
$tigger2->roar();
$tigger->getCount();