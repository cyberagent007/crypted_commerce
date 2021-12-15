<?php

namespace App\Service;

class ProductService
{
    public function findAllByAvailableSecrets($secrets)
    {
        $productsCollection = [];

        foreach ($secrets as $secret) {
            if (in_array($secret->getProduct(), $productsCollection)) {
                continue;
            }

            $productsCollection[] = $secret->getProduct();
        }

        return $productsCollection;
    }

    public function getAvailablePackages($secrets)
    {
        $packageCollection = [];

        foreach ($secrets as $secret) {
            if (in_array($secret->getPackage(), $packageCollection)) {
                continue;
            }

            $packageCollection[] = $secret->getPackage();
        }

        return $packageCollection;
    }

    public function groupSecretsByDistrict($secrets)
    {
        $districtCollection = [];
        foreach ($secrets as $secret) {
            $key = $secret->getDistrict()->getName();
            if (array_key_exists($key, $districtCollection)) {
                $districtCollection[$key][] = $secret;
            }

            $districtCollection[$key][]= $secret;
        }
        return $districtCollection;
    }
}