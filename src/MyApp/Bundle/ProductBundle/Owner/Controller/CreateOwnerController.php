<?php

namespace MyApp\Bundle\ProductBundle\Owner\Controller;

use MyApp\Component\Product\Domain\Owner;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateOwnerController extends Controller
{

    public function execute(Request $request)
    {

        $json = json_decode($request->getContent(), true);

        $em = $this->getDoctrine()->getManager();

        $owner = new Owner((string)$json['name']);
        $em->persist($owner);
        $em->flush();

        return new Response('', 201);

    }

}