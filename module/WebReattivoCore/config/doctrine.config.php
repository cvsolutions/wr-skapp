<?php
return [
    'doctrine' => [
        'driver'         => [
            'webreattivo_core_driver' => [
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => [
                    __DIR__ . '/../src/WebReattivoCore/Entity'
                ]
            ],
            'orm_default'             => [
                'drivers' => [
                    'WebReattivoCore\Entity' => 'webreattivo_core_driver'
                ]
            ]
        ],
        'authentication' => [
            'orm_default' => [
                'object_manager'      => 'Doctrine\ORM\EntityManager',
                'identity_class'      => 'WebReattivoCore\Entity\User',
                'identity_property'   => 'email',
                'credential_property' => 'password',
                'credential_callable' => function (\WebReattivoCore\Entity\User $user, $password) {
                    $Bcrypt = new \Zend\Crypt\Password\Bcrypt();
                    if (($user->getPassword() == $Bcrypt->verify($password, $user->getPassword()))
                        && ($user->getStatus() == \WebReattivoCore\Utility\UserStatus::ACTIVE)
                    ) {
                        return true;
                    }
                    return false;
                }
            ]
        ]
    ]
];