<?php

namespace App\Interfaces\Services;

use Symfony\Component\HttpFoundation\Response;

interface ViewServiceInterface
{
    public function render(string $path, array $data = []): Response;
}