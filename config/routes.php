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
        'methods' => ['GET', 'POST'],
        'paths' => [
            'controller' => '\Backend\Controller\EventsController',
            'action' => 'editAction'
        ]
    ],
    [
        'pattern' => '/system/events/:id/images',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Backend\Controller\EventsController',
            'action' => 'getImagesAction'
        ]
    ],
    [
        'pattern' => '/system/images/:id',
        'methods' => ['DELETE'],
        'paths' => [
            'controller' => '\Backend\Controller\EventsController',
            'action' => 'deleteImageAction'
        ]
    ],
    [
        'pattern' => '/system/images/:id/set-main',
        'methods' => ['PATCH'],
        'paths' => [
            'controller' => '\Backend\Controller\EventsController',
            'action' => 'setImageMainAction'
        ]
    ],
    [
        'pattern' => '/system/events/:id/banner-upload',
        'methods' => ['POST'],
        'paths' => [
            'controller' => '\Backend\Controller\EventUploadsController',
            'action' => 'bannerAction'
        ]
    ],
    [
        'pattern' => '/system/events/:id/image-upload',
        'methods' => ['POST'],
        'paths' => [
            'controller' => '\Backend\Controller\EventUploadsController',
            'action' => 'imageAction'
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