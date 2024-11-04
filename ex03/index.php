<?php

require_once 'Elem.php';
require_once 'TemplateEngine.php';

$html = new Elem('html');
$body = new Elem('body');

$p1 = new Elem('p', 'This is a paragraph');
$div = new Elem('div');
$h1 = new Elem('h1', 'Welcome to my page');
$p2 = new Elem('p', 'Another paragraph inside div');

$div->pushElement($h1);
$div->pushElement($p2);

$body->pushElement($p1);
$body->pushElement($div);
$html->pushElement($body);

$engine = new TemplateEngine($html);
$engine->createFile('output.html');

echo "HTML file has been generated successfully!\n";

echo "HTML file generated successfully!\n";
echo "python3 -m http.server 8080\n";

?>
