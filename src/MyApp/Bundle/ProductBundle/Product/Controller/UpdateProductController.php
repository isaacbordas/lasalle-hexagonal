<?php

namespace MyApp\Bundle\ProductBundle\Product\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UpdateProductController extends Controller
{

    public function execute(Request $request, $id)
    {

        $json = json_decode($request->getContent(), true);

        $product = $this->getDoctrine()->getRepository('\MyApp\Component\Product\Domain\Product')->findOneBy(['id' => $id]);

        $product->setName($json['name']);
        $product->setPrice($json['price']);
        $product->setDescription($json['description']);

        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new Response('', 200);

    }

}