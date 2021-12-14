<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Money\Currency;
use Money\Money;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product
{
    const CURRENCY_CODE='UAH';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Secret::class, mappedBy="product_id")
     */
    private $secrets;

    /**
     * @ORM\Column(type="text")
     */
    private $photo;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    public function __construct()
    {
        $this->name = '';
        $this->description = '';
        $this->price = 0;
        $this->secrets = new ArrayCollection();
    }

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Secret[]
     */
    public function getSecrets(): Collection
    {
        return $this->secrets;
    }

    public function addSecret(Secret $secret): self
    {
        if (!$this->secrets->contains($secret)) {
            $this->secrets[] = $secret;
            $secret->setProductId($this);
        }

        return $this;
    }

    public function removeSecret(Secret $secret): self
    {
        if ($this->secrets->removeElement($secret)) {
            // set the owning side to null (unless already changed)
            if ($secret->getProductId() === $this) {
                $secret->setProductId(null);
            }
        }

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPriceAmount(): int
    {
        return $this->price;

    }

    public function getPrice(): Money
    {
        return new Money($this->price, new Currency(self::CURRENCY_CODE));
    }

    public function setPrice(Money $price): self
    {
        $this->price = $price->getAmount();

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName();
    }
}
