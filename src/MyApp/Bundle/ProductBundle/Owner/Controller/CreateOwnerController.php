<?php

namespace MyApp\Bundle\ProductBundle\Owner\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateOwnerController extends Controller
{

    public function execute(Request $request)
    {

        $json = json_decode($request->getContent(), true);

        $name = $json['name'];

        $createProduct = $this->get('app.product.createOwner');
        $createProduct->execute($name);

        return new Response('', 201);

    }

}