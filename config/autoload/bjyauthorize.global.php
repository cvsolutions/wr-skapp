<?php
return [
    'bjyauthorize' => [
        'default_role'      => 'Guest',
        'identity_provider' => 'WebReattivoCore\Provider\Identity',
        'role_providers'    => [
            'BjyAuthorize\Provider\Role\Config' => [
                \WebReattivoCore\Utility\Roles::GUEST => [],
                \WebReattivoCore\Utility\Roles::USER  => [],
                \WebReattivoCore\Utility\Roles::ADMIN => []
            ],
        ],
    ],
];