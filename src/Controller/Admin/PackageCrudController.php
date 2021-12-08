<?php

namespace App\Controller\Admin;

use App\Entity\Package;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class PackageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Package::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('size'),
        ];
    }
}
