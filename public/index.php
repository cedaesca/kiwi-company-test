<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\Controller\ContainerControllerResolver;

$container = new ContainerBuilder();
$loader = new YamlFileLoader($container, new FileLocator(__DIR__));
$loader->load(__DIR__ . '/../config/services.yaml');

$container->compile();

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/routes.php';

$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ContainerControllerResolver($container);
$argumentResolver = new ArgumentResolver();

try {
    $request->attributes->add($matcher->match($request->getPathInfo()));

    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);

    $response = call_user_func_array($controller, $arguments);
} catch (ResourceNotFoundException $exception) {
    $response = new Response('Página no encontrada', 404);
} catch (Exception $exception) {
    $response = new Response($exception->getMessage(), 500);
}

$response->send();