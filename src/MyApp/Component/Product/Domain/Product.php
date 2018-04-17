<?php

namespace MyApp\Component\Product\Domain;

use MyApp\Component\Product\Domain\Exception\{InvalidProductNameException, InvalidProductPriceException, InvalidProductDescriptionException};

class Product
{

    private $id;
    private $name;
    private $price;
    private $description;
    private $owner;

    public function __construct(string $name, float $price, string $description, Owner $owner)
    {
        $this->validateName($name);
        $this->validatePrice($price);
        $this->validateDescription($description);
        
        $this->name = filter_var($name, FILTER_SANITIZE_STRING);
        $this->price = filter_var($price, FILTER_SANITIZE_NUMBER_FLOAT);
        $this->description = filter_var($description, FILTER_SANITIZE_STRING);
        $this->owner = $owner;
    }

    private function validateName(string $name): void
    {
        if ($name === '') {
            throw InvalidProductNameException::emptyfield();
        }
    }
    
    private function validatePrice(float $price): void
    {
        if ($price === ''){
            throw InvalidProductPriceException::emptyfield();
        }
    }
    
    private function validateDescription(string $description): void
    {
        if ($description === ''){
            throw InvalidProductDescriptionException::emptyfield();
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

    public function getPrice() : float
    {
        return $this->price;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getOwner() : string
    {
        return $this->owner->getName();
    }

    public function setOwner(Owner $owner)
    {
        $this->owner = $owner;
    }
    
    public function toArray() : array
    {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'description' => $this->getDescription(),
            'owner' => $this->getOwner()
        ];
    }
    
}