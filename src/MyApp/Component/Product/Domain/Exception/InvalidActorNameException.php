<?php

namespace MyApp\Component\Product\Domain\Exception;

class InvalidActorNameException extends InvalidArgumentException
{

    public static function emptyfield()
    {
        return new static("The owner's name must be specified");
    }

}