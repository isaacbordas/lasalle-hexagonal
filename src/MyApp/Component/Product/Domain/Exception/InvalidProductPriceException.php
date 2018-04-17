<?php

namespace MyApp\Component\Product\Domain\Exception;

class InvalidProductPriceException extends InvalidArgumentException
{

    public static function emptyfield()
    {
        return new static("The product's price must be specified");
    }

}