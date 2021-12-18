<?php

namespace App\Service;

use App\Entity\Order;
use App\Repository\EasyPayWalletRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class EasyPayPaymentService
{
    private EntityManagerInterface $em;

    private HttpClientInterface $client;

    private EasyPayWalletRepository $walletRepository;

    public function __construct(EntityManagerInterface $em, HttpClientInterface $client, EasyPayWalletRepository $walletRepository)
    {
        $this->em = $em;
        $this->client = $client;
        $this->walletRepository = $walletRepository;
    }

    public function assignWallet(Order $order): Order
    {
        $wallet = $this->walletRepository->findAvailableWallet();
        $order->setEasyPayWallet($wallet);
        $wallet->setBlockedUntil($this->getTimeUntilWalletBlocked());

        $this->em->persist($order);
        $this->em->persist($wallet);

        $this->flush();

        return $order;
    }

    private function getTimeUntilWalletBlocked(): \DateTimeImmutable
    {
        return (new \DateTimeImmutable('+1 hour'));
    }
}
