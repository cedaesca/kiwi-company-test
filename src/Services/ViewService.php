<?php

namespace App\Services;

use App\Interfaces\Services\ViewServiceInterface;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class ViewService implements ViewServiceInterface
{
    public function __construct(private string $viewsDirectory) {}

    public function render(string $path, array $data = []): Response
    {
        $viewPath = $this->viewsDirectory . $path;

        if (!file_exists($viewPath)) {
            throw new Exception("View file '{$viewPath}' not found.");
        }

        ob_start();
        extract($data);
        include $viewPath;
        $htmlContent = ob_get_clean();

        return new Response(content: $htmlContent, headers: ['Content-Type' => 'text/html']);
    }
}
