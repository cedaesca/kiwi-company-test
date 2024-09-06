<?php

namespace App;

use App\Controllers\FooController;
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add(
    'foo', 
    new Routing\Route(
        '/foo', 
        [
            '_controller' => [FooController::class, 'index']
        ],
        methods: ['GET']
    )
);

$routes->add(
    'foo_show', 
    new Routing\Route(
        '/foo/show', 
        [
            '_controller' => [FooController::class, 'show']
        ],
        methods: ['GET']
    )
);

return $routes;