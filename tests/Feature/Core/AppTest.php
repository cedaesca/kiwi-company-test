<?php

namespace Tests\Feature\Core;

use App\Core\App;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolverInterface;
use Symfony\Component\HttpKernel\Controller\ControllerResolverInterface;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcherInterface;
use Symfony\Component\Routing\RequestContext;

class AppTest extends TestCase
{
    #[Test]
    public function NotFoundHandling(): void
    {
        $app = $this->getAppForException(new ResourceNotFoundException());

        $response = $app->handle(new Request());

        $this->assertEquals(404, $response->getStatusCode());
    }

    #[Test]
    public function handlesValidRoute(): void
    {
        $expectedResponse = new Response('Foo!');

        $controller = function () use ($expectedResponse) {
            return $expectedResponse;
        };

        $matcher = $this->createMock(UrlMatcherInterface::class);

        $matcher
            ->expects($this->once())
            ->method('match')
            ->willReturn([
                '_controller' => $controller,
            ]);

        $matcher
            ->expects($this->once())
            ->method('getContext')
            ->willReturn($this->createMock(RequestContext::class));

        $controllerResolver = $this->createMock(ControllerResolverInterface::class);

        $controllerResolver
            ->expects($this->once())
            ->method('getController')
            ->willReturn($controller);

        $argumentResolver = $this->createMock(ArgumentResolverInterface::class);

        $argumentResolver
            ->expects($this->once())
            ->method('getArguments')
            ->willReturn([]);

        $app = new App($matcher, $controllerResolver, $argumentResolver);

        $response = $app->handle(new Request());

        $this->assertEquals('Foo!', $response->getContent());
        $this->assertEquals(200, $response->getStatusCode());
    }

    private function getAppForException($exception): App
    {
        $matcher = $this->createMock(UrlMatcherInterface::class);

        $matcher
            ->expects($this->once())
            ->method('match')
            ->willThrowException($exception);

        $matcher
            ->expects($this->once())
            ->method('getContext')
            ->willReturn($this->createMock(RequestContext::class));

        $controllerResolver = $this->createMock(ControllerResolverInterface::class);
        $argumentResolver = $this->createMock(ArgumentResolverInterface::class);

        return new App($matcher, $controllerResolver, $argumentResolver);
    }
}
