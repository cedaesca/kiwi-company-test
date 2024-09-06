<?php

namespace App\Controllers;

use App\Services\FooService;
use Symfony\Component\HttpFoundation\Response;

class FooController
{
    public function __construct(private FooService $fooService) {}

    public function index()
    {
        return new Response($this->fooService->sayFoo());
    }
}