<?php

class Coffee extends HotBeverage {
    private string $description;
    private string $comment;

    public function __construct() {
        parent::__construct('Coffee', 2.50, 2);
        $this->description = 'A hot beverage made from roasted coffee beans';
        $this->comment = 'Perfect for morning productivity!';
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getComment(): string {
        return $this->comment;
    }
}

?>
