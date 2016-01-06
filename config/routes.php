<?php

return [

    [
        'methods' => ['get'],
        'pattern' => '/',
        'paths' => [
            'controller' => '\Frontend\Controller\IndexController',
            'action' => 'indexAction'
        ]
    ]

];