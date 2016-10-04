<?php
$dotenv = new Dotenv\Dotenv(__DIR__.'/../');
$dotenv->load();

$doctrineConfigPath = file_exists(__DIR__.'/../doctrine-config.php') ? __DIR__.'/../doctrine-config.php' : __DIR__.'/../doctrine-config.php.dist';
$doctrineConfig = require $doctrineConfigPath;


return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__.'/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__.'/../logs/app.log',
        ],

        'doctrine' => $doctrineConfig
    ],
];
