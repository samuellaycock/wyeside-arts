<?php

return [

    [
        'pattern' => '/',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\IndexController',
            'action' => 'indexAction'
        ]
    ],
    [
        'pattern' => '/test2',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\IndexController',
            'action' => 'indexAction'
        ]
    ],

];