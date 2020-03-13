<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BooksRepository")
 */
class Books
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="date")
     */
    private $published;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cover;

    /**
     * @ORM\Column(type="text")
     */
    private $summary;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @ORM\Column(type="bigint")
     */
    private $length;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Authors", inversedBy="books")
     */
    private $authors;

    /**
     * Books constructor.
     * @param $title
     * @param $published
     * @param $cover
     * @param $summary
     * @param $category
     * @param $length
     * @param $path
     * @param $author
     */
    public function __construct($title, $author, $published, $cover, $summary, $category, $length, $path)
    {
        $this->title = $title;
        $this->published = $published;
        $this->cover = $cover;
        $this->summary = $summary;
        $this->category = $category;
        $this->length = $length;
        $this->path = $path;
        $this->authors = new ArrayCollection();
        $this->addAuthor($author);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getPublished(): ?\DateTimeInterface
    {
        return $this->published;
    }

    public function setPublished(\DateTimeInterface $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getLength(): ?string
    {
        return $this->length;
    }

    public function setLength(string $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @return Collection|Authors[]
     */
    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function toStringAuthors(): string {
        $result = "";
        if($this->authors != null) {
            for($i = 0; $i < count($this->authors); ++$i) {
                $result = $result.$this->authors[$i]->getName();
                if(($i + 1) < count($this->authors))
                    $result = $result.", ";
            }
        }
        return $result;
    }

    public function addAuthor(Authors $author): self
    {
        if (!$this->authors->contains($author)) {
            $this->authors[] = $author;
        }

        return $this;
    }

    public function removeAuthor(Authors $author): self
    {
        if ($this->authors->contains($author)) {
            $this->authors->removeElement($author);
        }

        return $this;
    }
}
