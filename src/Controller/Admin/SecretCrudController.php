<?php

namespace App\Controller\Admin;

use App\Entity\Secret;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class SecretCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Secret::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('lat'),
            NumberField::new('lan'),
            ImageField::new('photo')->setUploadDir('/public/images'),
            AssociationField::new('package_id'),
            AssociationField::new('product_id'),
            AssociationField::new('district_id'),
        ];
    }
}
