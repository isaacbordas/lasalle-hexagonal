<?php

namespace MyApp\Component\Product\Entity\Repository;


interface OwnerRepository
{

    public function findById($ownerId);

    public function findAllOrderedByName();

}