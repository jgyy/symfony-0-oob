<?php

class TemplateEngine {
    private $elem;

    public function __construct(Elem $elem) {
        $this->elem = $elem;
    }

    public function createFile($fileName) {
        if (!$fileName) {
            throw new Exception("Filename cannot be empty");
        }
        
        $html = $this->elem->getHTML();
        file_put_contents($fileName, $html);
    }
}

?>
