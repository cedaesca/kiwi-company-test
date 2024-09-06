<?php

namespace App\Controllers;

use App\Entities\Author;
use App\Interfaces\Repositories\AuthorRepositoryInterface;
use App\Interfaces\Services\ViewServiceInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class AuthorsController
{
    public function __construct(
        private ViewServiceInterface $viewsService,
        private AuthorRepositoryInterface $authorsRepository
    ) {}

    public function index()
    {
        $authors = $this->authorsRepository->findAll();

        return $this->viewsService->render('authors/index.php', ['authors' => $authors]);
    }

    public function show(Request $request)
    {
        $id = $request->attributes->get('id');

        $author = $this->authorsRepository->find(+$id);

        if (!$author) {
            throw new ResourceNotFoundException("Author with id '{$id}' not found.");
        }

        return $this->viewsService->render('authors/show.php', ['author' => $author]);
    }

    public function create()
    {
        return $this->viewsService->render('authors/create.php');
    }

    public function store(Request $request)
    {
        $name = $request->get('name');
        $lastName = $request->get('lastName');
        $birthDay = $request->get('birthDay');
        $biography = $request->get('biography');

        if (empty($name) || empty($lastName) || empty($birthDay)) {
            return new RedirectResponse('/authors/create?error=badinput');
        }

        try {
            $birthDay = new \DateTime($birthDay);
        } catch (\Exception $e) {
            return new RedirectResponse('/authors/create?error=invaliddate');
        }

        $author = new Author($name, $lastName, $birthDay, $biography);

        $this->authorsRepository->save($author);

        return new RedirectResponse("/authors/{$author->getId()}");
    }
}
