<?php

namespace App\Controller;

use App\Entity\Authors;
use App\Repository\AuthorsRepository;
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
        $isLog = false;
        if ($this->isGranted('ROLE_USER') == true) {
            $isLog = true;
        }

        $id = 0;
        $book = null;
        $books = $repo->findAll();
        return $this->render('default/index.html.twig', [
            'controller_name' => 'DefaultController',
            'id' => $id,
            'book' => $book,
            'books' => $books,
            'isLog' => $isLog,
        ]);
    }

    /**
     * @Route("/book/{id}",requirements={"id": "[1-9]\d*"}, name="book")
     */
    public function book($id=0, BooksRepository $repo) {
        $isLog = false;
        if ($this->isGranted('ROLE_USER') == true) {
            $isLog = true;
        }

        $book = $repo->find($id);
        $author = $book->getAuthors();
        $books = $repo->findAll();
        return $this->render('default/index.html.twig',[
            'id' => $id,
            'book' => $book,
            'books' => $books,
            'author' => $author,
            'isLog' => $isLog,
        ]);
    }

    /**
     * @Route("/author/{id}",requirements={"id": "[1-9]\d*"}, name="author")
     */
    public function author($id=0, AuthorsRepository $aRep) {
        $isLog = false;
        if ($this->isGranted('ROLE_USER') == true) {
            $isLog = true;
        }

        if($id != 0) {
            $author = $aRep->find($id);
            $books = $author->getBooks();
        } else {
            $author = $aRep->findAll();
            $books = null;
        }
        return $this->render('default/author.html.twig',[
            'id' => $id,
            'author' => $author,
            'books' => $books,
            'isLog' => $isLog,
        ]);
    }

    /**
     * @Route("/settings", name="settings")
     */
    public function settings()
    {
        $isLog = false;
        if ($this->isGranted('ROLE_USER') == true) {
            $isLog = true;
        }

        return $this->render('default/settings.html.twig', [
            'controller_name' => 'DefaultController',
            'isLog' => $isLog,
        ]);
    }
}
