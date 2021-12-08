<?php

namespace App\Entity;

use App\Repository\SecretRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SecretRepository::class)
 */
class Secret
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $lan;

    /**
     * @ORM\Column(type="float")
     */
    private $lat;

    /**
     * @ORM\Column(type="text")
     */
    private $photo;

    /**
     * @ORM\ManyToOne(targetEntity=Package::class, inversedBy="secrets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $package_id;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="secrets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product_id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="secrets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $created_by;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\ManyToOne(targetEntity=District::class, inversedBy="secrets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $district_id;

    /**
     * @ORM\Column(type="text")
     */
    private $detailed_photo;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLan(): ?float
    {
        return $this->lan;
    }

    public function setLan(float $lan): self
    {
        $this->lan = $lan;

        return $this;
    }

    public function getLat(): ?float
    {
        return $this->lat;
    }

    public function setLat(float $lat): self
    {
        $this->lat = $lat;

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

    public function getPackageId(): ?Package
    {
        return $this->package_id;
    }

    public function setPackageId(?Package $package_id): self
    {
        $this->package_id = $package_id;

        return $this;
    }

    public function getProductId(): ?Product
    {
        return $this->product_id;
    }

    public function setProductId(?Product $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->created_by;
    }

    public function setCreatedBy(?User $created_by): self
    {
        $this->created_by = $created_by;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getDistrictId(): ?District
    {
        return $this->district_id;
    }

    public function setDistrictId(?District $district_id): self
    {
        $this->district_id = $district_id;

        return $this;
    }

    public function getDetailedPhoto(): ?string
    {
        return $this->detailed_photo;
    }

    public function setDetailedPhoto(string $detailed_photo): self
    {
        $this->detailed_photo = $detailed_photo;

        return $this;
    }
}
