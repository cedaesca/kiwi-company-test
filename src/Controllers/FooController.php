<?php

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;

class FooController
{
    public function index()
    {
        return new Response('Foo!');
    }
}