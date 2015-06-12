<?php
return [
    'controllers' => [
        'factories' => [
            'Application\Controller\Index'    => 'Application\Factory\Controller\IndexFactory',
            'Application\Controller\User'     => 'Application\Factory\Controller\UserFactory',
            'Application\Controller\UserArea' => 'Application\Factory\Controller\UserAreaFactory'
        ]
    ],
];