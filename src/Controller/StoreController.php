<?php

namespace App\Controller;

use App\Entity\City;
use App\Entity\Order;
use App\Entity\Product;
use App\Repository\CityRepository;
use App\Repository\ProductRepository;
use App\Repository\SecretRepository;
use App\Service\OrderService;
use App\Service\ProductService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StoreController extends AbstractController
{
    private ProductRepository $productRepository;
    private CityRepository $cityRepository;
    private ProductService $productService;
    private SecretRepository $secretRepository;
    private OrderService $orderService;

    public function __construct(
        ProductRepository $productRepository,
        CityRepository $cityRepository,
        SecretRepository  $secretRepository,
        ProductService $productService,
        OrderService $orderService
    ) {
        $this->cityRepository = $cityRepository;
        $this->productRepository = $productRepository;
        $this->secretRepository = $secretRepository;
        $this->productService = $productService;
        $this->orderService = $orderService;
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
        $productCollection = $this->productService->findAllByAvailableSecrets($secretCollection);

        return $this->render('store/index.html.twig', [
            'city' => $city,
            'products' => $productCollection,
        ]);
    }

    /**
     * @Route("/store/{id}/product/{item}", name="view_product", methods={"GET", "POST"})
     * @ParamConverter("id", class="App\Entity\City")
     * @ParamConverter("item", class="App\Entity\Product")
     */
    public function view(Request $request, City $city, Product $product)
    {
        $secrets = $this->secretRepository->findAllSecretsByCityAndProduct($city, $product);
        $preparedSecrets = $this->productService->groupSecretsByDistrict($secrets);
        $orderEntity = new Order();

        $customerOrderForm = $this->createFormBuilder($orderEntity)
            ->add('productSecret', ChoiceType::class, [
                'choices' => $preparedSecrets,
                'choice_label' => function ($choice, $key, $value) {
                    return $choice->getProduct()->getName() . '/' . $choice->getPackage()->getSize() . 'g.';
                }
            ])
            ->add('buy', SubmitType::class, ['label' => 'Buy'])
            ->getForm();

        $customerOrderForm->handleRequest($request);

        if ($customerOrderForm->isSubmitted()) {
            $orderEntity = $this->orderService->createOrder($orderEntity, $this->getUser());

            return new RedirectResponse($this->generateUrl('order_payment_method', ['id' => $orderEntity->getId()]));
        }

        return $this->render('store/product.html.twig', [
            'product' => $product,
            'order_form' => $customerOrderForm->createView(),
        ]);
    }
}
