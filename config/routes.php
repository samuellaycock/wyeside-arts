<?php

return [

    /* -----------------------------------------------------------
    **************************************************************
    * !!! FRONTEND !!!
    **************************************************************
    * ----------------------------------------------------------- */

    [
        'pattern' => '/',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\HomeController',
            'action' => 'homeAction'
        ]
    ],
    [
        'pattern' => '/events',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\EventController',
            'action' => 'eventListAction'
        ]
    ],
    [
        'pattern' => '/events/:id/:name',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\EventController',
            'action' => 'eventDetailAction'
        ]
    ],


    /* -----------------------------------------------------------
    **************************************************************
    * !!! BACKEND !!!
    **************************************************************
    * ----------------------------------------------------------- */


    /* -----------------------------------------------------------
     * Login System
     * ----------------------------------------------------------- */
    [
        'pattern' => '/system/login',
        'methods' => ['GET', 'POST'],
        'paths' => [
            'controller' => '\Backend\Controller\LoginController',
            'action' => 'loginAction'
        ]
    ],
    [
        'pattern' => '/system/logout',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Backend\Controller\LoginController',
            'action' => 'logoutAction'
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
    [
        'pattern' => '/system/events/import/ticketsolve',
        'methods' => ['GET', 'POST'],
        'paths' => [
            'controller' => '\Backend\Controller\EventsController',
            'action' => 'importAction'
        ]
    ],
    [
        'pattern' => '/system/events/:id/update-status/:status',
        'methods' => ['PATCH'],
        'paths' => [
            'controller' => '\Backend\Controller\EventsController',
            'action' => 'updateStatusAction'
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


    /* -----------------------------------------------------------
     * Blog
     * ----------------------------------------------------------- */
    [
        'pattern' => '/system/blog',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Backend\Controller\BlogController',
            'action' => 'indexAction'
        ]
    ],


    /* -----------------------------------------------------------
    * Users
    * ----------------------------------------------------------- */
    [
        'pattern' => '/system/users',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Backend\Controller\UsersController',
            'action' => 'indexAction'
        ]
    ],
    [
        'pattern' => '/system/users/create',
        'methods' => ['GET', 'POST'],
        'paths' => [
            'controller' => '\Backend\Controller\UsersController',
            'action' => 'createAction'
        ]
    ],


];