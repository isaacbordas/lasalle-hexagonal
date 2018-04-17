<?php

namespace MyApp\Component\Product\Domain;

use MyApp\Component\Product\Domain\Exception\InvalidActorNameException;

class Owner
{

    private $id;
    private $name;

    public function __construct(string $name)
    {
        $this->validateName($name);
        
        $this->name = filter_var($name, FILTER_SANITIZE_STRING);
    }
    private function validateName(string $name) : void
    {
        if ($name === '') {
            throw InvalidActorNameException::emptyfield();
        }
    }

    public function getId() : int
    {
        return $this->id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName()
        ];
    }
    
}