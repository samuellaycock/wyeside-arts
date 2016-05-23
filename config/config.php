<?php

return [

    'mode' => APP_ENV,
    'templates.path' => APP_DIR . '/views',
    'view' => new \Slim\Views\Twig,

    'db.user' => 'wyeside',
    'db.host' => '127.0.0.1',
    'db.password' => 'lemons',
    'db.name' => 'wyeside-db'

];
