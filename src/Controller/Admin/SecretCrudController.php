<?php

namespace App\Controller\Admin;

use App\Entity\Secret;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
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
            DateField::new('created_at'),
            ImageField::new('photo')->setUploadDir('/public/images'),
            ImageField::new('detailed_photo')->setUploadDir('/public/images'),
            AssociationField::new('package_id'),
            AssociationField::new('product_id'),
            AssociationField::new('city_id'),
            AssociationField::new('district_id'),
            AssociationField::new('created_by')->setDisabled(true),
        ];
    }
}
