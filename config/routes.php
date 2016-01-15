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

    /* -----------------------------------------------------------
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

    /* -----------------------------------------------------------
     * Events > Images
     * ----------------------------------------------------------- */
    [
        'pattern' => '/system/events/:id/images',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Backend\Controller\EventImagesController',
            'action' => 'getImagesAction'
        ]
    ],
    [
        'pattern' => '/system/images/:id',
        'methods' => ['DELETE'],
        'paths' => [
            'controller' => '\Backend\Controller\EventImagesController',
            'action' => 'deleteImageAction'
        ]
    ],
    [
        'pattern' => '/system/images/:id/set-main',
        'methods' => ['PATCH'],
        'paths' => [
            'controller' => '\Backend\Controller\EventImagesController',
            'action' => 'setImageMainAction'
        ]
    ],


    /* -----------------------------------------------------------
     * Events > Showings
     * ----------------------------------------------------------- */
    [
        'pattern' => '/system/events/:id/showings',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Backend\Controller\EventShowingsController',
            'action' => 'getShowingsAction'
        ]
    ],
    [
        'pattern' => '/system/events/:id/showings',
        'methods' => ['POST'],
        'paths' => [
            'controller' => '\Backend\Controller\EventShowingsController',
            'action' => 'createShowingsAction'
        ]
    ],
    [
        'pattern' => '/system/showings/:id',
        'methods' => ['DELETE'],
        'paths' => [
            'controller' => '\Backend\Controller\EventShowingsController',
            'action' => 'deleteShowingAction'
        ]
    ],
];