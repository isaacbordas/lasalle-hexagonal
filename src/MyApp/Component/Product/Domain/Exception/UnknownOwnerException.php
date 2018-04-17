<?php

namespace MyApp\Component\Product\Domain\Exception;

use Throwable;

class UnknownOwnerException extends BadOperationException
{
    public $ownerId;

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function withOwnerId(int $id) : self
    {
        $e = new static("Owner with id [$id] doesn't exist");
        $e->ownerId = $id;
        return $e;
    }
}