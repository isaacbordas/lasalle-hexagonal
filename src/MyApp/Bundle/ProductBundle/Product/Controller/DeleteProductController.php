<?php

namespace MyApp\Bundle\ProductBundle\Product\Controller;;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DeleteProductController extends Controller
{

    public function execute($id)
    {
        $deleteProduct = $this->get('app.product.deleteProduct');
        $deleteProduct->execute($id);

        return new Response('', 200);
    }

}