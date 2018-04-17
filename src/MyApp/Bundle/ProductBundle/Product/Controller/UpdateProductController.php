<?php

namespace MyApp\Bundle\ProductBundle\Product\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MyApp\Component\Product\Application\Command\Product\UpdateProductCommand;
use MyApp\Component\Product\Domain\Product;
use MyApp\Component\Product\Domain\Exception\{InvalidArgumentException, RepositoryException};

class UpdateProductController extends Controller
{

    public function execute(Request $request, $id)
    {

        $json = json_decode($request->getContent(), true);
        $name = filter_var($json['name'] ?? '', FILTER_SANITIZE_STRING);
        $price = filter_var($json['price'] ?? '', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $description = filter_var($json['description'] ?? '', FILTER_SANITIZE_STRING);
        $ownerId = filter_var($json['ownerId'] ?? '', FILTER_SANITIZE_NUMBER_INT);
        $productId = filter_var($id ?? '', FILTER_SANITIZE_NUMBER_INT);

        $command = new UpdateProductCommand($name, $price, $description, $ownerId, $productId);
        $handler = $this->get('app.product.command_handler.update');

        try {
            $film = $handler->handle($command);
            $this->get('doctrine.orm.default_entity_manager')->flush();
            return new Response('Product correctly updated',200);
        } catch (InvalidArgumentException $e) {
            return new Response('error', 400);
        } catch (RepositoryException $e) {
            return new Response('An application error has occurred', 500);
        }

    }

}