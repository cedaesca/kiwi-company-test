<?php

require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Controller\ContainerControllerResolver;
use App\Core\App;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;

$container = new ContainerBuilder();

$loader = new PhpFileLoader($container, new FileLocator(__DIR__));
$loader->load(__DIR__ . '/../config/services.php');

$container->compile();

$request = Request::createFromGlobals();
$routes = include __DIR__.'/../config/routes.php';

$context = new RequestContext();
$context->fromRequest($request);

$matcher = new UrlMatcher($routes, $context);

$controllerResolver = new ContainerControllerResolver($container);
$argumentResolver = new ArgumentResolver();

$app = new App($matcher, $controllerResolver, $argumentResolver);
$response = $app->handle($request);

$response->send();