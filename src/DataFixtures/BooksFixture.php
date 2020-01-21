<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Books;

class BooksFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $book = new Books();

        $book->setTitle("Frankenstein");
        $book->setAuthor("Mary Shelley");
        $book->setPublished(new \DateTime('01-01-1818'));
        $book->setCover("/public/img/cover/Frankenstein - Mary Shelley.png");
        $book->setSummary("Frankenstein ou Le Prométhée moderne (Frankenstein or The Modern Prometheus) est un roman gothique et considéré a posteriori comme le précurseur de la science-fiction, publié en 1818 par la jeune britannique Mary Shelley , maîtresse et future épouse du poète Shelley.. Le roman est le récit d'une tentative d'exploration polaire par Robert Walton. La majeure partie de ce récit est constituée par l'histoire de la vie de Victor Frankenstein que Walton a recueilli sur la banquise. Ce récit tourne lui même autour de la narration à Frankenstein, par le monstre auquel il a donné vie, des tourments de celui-ci, qui justifient la haine qu'il lui porte.");
        $book->setCategory("Fiction");
        $book->setLength(76102);
        $book->setPath("/mnt/c/Users/jvanhuls/Downloads/books/Frankenstein - Mary Shelley.epub");

        $manager->persist($book);
        $manager->flush();
    }
}
