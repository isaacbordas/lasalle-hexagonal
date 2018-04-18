<?php

namespace MyApp\Bundle\ProductBundle\Owner\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\Component\Product\Domain\Owner;
use MyApp\Component\Product\Application\Command\Owner\CreateOwnerCommand;
use MyApp\Component\Product\Domain\Exception\{InvalidArgumentException, RepositoryException};
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CreateOwnerController extends Controller
{

    public function execute(Request $request) : Response
    {

        $json = json_decode($request->getContent(), true);
        $name = filter_var($json['name'] ?? '', FILTER_SANITIZE_STRING);

        $command = new CreateOwnerCommand($name);
        $handler = $this->get('app.owner.command_handler.create');

        try {
            $owner = $handler->handle($command);
            $this->get('doctrine.orm.default_entity_manager')->flush();
            return new Response('Owner correctly created',201);
        } catch (InvalidArgumentException $e) {
            return new Response('error', 400);
        } catch (RepositoryException $e) {
            return new Response('An application error has occurred', 500);
        }

    }

}