<?php
return [
    'service_manager' => [
        'abstract_factories' => [
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ],
        'aliases'            => [
            'translator' => 'MvcTranslator',
        ],
        'factories'          => [
            'userService'       => 'Application\Factory\Service\UserFactory',
            'registrationForm'  => 'Application\Factory\Form\RegistrationFactory',
            'LoginForm'         => 'Application\Factory\Form\LoginFactory',
            'lostPasswordForm'  => 'Application\Factory\Form\LostPasswordFactory',
            'resetPasswordForm' => 'Application\Factory\Form\ResetPasswordFactory'
        ]
    ],
    'translator'      => [
        'locale'                    => 'en_US',
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ],
        ],
    ],
    'asset_manager'   => [
        'resolver_configs' => [
            'paths' => [
                __DIR__ . '/../public',
            ],
        ],
    ],
    'view_manager'    => [
        'doctype'             => 'HTML5',
        'not_found_template'  => 'error/404',
        'exception_template'  => 'error/index',
        'template_map'        => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],

    ],
    // Placeholder for console routes
    'console'         => [
        'router' => [
            'routes' => [
            ],
        ],
    ],
];
