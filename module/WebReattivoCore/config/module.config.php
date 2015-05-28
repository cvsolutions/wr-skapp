<?php
return [
    'service_manager' => [
        'factories' => [
            'WebReattivoCore\Service\UserService' => 'WebReattivoCore\Factory\Service\UserFactory',
            'WebReattivoCore\Provider\Identity'   => 'WebReattivoCore\Factory\Provider\IdentityFactory'
        ]
    ]

];