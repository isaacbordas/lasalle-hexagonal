<?php

namespace MyApp\Component\Product\Domain\Repository;

use MyApp\Component\Product\Domain\Owner;

interface OwnerRepository
{

    public function findById(int $ownerId);
    public function findAllOrderedByName();
    public function save(Owner $owner): void;

}