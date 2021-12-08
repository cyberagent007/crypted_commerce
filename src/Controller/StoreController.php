<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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

    /**
     * @Route("/product/{id}", name="view_product")
     * @ParamConverter("product", class="App\Entity\Product")
     */
    public function view(Product $product)
    {

        return $this->render('store/product.html.twig', [
            'product' => $product,
        ]);
    }
}
