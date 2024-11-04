<?php

class TemplateEngine {
    // This createFile is different from ex00
    public function createFile(string $fileName, Text $text): void {
        $htmlContent = "<!DOCTYPE html>\n<html>\n<head>\n";
        $htmlContent .= "<meta charset=\"UTF-8\">\n";
        $htmlContent .= "<title>Generated Content</title>\n";
        $htmlContent .= "</head>\n<body>\n";
        $htmlContent .= $text->readData();
        $htmlContent .= "\n</body>\n</html>";

        file_put_contents($fileName, $htmlContent);
    }
}

?>
