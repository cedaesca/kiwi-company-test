<?php

namespace App\Controllers;

use App\Interfaces\Services\ViewServiceInterface;
use App\Services\FooService;
use Symfony\Component\HttpFoundation\Response;

class FooController
{
    public function __construct(
        private FooService $fooService,
        private ViewServiceInterface $viewService
    ) {}

    public function index()
    {
        return new Response($this->fooService->sayFoo());
    }

    public function show()
    {
        return $this->viewService->render('foo.php', ['title' => 'Foo view!']);
    }
}
