<?php

class HotBeverage {
    private string $name;
    private float $price;
    private int $resistance;

    public function __construct(string $name, float $price, int $resistance) {
        $this->name = $name;
        $this->price = $price;
        $this->resistance = $resistance;
    }

    public function getName(): string {
        return $this->name;
    }

    public function getPrice(): float {
        return $this->price;
    }

    public function getResistance(): int {
        return $this->resistance;
    }
}

?>
