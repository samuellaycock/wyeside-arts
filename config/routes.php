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
        'pattern' => '/system',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Backend\Controller\IndexController',
            'action' => 'indexAction'
        ]
    ],

    /** -----------------------------------------------------------
     * Events
     * ----------------------------------------------------------- */
    [
        'pattern' => '/system/events',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Backend\Controller\EventsController',
            'action' => 'indexAction'
        ]
    ],
    [
        'pattern' => '/system/events/:id',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Backend\Controller\EventsController',
            'action' => 'editAction'
        ]
    ],
    [
        'pattern' => '/system/events/create/:type',
        'methods' => ['GET', 'POST'],
        'paths' => [
            'controller' => '\Backend\Controller\EventsController',
            'action' => 'createAction'
        ]
    ],
];