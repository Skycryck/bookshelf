<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BooksRepository;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="default")
     */
    public function index(BooksRepository $repo)
    {
        $id = 0;
        $book = null;
        $books = $repo->findAll();
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'id' => $id,
            'book' => $book,
            'books' => $books,
        ]);
    }

    /**
     * @Route("/book/{id}",requirements={"id": "[1-9]\d*"}, name="book")
     */
    public function book($id=0, BooksRepository $repo) {
        $book = $repo->find($id);
        $books = $repo->findAll();
        return $this->render('default/index.html.twig',[
            'id' => $id,
            'book' => $book,
            'books' => $books,
        ]);
    }

    /**
     * @Route("/settings", name="settings")
     */
    public function settings()
    {
        return $this->render('default/settings.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
