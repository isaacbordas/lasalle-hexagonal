<?php

namespace MyApp\Component\Product\Domain\Exception;

use Throwable;

class UnknowProductException extends BadOperationException
{
    public $productId;

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function withProductId(int $id) : self
    {
        $e = new static("Product with id [$id] doesn't exist");
        $e->productId = $id;
        return $e;
    }
}