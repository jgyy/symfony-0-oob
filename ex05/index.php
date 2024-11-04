<?php

require_once 'MyException.php';
require_once 'Elem.php';
require_once 'TemplateEngine.php';

try {
    $html = new Elem('html');

    $head = new Elem('head');
    $head->pushElement(new Elem('title', 'Valid HTML Page'));
    $head->pushElement(new Elem('meta', null, ['charset' => 'UTF-8']));
    $html->pushElement($head);

    $body = new Elem('body');

    $p = new Elem('p', 'This is a paragraph with just text');
    $body->pushElement($p);

    $table = new Elem('table');
    $tr = new Elem('tr');
    $tr->pushElement(new Elem('th', 'Header 1'));
    $tr->pushElement(new Elem('th', 'Header 2'));
    $table->pushElement($tr);
    $body->pushElement($table);

    $ul = new Elem('ul');
    $ul->pushElement(new Elem('li', 'List item 1'));
    $ul->pushElement(new Elem('li', 'List item 2'));
    $body->pushElement($ul);
    
    $html->pushElement($body);

    if ($html->validPage()) {
        echo "HTML structure is valid\n";

        $engine = new TemplateEngine($html);
        $engine->createFile('output.html');
        echo "File has been created successfully\n";
    } else {
        echo "HTML structure is invalid\n";
    }

    $invalidHtml = new Elem('html');
    $invalidBody = new Elem('body');
    $invalidHtml->pushElement($invalidBody);
    
    if (!$invalidHtml->validPage()) {
        echo "Invalid HTML structure correctly detected\n";
    }

    echo "HTML file generated successfully!\n";
    echo "python3 -m http.server 8080\n";
} catch (MyException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
