<?php

namespace MyApp\Bundle\ProductBundle\Product\Controller;;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use MyApp\Component\Product\Domain\Product;
use MyApp\Component\Product\Application\Command\Product\DeleteProductCommand;
use MyApp\Component\Product\Domain\Exception\{InvalidArgumentException, RepositoryException};

class DeleteProductController extends Controller
{

    public function execute($id)
    {
        $id = filter_var($id ?? '', FILTER_SANITIZE_NUMBER_INT);

        if (empty($id)) {
            throw new InvalidArgumentException("Argument not valid", 400);
        }

        $command = new DeleteProductCommand($id);
        $handler = $this->get('app.product.command_handler.delete');

        try {
            $handler->handle($command);
            $this->get('doctrine.orm.default_entity_manager')->flush();
            return new Response('',204);
        } catch (InvalidArgumentException $e) {
            return new Response('error', 400);
        } catch (RepositoryException $e) {
            return new Response('An application error has occurred', 500);
        }
    }

}