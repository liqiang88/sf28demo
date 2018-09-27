<?php
$firewalls = [
    'dev' => [
        'pattern'   => '^/(_(profiler|wdt)|css|images|js)/',
        'security'  => false,
        'anonymous' => true,
    ],
    'main' => [
        'anonymous' => null
    ]
    //....

];

$container->loadFromExtension(
    'security',
    [
        'providers'    => [
            'in_memory' => ['memory'  => null]
        ],
        'firewalls'    => $firewalls,
    ]
);