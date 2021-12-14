<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Product;
use App\Repository\CityRepository;
use App\Repository\ProductRepository;
use App\Repository\SecretRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends AbstractController
{
    private ProductRepository $productRepository;
    private CityRepository $cityRepository;

    public function __construct(ProductRepository $productRepository, CityRepository $cityRepository, SecretRepository  $secretRepository)
    {
        $this->cityRepository = $cityRepository;
        $this->productRepository = $productRepository;
        $this->secretRepository = $secretRepository;
    }

    /**
     * @Route("/", name="cities")
     */
    public function index(Request $request): Response
    {
        $cityCollection = $this->cityRepository->findAll();
        $secretRepository = $this->secretRepository;
        array_filter($cityCollection, function ($city) use ($secretRepository) {
            if ($secretRepository->findAllSecretsByCity($city) > 1) {
                return true;
            }

            return false;
        });

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
        $secretCollection = $city->getSecrets();
        $productCollection = $this->productRepository->findAllByAvailableSecrets($secretCollection);

        return $this->render('store/index.html.twig', [
            'products' => $productCollection,
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
