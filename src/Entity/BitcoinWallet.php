<?php

namespace App\Entity;

use App\Repository\BitcoinWalletRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BitcoinWalletRepository::class)
 */
class BitcoinWallet
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
    private $address;

    /**
     * @ORM\OneToOne(targetEntity=Order::class, inversedBy="bitcoinWallet", cascade={"persist", "remove"})
     */
    private $customerOrder;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $paymentStatus;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private $blockedUntil;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCustomerOrder(): ?Order
    {
        return $this->customerOrder;
    }

    public function setCustomerOrder(?Order $customerOrder): self
    {
        $this->customerOrder = $customerOrder;

        return $this;
    }

    public function getPaymentStatus(): ?string
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus(string $paymentStatus): self
    {
        $this->paymentStatus = $paymentStatus;

        return $this;
    }

    public function getBlockedUntil(): ?\DateTimeImmutable
    {
        return $this->blockedUntil;
    }

    public function setBlockedUntil(?\DateTimeImmutable $blockedUntil): self
    {
        $this->blockedUntil = $blockedUntil;

        return $this;
    }
}
