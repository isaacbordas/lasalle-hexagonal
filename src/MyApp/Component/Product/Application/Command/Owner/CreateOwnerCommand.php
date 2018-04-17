<?php

namespace MyApp\Component\Product\Application\Command\Owner;

class CreateOwnerCommand
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function name(): string
    {
        return $this->name;
    }

}