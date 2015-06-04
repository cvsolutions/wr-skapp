<?php
return [
    'router' => [
        'routes' => [
            'home' => [
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ],
                ],
            ],
            'registration' => [
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/user/registration',
                    'defaults' => [
                        'controller' => 'Application\Controller\User',
                        'action'     => 'index',
                    ],
                ],
            ],
            'verify' => [
                'type'    => 'Zend\Mvc\Router\Http\Segment',
                'options' => [
                    'route'    => '/user/verify/:token/:id',
                    'defaults' => [
                        'controller' => 'Application\Controller\User',
                        'action'     => 'verify',
                    ]
                ],
            ],
        ],
    ],
];