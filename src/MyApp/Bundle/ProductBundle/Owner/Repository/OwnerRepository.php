<?php

namespace MyApp\Bundle\ProductBundle\Owner\Repository;

use Doctrine\ORM\EntityRepository;

class OwnerRepository extends EntityRepository
{

    public function findAllOrderedByName()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT o FROM \MyApp\Component\Product\Domain\Owner o ORDER BY o.name ASC'
            )
            ->getResult();
    }

}