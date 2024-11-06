<?php

/*
Imagina que hem d'implementar un mecanisme per notificar als mentors i mentores que ha entrat una nova tasca al Moodle. Fes un programa que implementi el patró Observer de tal manera que cada cop que es generi una nova entrega al Moodle, avisi als mentors/es d'aquesta entrega.
*/

interface Observer {
    public function update(string $message): void;
}

class Mentor implements Observer {
    public function __construct(
        private string $name
    ){}

    public function update(string $message): void{
        echo "{$this->name} ha rebut la notifiació: $message" . PHP_EOL;
    }
}

class Entrega {
    private array $observers = [];

    public function attach(Observer $observer): void{
        $this->observers[] = $observer;
    }

    public function dettach(Observer $observer): void{
        $this->observers = array_filter($this->observers, fn($obs) => $obs !== $observer);
    }

    public function notify(string $message): void{
        foreach($this->observers as $observer){
            $observer->update($message);
        }
    }
}

$mentors = [
    new Mentor("Rubén"),
    new Mentor("JuanCa"),
    
];

[$mentor1, $mentor2] = $mentors;

$entrega = new Entrega();

foreach($mentors as $mentor){
    $entrega->attach($mentor);
}

$entrega->notify("Nova entrega feta! 🎉");

$entrega->dettach($mentor2);
$entrega->notify("Una altra entrega.");
