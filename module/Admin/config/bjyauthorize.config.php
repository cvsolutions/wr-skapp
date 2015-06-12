<?php
return [
    'bjyauthorize' => [
        'guards' => [
            'BjyAuthorize\Guard\Controller' => [
                ['controller' => 'Admin\Controller\Index', 'roles' => [
                    \WebReattivoCore\Utility\Roles::ADMIN,
                    \WebReattivoCore\Utility\Roles::USER
                ]],
            ]
        ]
    ]
];