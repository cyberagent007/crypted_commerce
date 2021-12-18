<?php

namespace App\Service;

use App\Entity\Order;
use App\Entity\Package;
use App\Entity\Product;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Money\Currency;
use Money\Money;

class OrderService
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * fn
     */
    public function createOrder(Order $order, ?User $client)
    {
        $orderProductSecrete = $order->getProductSecret();
        $orderProduct = $orderProductSecrete->getProduct();

        $order->setClient($client);
        $order->setProduct($orderProduct);

        $order->setOrderAmount($this->calculateOrderAmount($orderProduct, $orderProductSecrete->getPackage()));

        try {
            $this->em->persist($order);
            $this->em->flush();
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function calculateOrderAmount(Product $product, Package $package): Money
    {
        // TODO: calculate order amount fn
        return new Money(10000, new Currency('UAH'));
    }
}
