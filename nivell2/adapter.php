<?php

class Duck {

    public function quack() {
           echo "Quack \n";
    }

    public function fly() {
           echo "I'm flying \n";
    }
}

class Turkey {

    public function gobble() {
           echo "Gobble gobble \n";
    }

    public function fly() {
    echo "I'm flying a short distance \n";
    }
}

class TurkeyAdapter extends Duck{

    public function __construct(
        private Turkey $turkey
    ){}

    public function quack(){
        $this->turkey->gobble();
    }

    public function fly(){
        for($i = 0; $i < 5; $i++){
            $this->turkey->fly();
        }
    }
}


//TEST

function duck_interaction($duck) {
    $duck->quack();
    $duck->fly();
}

$duck = new Duck;
$turkey = new Turkey;
$turkey_adapter = new TurkeyAdapter($turkey);
echo "The Turkey says...\n";
$turkey->gobble();
$turkey->fly();
echo "The Duck says...\n";
duck_interaction($duck);
echo "The TurkeyAdapter says...\n";
duck_interaction($turkey_adapter);

//Expected output
/*
The Turkey says...
Gobble gobble
I'm flying a short distance
The Duck says...
Quack
I'm flying
The TurkeyAdapter says...
Gobble gobble
I'm flying a short distance
I'm flying a short distance
I'm flying a short distance
I'm flying a short distance
I'm flying a short distance
*/
