<?php

namespace MyApp\Bundle\ProductBundle\Product\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use MyApp\Component\Product\Application\Command\Product\CreateProductCommand;
use MyApp\Component\Product\Domain\Product;
use MyApp\Component\Product\Domain\Exception\{InvalidArgumentException, RepositoryException};

class CreateProductController extends Controller
{

    public function execute(Request $request) : Response
    {

        $json = json_decode($request->getContent(), true);
        $name = filter_var($json['name'] ?? '', FILTER_SANITIZE_STRING);
        $price = filter_var($json['price'] ?? '', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $description = filter_var($json['description'] ?? '', FILTER_SANITIZE_STRING);
        $ownerId = filter_var($json['ownerId'] ?? '', FILTER_SANITIZE_NUMBER_INT);

        if (empty($name) || empty($price) || empty($description) || empty($ownerId)) {
            throw new InvalidArgumentException("Missing arguments", 400);
        }

        $command = new CreateProductCommand($name, $price, $description, $ownerId);
        $handler = $this->get('app.product.command_handler.create');

        try {
            $product = $handler->handle($command);
            $this->get('doctrine.orm.default_entity_manager')->flush();
            return new Response('Product correctly created',201);
        } catch (InvalidArgumentException $e) {
            return new Response('error', 400);
        } catch (RepositoryException $e) {
            return new Response('An application error has occurred', 500);
        }

    }

}