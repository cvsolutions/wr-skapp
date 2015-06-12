<?php
return [
    'modules'                 => [

        'DoctrineModule',
        'DoctrineORMModule',
        'BjyAuthorize',
        'AssetManager',
        'AcMailer',
        'Application',
        'WebReattivoCore',
        'Admin'
    ],
    'module_listener_options' => [
        'module_paths'      => [
            './module',
            './vendor',
        ],
        'config_glob_paths' => [
            'config/autoload/{,*.}{global,local}.php',
        ],
    ],
];
