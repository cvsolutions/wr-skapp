<?php

return [
    'doctrine' => [
        'driver' => [
            'Album_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/WebReattivoCore/Entity'
                ]
            ],
            'orm_default' => [
                'drivers' => [
                    'WebReattivoCore\Entity' =>  'Album_driver'
                ],
            ],
        ],
    ],
];