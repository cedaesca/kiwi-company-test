<?php

use App\Interfaces\Services\ViewServiceInterface;
use App\Services\ViewService;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return function (ContainerConfigurator $configurator) {
    $services = $configurator->services();

    $services->defaults()
        ->autowire(true)
        ->autoconfigure(true);

    $services->load('App\\', '../src/')
        ->exclude([
            '../src/Entities/',
            '../src/routes.php',
        ]);

    $services->load('App\\Controllers\\', '../src/Controllers/*')
        ->public()
        ->tag('controller.service_arguments');

    /**
     * Custom definitions
     */
    $services
        ->set(ViewServiceInterface::class, ViewService::class)
        ->args([dirname(__DIR__) . '/resources/views/']);
};
