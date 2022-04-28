<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\ORM\Mapping as ORM;
use symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Le champs ne peut être vide')]
    private $name;

    #[ORM\Column(type: 'integer')]
    #[Assert\NotBlank(message: 'Le champ ne peut être vide')]
    private $price;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message: 'Le champ ne peut être vide')]
    private $imagePath;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'produits')]
    #[ORM\JoinColumn(nullable: false)]
    #[Assert\NotBlank(message: 'Le champ ne peut être vide')]
    private $category;

    #[ORM\Column(type: 'text')]
    #[Assert\NotBlank(message: 'Le champ ne peut être vide')]
    private $description;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImagePath(): ?string
    {
        return $this->imagePath;
    }

    public function setImagePath(string $imagePath): self
    {
        $this->imagePath = $imagePath;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
