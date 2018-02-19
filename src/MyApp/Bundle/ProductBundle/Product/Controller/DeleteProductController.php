<?php

namespace MyApp\Bundle\ProductBundle\Product\Controller;;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DeleteProductController extends Controller
{

    public function execute($id)
    {
        $em = $this->getDoctrine()->getManager();

       $product = $em->getReference('\MyApp\Component\Product\Domain\Product', $id);

       $em->remove($product);
       $em->flush();

       return new Response('', 200);
    }

}