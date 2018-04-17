<?php

namespace MyApp\Component\Product\Domain\Exception;

class InvalidProductNameException extends InvalidArgumentException
{

    public static function emptyfield()
    {
        return new static("The product's name must be specified");
    }

}