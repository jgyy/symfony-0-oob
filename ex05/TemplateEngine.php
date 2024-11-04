<?php

class TemplateEngine {
    private Elem $rootElement;

    public function __construct(Elem $rootElement) {
        $this->rootElement = $rootElement;
    }

    public function createFile(string $fileName): void {
        $html = $this->rootElement->getHTML();
        file_put_contents($fileName, $html);
    }
}

?>
