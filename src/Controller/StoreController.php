<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends AbstractController
{
    /**
     * @Route("/", name="store")
     */
    public function index(ProductRepository $productRepository): Response
    {
        $productsCollection = $productRepository->findAll();

        return $this->render('store/index.html.twig', [
            'products' => $productsCollection,
        ]);
    }
}
