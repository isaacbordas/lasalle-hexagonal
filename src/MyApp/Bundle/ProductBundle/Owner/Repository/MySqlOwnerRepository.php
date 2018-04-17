<?php

namespace MyApp\Bundle\ProductBundle\Owner\Repository;

use MyApp\Component\Product\Domain\Owner;
use MyApp\Component\Product\Domain\Repository\OwnerRepository;
use MyApp\Component\Product\Domain\Exception\RepositoryException;
use MyApp\Component\Product\Domain\Exception\UnknownOwnerException;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class MySqlOwnerRepository implements OwnerRepository
{

    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function save(Owner $owner) : void
    {
        try {
            $this->em->persist($owner);
        } catch (Exception $e) {
            throw RepositoryException::withError($e);
        }
    }

    public function findById(int $ownerId) : Owner
    {
        $owner = $this->em
            ->getRepository('ProductBundle:Owner')
            ->findBy(['id' => $ownerId]);
        if (count($owner) === 0) {
            throw UnknownOwnerException::withOwnerId($ownerId);
        }
        return $owner[0];
    }

    public function findAllOrderedByName() : array
    {
        try {
            return $this->em
                ->createQuery(
                    'SELECT o FROM \Myapp\Component\Product\Domain\Owner o ORDER BY o.name ASC'
                )
                ->getResult();
        } catch (Exception $e) {
            throw RepositoryException::withError($e);
        }
    }

}