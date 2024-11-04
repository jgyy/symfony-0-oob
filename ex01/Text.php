<?php

class Text {
    private array $strings;

    public function __construct(array $strings = []) {
        $this->strings = $strings;
    }

    public function append(string $text): void {
        $this->strings[] = $text;
    }

    public function readData(): string {
        return implode("\n", array_map(function($str) {
            return "<p>" . htmlspecialchars($str) . "</p>";
        }, $this->strings));
    }
}

?>
