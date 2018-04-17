<?php

namespace MyApp\Component\Product\Application\CommandHandler\Owner;

use MyApp\Component\Product\Application\Command\Owner\CreateOwnerCommand;
use MyApp\Component\Product\Domain\Owner;
use MyApp\Component\Product\Domain\Repository\OwnerRepository;

class CreateOwnerHandler
{
    private $ownerRepository;

    public function __construct(OwnerRepository $ownerRepository)
    {
        $this->ownerRepository = $ownerRepository;
    }

    public function handle(CreateOwnerCommand $command) : Owner
    {
        $owner = new Owner($command->name());
        $this->ownerRepository->save($owner);

        return $owner;
    }

}