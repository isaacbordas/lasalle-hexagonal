<?php

namespace MyApp\Component\Product\Application\CommandHandler\Owner;

use MyApp\Component\Product\Domain\Owner;
use MyApp\Component\Product\Domain\Repository\OwnerRepository;

class ReadOwnerAllHandler
{
    private $ownerRepository;

    public function __construct(OwnerRepository $ownerRepository)
    {
        $this->ownerRepository = $ownerRepository;
    }

    public function handle() : array
    {
        $owners = $this->ownerRepository->findAllOrderedByName();

        return $owners;
    }
}