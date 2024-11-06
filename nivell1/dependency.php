<?php

class Persona {
    private const TOTAL = 4;
    private int $count = 0;

    public function __construct(
        private array $objectes,
    ){}

    public function leave(): void{
        echo "Ho tinc tot per marxar?" . PHP_EOL . PHP_EOL;
        foreach($this->objectes as $object){
            if(!$object instanceof PortableObject){
                throw new InvalidArgumentException("❌ ERROR: Només puc portar objectes de tipus PortableObject; " . $object . " és de tipus " . gettype($object));
            }
            $this->count += $object->call();
        }

        echo PHP_EOL . ($this->count === self::TOTAL ? 'Sí.' : 'No.') . PHP_EOL;
    }
}

interface PortableObject {
    public function call(): bool;
}

class Cartera implements PortableObject {
    public function call(): bool{
        echo "Tinc la cartera." . PHP_EOL;
        return 1;
    }
}

class Claus implements PortableObject {
    public function call(): bool{
        echo "Tinc les claus de casa." . PHP_EOL;
        return 1;
    }
}

class Mobilitat implements PortableObject {
    public function __construct(
        private string $type
    ){}

    public function call(): bool{
        $result = match($this->type){
            'cotxe' => 'Tinc les claus del cotxe.',
            'moto' => 'Tinc les claus de la moto.',
            default => 'Tinc la t-mobilitat.'
        };

        echo $result . PHP_EOL;
        return 1;
    }
}

class Smartphone implements PortableObject {
    public function call(): bool{
        echo "Tinc l'smartphone." . PHP_EOL;
        return 1;
    }
}

// TESTS
echo PHP_EOL . "======== TEST 1 =========" . PHP_EOL . PHP_EOL;
$objectes = [
    new Cartera(),
    new Claus(),
    new Mobilitat('targeta'),
    new Smartphone()
];

$jo_ready = new Persona($objectes);
$jo_ready->leave();

echo PHP_EOL . "======== TEST 2 =========" . PHP_EOL . PHP_EOL;

$objectes = [
    new Cartera(),
    new Mobilitat('moto'),
    new Smartphone()
];

$jo_noready = new Persona($objectes);
$jo_noready->leave();

echo PHP_EOL . "======== TEST 3 =========" . PHP_EOL . PHP_EOL;

$objectes = [
    "cartera",
    new Mobilitat('moto')
];
$jo_test = new Persona($objectes);
try{
    $jo_test->leave();
}catch(Exception $err){
    echo $err->getMessage();
}
