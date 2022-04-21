<?php

namespace App\Entity;

use App\Entity\Purchase;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ContentListProductRepository;

#[ORM\Entity(repositoryClass: ContentListProductRepository::class)]
class ContentListProduct
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: ListProduct::class, inversedBy: 'contentListProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private $listProduct;

    #[ORM\ManyToOne(targetEntity: Produit::class)]
    #[ORM\JoinColumn(nullable: false)]
    private $product;

    /* #[ORM\ManyToOne(targetEntity: Purchase::class, inversedBy: 'contentListProducts')]
    #[ORM\JoinColumn(nullable: false)]
    private $purchase; */

    #[ORM\Column(type: 'integer')]
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getListProduct(): ?ListProduct
    {
        return $this->listProduct;
    }

    public function setListProduct(?ListProduct $listProduct): self
    {
        $this->listProduct = $listProduct;

        return $this;
    }

    public function getProduct(): ?Produit
    {
        return $this->product;
    }

    public function setProduct(?Produit $product): self
    {
        $this->product = $product;

        return $this;
    }

    /* public function getPurchase(): ?Purchase
    {
        return $this->purchase;
    }

    public function setPurchase(?Purchase $purchase): self
    {
        $this->purchase = $purchase;

        return $this;
    } */

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getTotal()
    {
        return $this->getProduct()->getPrice() * $this->getQuantity();
    }
}
