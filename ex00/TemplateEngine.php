<?php

class TemplateEngine {
    public function createFile($fileName, $templateName, $parameters) {
        if (!file_exists($templateName)) {
            throw new Exception("Template file not found: $templateName");
        }
        
        $template = file_get_contents($templateName);
        if ($template === false) {
            throw new Exception("Could not read template file: $templateName");
        }

        $content = $template;
        foreach ($parameters as $key => $value) {
            $content = str_replace('{' . $key . '}', $value, $content);
        }

        if (file_put_contents($fileName, $content) === false) {
            throw new Exception("Could not write output file: $fileName");
        }

        return true;
    }
}

?>
