<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Product;
use App\Repository\CityRepository;
use App\Repository\ProductRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends AbstractController
{
    private ProductRepository $productRepository;
    private CityRepository $cityRepository;

    public function __construct(ProductRepository $productRepository, CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @Route("/", name="cities")
     */
    public function index(Request $request): Response
    {
        $cityCollection = $this->cityRepository->findNotEmpty();

        if (empty($cityCollection)) {
            return $this->render('store/empty.html.twig', []);
        }

        return $this->render('store/cities.html.twig', [
            'cities' => $cityCollection,
        ]);
    }

    /**
     * @Route("/store/{id}", name="store")
     * @ParamConverter("id", class="App\Entity\City")
     */
    public function store(City $city): Response
    {
        $secretsInCity = $city->getSecrets();

        return $this->render('store/index.html.twig', [
            'products' => $secretsInCity,
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
