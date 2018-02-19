<?php

namespace MyApp\Bundle\ProductBundle\Product\Controller;

use Doctrine\ORM\Query;
use MyApp\Component\Product\Domain\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListProductsController extends Controller
{

    public function execute()
    {
        $products = $this->getDoctrine()->getRepository('\MyApp\Component\Product\Domain\Product')->findAll(Query::HYDRATE_ARRAY);

        $productsAsArray = array_map(function (Product $p) {
            return $this->productToArray($p);
        }, $products);

        return new JsonResponse($productsAsArray);
    }

    private function productToArray(Product $product)
    {
        return [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'description' => $product->getDescription(),
            'ownerId' => $product->getOwner()->getId()
        ];
    }

}