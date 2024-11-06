<?php

interface carCouponGenerator{
    public function addSeasonDiscount():void;
    public function addStockDiscount():void;
    public function getDiscount():float;
}

class bmwCouponGenerator implements carCouponGenerator{
    private $discount = 0;

    public function __construct(){
        $this->addSeasonDiscount();
        $this->addStockDiscount();
    }

    public function addSeasonDiscount(): void{
        $this->discount += 5;
    }

    public function addStockDiscount(): void{
        $this->discount += 7;
    }

    public function getDiscount():float{
        return $this->discount;
    }
}

class mercedesCouponGenerator implements carCouponGenerator{
    private $discount = 0;

    public function __construct(){
        $this->addSeasonDiscount();
        $this->addStockDiscount();
    }

    public function addSeasonDiscount(): void{
        $this->discount += 4;
    }

    public function addStockDiscount(): void{
        $this->discount += 10;
    }

    public function getDiscount():float{
        return $this->discount;
    }
}

class CouponContext {
    public function __construct(
        private carCouponGenerator $coupon
    ){}

    public function setCoupon(carCouponGenerator $coupon): void {
        $this->coupon = $coupon;
    }

    public function getCoupon():void {
        $discount = $this->coupon->getDiscount();
        echo "Get {$discount}% off the price of your new car." . PHP_EOL;
    }
}

$coupon = new CouponContext(new bmwCouponGenerator());
$coupon->getCoupon();

$coupon->setCoupon(new mercedesCouponGenerator());
$coupon->getCoupon();