<?php

namespace App\Controller\Admin;

use App\Entity\District;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DistrictCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return District::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            AssociationField::new('city_id')
        ];
    }

}
