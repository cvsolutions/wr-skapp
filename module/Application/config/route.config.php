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
                    'constraints' => [
                        'token' => '[a-zA-Z0-9]*',
                        'id'    => '[0-9]*'
                    ],
                    'defaults' => [
                        'controller' => 'Application\Controller\User',
                        'action'     => 'verify',
                    ]
                ],
            ],
        ],
    ],
];