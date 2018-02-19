<?php

namespace MyApp\Component\Product\Domain\Repository;


interface OwnerRepository
{

    public function findAllOrderedByName();

}