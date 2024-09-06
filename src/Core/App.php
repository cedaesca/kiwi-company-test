<?php

namespace App\Core;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ContainerControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class App
{
    public function __construct(
        private UrlMatcher $matcher,
        private ContainerControllerResolver $controllerResolver,
        private ArgumentResolver $argumentResolver,
    ) {}

    public function handle(Request $request): Response
    {
        $this->matcher->getContext()->fromRequest($request);

        try {
            $request->attributes->add($this->matcher->match($request->getPathInfo()));

            $controller = $this->controllerResolver->getController($request);
            $arguments = $this->argumentResolver->getArguments($request, $controller);

            return call_user_func_array($controller, $arguments);
        } catch (ResourceNotFoundException $exception) {
            return new Response('Página no encontrada', 404);
        } catch (\Exception $exception) {
            return new Response('Ocurrió un error', 500);
        }
    }
}