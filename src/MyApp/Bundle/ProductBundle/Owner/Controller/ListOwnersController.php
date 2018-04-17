<?php

namespace MyApp\Bundle\ProductBundle\Owner\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use MyApp\Component\Product\Domain\Owner;
use MyApp\Component\Product\Domain\Exception\{InvalidArgumentException, RepositoryException};

class ListOwnersController extends Controller
{

    public function execute() : JsonResponse
    {
        $handler = $this->get('app.owner.command_handler.read_all');

        try {
            $owners = $handler->handle();

            $ownersAsArray = array_map(function (Owner $o) {
                return $this->ownerToArray($o);
            }, $owners);

            return new JsonResponse(
                $ownersAsArray,
                200
            );
        } catch (InvalidArgumentException $e) {
            return new JsonResponse(['error' => $e->getMessage()], 400);
        } catch (RepositoryException $e) {
            return new JsonResponse(['error' => 'An application error has occurred'], 500);
        }
    }

    private function ownerToArray(Owner $owner)
    {
        return [
            'id' => $owner->getId(),
            'name' => $owner->getName()
        ];
    }

}