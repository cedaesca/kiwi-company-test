<?php

namespace App;

use App\Controllers\AuthorsController;
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();

$routes->add(
    'authors.index',
    new Routing\Route(
        '/authors',
        [
            '_controller' => [AuthorsController::class, 'index']
        ],
        methods: ['GET']
    )
);

$routes->add(
    'authors.create',
    new Routing\Route(
        '/authors/create',
        [
            '_controller' => [AuthorsController::class, 'create']
        ],
        methods: ['GET'],
    )
);

$routes->add(
    'authors.store',
    new Routing\Route(
        '/authors',
        [
            '_controller' => [AuthorsController::class, 'store']
        ],
        methods: ['POST'],
    )
);

$routes->add(
    'authors.show',
    new Routing\Route(
        '/authors/{id}',
        [
            '_controller' => [AuthorsController::class, 'show']
        ],
        methods: ['GET'],
        requirements: ['id' => '\d+']
    )
);

return $routes;
