<?php

class TemplateEngine {
    public function createFile(HotBeverage $beverage) {
        $template = file_get_contents('template.html');
        $reflection = new ReflectionClass($beverage);
        $fileName = strtolower($reflection->getShortName()) . '.html';

        $replacements = [
            '{nom}' => $beverage->getName(),
            '{price}' => $beverage->getPrice(),
            '{resistance}' => $beverage->getResistance(),
            '{description}' => $beverage->getDescription(),
            '{comment}' => $beverage->getComment()
        ];

        $content = strtr($template, $replacements);
        file_put_contents($fileName, $content);
    }
}

?>
