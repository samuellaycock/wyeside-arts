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

    /* -----------------------------------------------------------
     * Calendar
     * ----------------------------------------------------------- */
     [
         'pattern' => '/calendar',
         'methods' => ['GET'],
         'paths' => [
             'controller' => '\Frontend\Controller\CalendarController',
             'action' => 'calendarAction'
         ]
     ],


	/* -----------------------------------------------------------
     * Events
     * ----------------------------------------------------------- */
	[
        'pattern' => '/events/:type',
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
     * Your Visit
     * ----------------------------------------------------------- */
	[
        'pattern' => '/visit/find',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\VisitController',
            'action' => 'findAction'
        ]
    ],
	[
        'pattern' => '/visit/food',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\VisitController',
            'action' => 'foodAction'
        ]
    ],
	[
        'pattern' => '/visit/times',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\VisitController',
            'action' => 'timeAction'
        ]
    ],
	[
        'pattern' => '/visit/booking',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\VisitController',
            'action' => 'bookAction'
        ]
    ],
	[
        'pattern' => '/visit/auditoriums',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\VisitController',
            'action' => 'auditoriumAction'
        ]
    ],
	[
        'pattern' => '/visit/access',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\VisitController',
            'action' => 'accessAction'
        ]
    ],

	/* -----------------------------------------------------------
     * Support Us
     * ----------------------------------------------------------- */
	[
        'pattern' => '/support/volunteers',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\SupportController',
            'action' => 'volunteerAction'
        ]
    ],
	[
        'pattern' => '/support/friends',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\SupportController',
            'action' => 'friendAction'
        ]
    ],
	[
        'pattern' => '/support/funders',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\SupportController',
            'action' => 'funderAction'
        ]
    ],

	/* -----------------------------------------------------------
     * About Us
     * ----------------------------------------------------------- */
	[
        'pattern' => '/about/who',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\AboutController',
            'action' => 'whoAction'
        ]
    ],
	[
        'pattern' => '/about/history',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\AboutController',
            'action' => 'historyAction'
        ]
    ],
    [
        'pattern' => '/about/history/:year',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\AboutController',
            'action' => 'historyActionYear'
        ]
    ],
	[
        'pattern' => '/about/team',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\AboutController',
            'action' => 'teamAction'
        ]
    ],
	[
        'pattern' => '/about/jobs',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\AboutController',
            'action' => 'jobsAction'
        ]
    ],
	[
        'pattern' => '/about/news',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\AboutController',
            'action' => 'newsAction'
        ]
    ],

	/* -----------------------------------------------------------
     * Hire
     * ----------------------------------------------------------- */
	[
        'pattern' => '/hire/technical',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\HireController',
            'action' => 'technicalAction'
        ]
    ],
	[
        'pattern' => '/hire/costume',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\HireController',
            'action' => 'costumeAction'
        ]
    ],
    /* -----------------------------------------------------------
     * Terms & Conditions
     * ----------------------------------------------------------- */
	[
        'pattern' => '/terms',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\OtherController',
            'action' => 'termsAction'
        ]
    ],

	/* -----------------------------------------------------------
     * Sitemap
     * ----------------------------------------------------------- */
	[
        'pattern' => '/sitemap',
        'methods' => ['GET'],
        'paths' => [
            'controller' => '\Frontend\Controller\OtherController',
            'action' => 'sitemapAction'
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
        'pattern' => '/system/events/:id/update-status/:status',
        'methods' => ['PATCH'],
        'paths' => [
            'controller' => '\Backend\Controller\EventsController',
            'action' => 'updateStatusAction'
        ]
    ],

    /* -----------------------------------------------------------
     * Events > Ticketsolve
     * ----------------------------------------------------------- */
    [
        'pattern' => '/system/events/import/ticketsolve',
        'methods' => ['GET', 'POST'],
        'paths' => [
            'controller' => '\Backend\Controller\TicketsolveController',
            'action' => 'importAction'
        ]
    ],
    [
        'pattern' => '/system/events/import/ticketsolve/create',
        'methods' => ['POST'],
        'paths' => [
            'controller' => '\Backend\Controller\TicketsolveController',
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
    [
        'pattern' => '/system/showings/:id',
        'methods' => ['PATCH'],
        'paths' => [
            'controller' => '\Backend\Controller\EventShowingsController',
            'action' => 'editShowingAction'
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
        'pattern' => '/system/users/:id',
        'methods' => ['DELETE'],
        'paths' => [
            'controller' => '\Backend\Controller\UsersController',
            'action' => 'deleteAction'
        ]
    ],
    [
        'pattern' => '/system/users/:id/edit',
        'methods' => ['GET', 'POST'],
        'paths' => [
            'controller' => '\Backend\Controller\UsersController',
            'action' => 'editAction'
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
