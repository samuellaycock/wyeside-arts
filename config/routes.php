<?php

return [

    [
        'methods' => ['GET'],
        'pattern' => '/',
        'paths' => [
            'controller' => '\Frontend\Controller\IndexController',
            'action' => 'indexAction'
        ]
    ]

];