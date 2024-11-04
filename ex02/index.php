<?php

require_once 'TemplateEngine.php';
require_once 'HotBeverage.php';
require_once 'Coffee.php';
require_once 'Tea.php';

$engine = new TemplateEngine();

$coffee = new Coffee();
$engine->createFile($coffee);

$tea = new Tea();
$engine->createFile($tea);

echo "HTML file generated successfully!\n";
echo "python3 -m http.server 8080\n";

?>
