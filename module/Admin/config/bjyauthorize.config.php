<?php
return [
    'bjyauthorize' => [
        'guards' => [
            'BjyAuthorize\Guard\Controller' => [
                ['controller' => 'Admin\Controller\Index', 'roles' => []],
            ]
        ]
    ]
];