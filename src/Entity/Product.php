<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $productName;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $productCode;

    /**
     * @ORM\ManyToOne(targetEntity=Category::class, inversedBy="products")
     * @ORM\JoinColumn(nullable=false)
     */
    private $productCategory;

    /**
     * @ORM\Column(type="boolean",options={"default" : true})
     */
    private $status;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $insertTime;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updateTime;

    /**
     * @ORM\Column(name="product_image",type="string",nullable=true)
     * @Assert\File(mimeTypes={ "image/jpeg", "image/JPEG", "image/jpg", "image/png" })
     */
    private $productImage;

    public function __toString() {
        return $this->productName;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getProductCode(): ?string
    {
        return $this->productCode;
    }

    public function setProductCode(string $productCode): self
    {
        $this->productCode = $productCode;

        return $this;
    }

    public function getProductCategory(): ?Category
    {
        return $this->productCategory;
    }

    public function setProductCategory(?Category $productCategory): self
    {
        $this->productCategory = $productCategory;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getInsertTime(): ?\DateTimeInterface
    {
        return $this->insertTime;
    }

    public function setInsertTime(?\DateTimeInterface $insertTime): self
    {
        $this->insertTime = $insertTime;

        return $this;
    }

    public function getUpdateTime(): ?\DateTimeInterface
    {
        return $this->updateTime;
    }

    public function setUpdateTime(?\DateTimeInterface $updateTime): self
    {
        $this->updateTime = $updateTime;

        return $this;
    }
    public function getProductImage(): ?string
    {
        return $this->productImage;
    }

    public function setProductImage(?string $productImage): self
    {
        $this->productImage = $productImage;

        return $this;
    }
}
