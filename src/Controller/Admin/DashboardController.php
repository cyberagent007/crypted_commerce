<?php

namespace App\Controller\Admin;

use App\Entity\City;
use App\Entity\District;
use App\Entity\Package;
use App\Entity\Product;
use App\Entity\Secret;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Slavebot');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Users', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Cities', 'fas fa-user', City::class);
        yield MenuItem::linkToCrud('Districts', 'fas fa-user', District::class);
        yield MenuItem::linkToCrud('Packages', 'fas fa-user', Package::class);
        yield MenuItem::linkToCrud('Products', 'fas fa-user', Product::class);
        yield MenuItem::linkToCrud('Secrets', 'fas fa-user', Secret::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
