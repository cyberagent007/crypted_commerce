<?php

namespace App\Controller;

use App\Entity\Order;
use App\Service\PaymentService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    private PaymentService $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * @Route("/order/{id}", name="order_payment_method", methods={"GET", "POST"})
     * @ParamConverter("id", class="App\Entity\Order")
     *
     * @param Request $request
     * @param Order $order
     *
     * @return Response
     */
    public function paymentMethod(Request $request, Order $order): Response
    {
        $paymentTypeForm = $this->createFormBuilder($order)
            ->add('paymentType', ChoiceType::class, [
                'choices' => ['easypay', 'btc', 'globalmoney'],
            ])
            ->add('select', SubmitType::class, ['label' => 'Select payment type'])
            ->getForm();

        $paymentTypeForm->handleRequest($request);


        if ($paymentTypeForm->isSubmitted() && $paymentTypeForm->isValid()) {
            $paymentType = $paymentTypeForm->getData('paymentType');
            $order = $this->paymentService->createPaymentDetails($order, $paymentType);

            new RedirectResponse($this->generateUrl('order_payment_details', ['id' => $order->getId()]));
        }

        return $this->render('order/payment_method_form.html.twig', [
            'paymentMethodForm' => $paymentTypeForm->createView(),
            'order' => $order,
        ]);
    }

    /**
     * @Route("/order/{id}", name="order_payment_details")
     * @ParamConverter("id", class="App\Entity\Order")
     */
    public function paymentDetails(Request $request, Order $order): Response
    {
        return $this->render('payment_method_form.html.twig', [
            'order' => $order,
        ]);
    }

    /**
     * @Route("/order/{id}", name="order_payment_details")
     * @ParamConverter("id", class="App\Entity\Order")
     */
    public function paymentCheck(Order $order): Response
    {
        return $this->render('payment_method_form.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }

    /**
     * @Route("/order/{id}", name="order_payment_details")
     * @ParamConverter("id", class="App\Entity\Order")
     */
    public function showOrderItem(Order $order): Response
    {
        return $this->render('payment_method_form.html.twig', [
            'controller_name' => 'OrderController',
        ]);
    }
}
