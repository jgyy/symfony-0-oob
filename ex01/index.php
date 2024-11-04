<?php

require_once 'TemplateEngine.php';
require_once 'Text.php';

$text = new Text(["First paragraph of text", "Second paragraph with some more content"]);

$text->append("Third paragraph added using append method");

$engine = new TemplateEngine();

$engine->createFile("output.html", $text);

echo "HTML file generated successfully!\n";
echo "python3 -m http.server 8080\n";

?>
