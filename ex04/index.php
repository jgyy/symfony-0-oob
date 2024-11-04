<?php

require_once 'MyException.php';
require_once 'Elem.php';
require_once 'TemplateEngine.php';

try {
    $html = new Elem('html');
    $body = new Elem('body');

    $p = new Elem('p', 'Lorem ipsum', ['class' => 'text-muted']);
    $body->pushElement($p);
    $html->pushElement($body);

    $engine = new TemplateEngine($html);
    $engine->createFile('output.html');

    $invalid = new Elem('undefined');
} catch (MyException $e) {
    echo "Caught custom exception: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "Caught generic exception: " . $e->getMessage() . "\n";
}

try {
    $table = new Elem('table', null, ['class' => 'data-table']);
    $tr = new Elem('tr');
    $th1 = new Elem('th', 'Header 1');
    $th2 = new Elem('th', 'Header 2');
    $tr->pushElement($th1);
    $tr->pushElement($th2);
    $table->pushElement($tr);

    $tr2 = new Elem('tr');
    $td1 = new Elem('td', 'Data 1');
    $td2 = new Elem('td', 'Data 2');
    $tr2->pushElement($td1);
    $tr2->pushElement($td2);
    $table->pushElement($tr2);

    $engine = new TemplateEngine($table);
    $engine->createFile('table.html');

    echo "HTML file generated successfully!\n";
    echo "python3 -m http.server 8080\n";
} catch (MyException $e) {
    echo "Error creating table: " . $e->getMessage() . "\n";
}

?>
