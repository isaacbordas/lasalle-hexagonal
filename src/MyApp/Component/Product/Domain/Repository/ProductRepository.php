<?php

namespace MyApp\Component\Product\Domain\Repository;

use MyApp\Component\Product\Domain\Product;

interface ProductRepository {
    
    public function findById(int $productId);
    public function findAllOrderedByName();
    public function save(Product $product) : void;
    public function update(Product $product) : void;
    public function delete(Product $product) : void;
}
