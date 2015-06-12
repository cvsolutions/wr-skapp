<?php
return [
    'router' => [
        'routes' => [
            'home'   => [
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => 'Application\Controller\Index',
                        'action'     => 'index',
                    ],
                ],
            ],
            'login'  => [
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/login',
                    'defaults' => [
                        'controller' => 'Application\Controller\Login',
                        'action'     => 'index'
                    ]
                ]
            ],
            'logout' => [
                'type'    => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/logout',
                    'defaults' => [
                        'controller' => 'Application\Controller\Login',
                        'action'     => 'logout'
                    ]
                ]
            ],
            'user'   => [
                'type'          => 'Zend\Mvc\Router\Http\Literal',
                'options'       => [
                    'route'    => '/user',
                    'defaults' => [
                        'controller' => 'Application\Controller\UserArea',
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes'  => [
                    'registration' => [
                        'type'    => 'Zend\Mvc\Router\Http\Literal',
                        'options' => [
                            'route'    => '/registration',
                            'defaults' => [
                                'controller' => 'Application\Controller\User',
                                'action'     => 'index',
                            ],
                        ],
                    ],
                    'verify'       => [
                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                        'options' => [
                            'route'       => '/verify/:token/:id',
                            'constraints' => [
                                'token' => '[a-zA-Z0-9]*',
                                'id'    => '[0-9]*'
                            ],
                            'defaults'    => [
                                'controller' => 'Application\Controller\User',
                                'action'     => 'verify',
                            ]
                        ],
                    ],
                    'lost-pwd'     => [
                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                        'options' => [
                            'route'    => '/lost-password',
                            'defaults' => [
                                'controller' => 'Application\Controller\User',
                                'action'     => 'lost-pwd',
                            ]
                        ],
                    ],
                    'reset-pwd'    => [
                        'type'    => 'Zend\Mvc\Router\Http\Segment',
                        'options' => [
                            'route'       => '/reset-password/:token/:id',
                            'constraints' => [
                                'token' => '[a-zA-Z0-9]*',
                                'id'    => '[0-9]*'
                            ],
                            'defaults'    => [
                                'controller' => 'Application\Controller\User',
                                'action'     => 'reset-pwd',
                            ]
                        ],
                    ],
                ],
            ],
        ],
    ],
];