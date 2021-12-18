<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Money\Currency;
use Money\Money;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="customer_orders")
 */
class Order
{
    const STATUS_CREATED = 'created';
    const STATUS_PAID = 'paid';
    const STATUS_CLOSED = 'closed';
    const STATUS_PROBLEM = 'problem';
    const STATUS_REFUND = 'refund';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=true)
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $paymentType;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $walletAddress;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $createdAt;

    /**
     * @ORM\OneToOne(targetEntity=Secret::class, inversedBy="customerOrder", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $productSecret;

    /**
     * @ORM\Column(type="integer", length=10)
     */
    private $orderAmount;

    /**
     * @ORM\OneToOne(targetEntity=BitcoinWallet::class, mappedBy="customerOrder", cascade={"persist", "remove"})
     */
    private $bitcoinWallet;

    /**
     * @ORM\OneToOne(targetEntity=EasyPayWallet::class, mappedBy="customerOrder", cascade={"persist", "remove"})
     */
    private $easyPayWallet;

    public function __construct()
    {
        $this->paymentType = '';
        $this->status = self::STATUS_CREATED;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getPaymentType(): ?string
    {
        return $this->paymentType;
    }

    public function setPaymentType(string $paymentType): self
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    public function getWalletAddress(): ?string
    {
        return $this->walletAddress;
    }

    public function setWalletAddress(string $walletAddress): self
    {
        $this->walletAddress = $walletAddress;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getProductSecret(): ?Secret
    {
        return $this->productSecret;
    }

    public function setProductSecret(Secret $productSecret): self
    {
        $this->productSecret = $productSecret;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderAmount(): Money
    {
        return new Money($this->orderAmount, new Currency('UAH'));
    }

    /**
     * @param mixed $orderAmount
     * @return Order
     */
    public function setOrderAmount(Money $orderAmount): self
    {
        $this->orderAmount = $orderAmount->getAmount();

        return $this;
    }

    public function getBitcoinWallet(): ?BitcoinWallet
    {
        return $this->bitcoinWallet;
    }

    public function setBitcoinWallet(?BitcoinWallet $bitcoinWallet): self
    {
        // unset the owning side of the relation if necessary
        if ($bitcoinWallet === null && $this->bitcoinWallet !== null) {
            $this->bitcoinWallet->setCustomerOrder(null);
        }

        // set the owning side of the relation if necessary
        if ($bitcoinWallet !== null && $bitcoinWallet->getCustomerOrder() !== $this) {
            $bitcoinWallet->setCustomerOrder($this);
        }

        $this->bitcoinWallet = $bitcoinWallet;

        return $this;
    }

    public function getEasyPayWallet(): ?EasyPayWallet
    {
        return $this->easyPayWallet;
    }

    public function setEasyPayWallet(?EasyPayWallet $easyPayWallet): self
    {
        // unset the owning side of the relation if necessary
        if ($easyPayWallet === null && $this->easyPayWallet !== null) {
            $this->easyPayWallet->setCustomerOrder(null);
        }

        // set the owning side of the relation if necessary
        if ($easyPayWallet !== null && $easyPayWallet->getCustomerOrder() !== $this) {
            $easyPayWallet->setCustomerOrder($this);
        }

        $this->easyPayWallet = $easyPayWallet;

        return $this;
    }
}
