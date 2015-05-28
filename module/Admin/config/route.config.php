<?php
return [
    'router' => [
        'routes' => [
            'admin' => [
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => [
                    'route'    => '/admin',
                    'defaults' => [
                        'controller' => 'Admin\Controller\Index',
                        'action'     => 'index',
                    ],
                ],
            ]
        ],
    ],
];