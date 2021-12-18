<?php

namespace App\Service;

use App\Entity\Order;

class PaymentService
{
    private EasyPayPaymentService $easypay;

    public function __construct(EasyPayPaymentService $easyPay)
    {
        $this->easypay = $easyPay;
    }

    public function createPaymentDetails(Order $order, string $paymentType): Order
    {
        if ($paymentType === "easypay") {
            return $this->easypay->assignWallet($order);
        }

        return $order;
    }
}