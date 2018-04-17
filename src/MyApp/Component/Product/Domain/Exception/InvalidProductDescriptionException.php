<?php

namespace MyApp\Component\Product\Domain\Exception;

class InvalidProductDescriptionException extends InvalidArgumentException
{

    public static function emptyfield()
    {
        return new static("The product's description must be specified");
    }

}