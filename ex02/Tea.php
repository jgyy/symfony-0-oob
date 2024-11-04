<?php

class Tea extends HotBeverage {
    private string $description;
    private string $comment;

    public function __construct() {
        parent::__construct('Tea', 2.00, 3);
        $this->description = 'A hot beverage made by steeping processed tea leaves';
        $this->comment = 'A calming drink for any time of day';
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function getComment(): string {
        return $this->comment;
    }
}

?>
