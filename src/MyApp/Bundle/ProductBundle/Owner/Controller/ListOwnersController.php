<?php

namespace MyApp\Bundle\ProductBundle\Owner\Controller;

use Doctrine\ORM\Query;
use MyApp\Component\Product\Domain\Owner;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class ListOwnersController extends Controller
{

    public function execute()
    {
        $owners = $this->getDoctrine()->getRepository('\MyApp\Component\Product\Domain\Owner')->findAll(Query::HYDRATE_ARRAY);

        $ownersAsArray = array_map(function (Owner $o) {
             return $this->ownerToArray($o);
        }, $owners);

        return new JsonResponse($ownersAsArray);
    }

    private function ownerToArray(Owner $owner)
    {
        return [
            'id' => $owner->getId(),
            'name' => $owner->getName()
        ];
    }

}