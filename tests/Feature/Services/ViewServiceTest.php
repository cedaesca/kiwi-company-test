<?php

namespace Tests\Feature\Services;

use App\Services\ViewService;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

class ViewServiceTest extends TestCase
{
    private string $viewsDirectory;
    private string $filePath;
    private ViewService $viewService;

    protected function setUp(): void
    {
        $this->viewsDirectory = __DIR__ . '/../../../resources/views/';
        $this->filePath = $this->viewsDirectory . 'sample.php';

        $this->viewService = new ViewService($this->viewsDirectory);

        file_put_contents($this->filePath, '<h1><?= $title ?? "Title" ?></h1><p><?= $content ?? "Content" ?></p>');
    }

    protected function tearDown(): void
    {
        unlink($this->filePath);
    }

    #[Test]
    public function renderReturnsResponseInstance(): void
    {
        $response = $this->viewService->render('sample.php');

        $this->assertInstanceOf(Response::class, $response);
    }

    #[Test]
    public function renderProvidesVariables(): void
    {
        $response = $this->viewService->render('sample.php', ['title' => 'Test Title', 'content' => 'Test Content']);

        $expectedContent = "<h1>Test Title</h1><p>Test Content</p>";

        $this->assertEquals($expectedContent, $response->getContent());
    }

    #[Test]
    public function renderResponseHeaders(): void
    {
        $response = $this->viewService->render('sample.php');

        $this->assertEquals('text/html', $response->headers->get('Content-Type'));
    }

    #[Test]
    public function renderThrowsExceptionForNonExistentView(): void
    {
        $this->expectException(\Exception::class);

        $this->viewService->render('nonexistent.php');
    }
}
