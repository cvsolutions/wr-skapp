<?php
return [
    'bjyauthorize' => [
        'guards' => [
            'BjyAuthorize\Guard\Controller' => [
                ['controller' => 'Application\Controller\Index', 'roles' => []],
            ]
        ]
    ]
];