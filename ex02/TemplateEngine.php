<?php

class TemplateEngine {
    public function createFile(HotBeverage $beverage) {
        $template = file_get_contents('template.html');
        $reflection = new ReflectionClass($beverage);
        $fileName = strtolower($reflection->getShortName()) . '.html';

        $properties = $reflection->getProperties();
        $replacements = [];

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $name = $property->getName();
            $getterMethod = 'get' . ucfirst($name);
            if (method_exists($beverage, $getterMethod)) {
                $value = $beverage->$getterMethod();
                $replacements['{' . $name . '}'] = $value;
            }
        }

        $content = strtr($template, $replacements);
        file_put_contents($fileName, $content);
    }
}

?>
