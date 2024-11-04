<?php

require_once 'TemplateEngine.php';

$parameters = [
    'nom' => 'The Hitchhiker\'s Guide to the Galaxy',
    'auteur' => 'Douglas Adams',
    'description' => 'The most remarkable, certainly the most successful book ever to come out of the great publishing corporations of Ursa Minor',
    'prix' => '42'
];

try {
    $engine = new TemplateEngine();

    $engine->createFile(
        'output.html',
        'book_description.html',
        $parameters
    );
    
    echo "HTML file generated successfully!\n";
    echo "python3 -m http.server 8080\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

?>
