<?php
namespace Artists;

use Zend\ServiceManager\Factory\InvokableFactory;
use Artists\Controller;

return [
    'controllers' => [
        'factories' => [
            Controller\ArtistsController::class => InvokableFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'module-name-here' => [
                'type'    => 'Literal',
                'options' => [
                    // Change this to something specific to your module
                    'route'    => '/module-specific-root',
                    'defaults' => [
                        'controller'    => Controller\ArtistsController::class,
                        'action'        => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    // You can place additional routes that match under the
                    // route defined above here.
                ],
            ],
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            'ZendSkeletonModule' => __DIR__ . '/../view',
        ],
    ],
];
