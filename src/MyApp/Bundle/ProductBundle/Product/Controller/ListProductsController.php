<?php

namespace MyApp\Bundle\ProductBundle\Product\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use MyApp\Component\Product\Domain\Product;
use MyApp\Component\Product\Domain\Exception\{InvalidArgumentException, RepositoryException};

class ListProductsController extends Controller
{

    public function execute() : JsonResponse
    {
        $handler = $this->get('app.product.command_handler.read_all');

        try {
            $products = $handler->handle();

            $productsAsArray = array_map(function (Product $p) {
                return $this->productToArray($p);
            }, $products);

            return new JsonResponse(
                $productsAsArray,
                200
            );
        } catch (InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        } catch (RepositoryException $e) {
            return new JsonResponse(['error' => 'An application error has occurred'], 500);
        }
    }

    private function productToArray(Product $product)
    {
        return [
            'id' => $product->getId(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'description' => $product->getDescription(),
            'ownerId' => $product->getOwner()
        ];
    }

}