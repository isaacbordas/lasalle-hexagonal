<?php

namespace MyApp\Bundle\ProductBundle\Product\Repository;

use MyApp\Component\Product\Domain\Product;
use MyApp\Component\Product\Domain\Repository\ProductRepository;
use MyApp\Component\Product\Domain\Exception\RepositoryException;
use MyApp\Component\Product\Domain\Exception\UnknowProductException;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class MySqlProductRepository implements ProductRepository
{

    private $em;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function save(Product $product) : void
    {
        try {
            $this->em->persist($product);
        } catch (Exception $e) {
            throw RepositoryException::withError($e);
        }
    }

    public function update(Product $product) : void
    {
        $this->save($product);
    }

    public function delete(Product $product) : void
    {
        try {
            $this->em->remove($product);
        } catch (Exception $e) {
            throw RepositoryException::withError($e);
        }
    }

    public function findById(int $productId) : Product
    {
        $product = $this->em
            ->getRepository('ProductBundle:Product')
            ->findBy(['id' => $productId]);
        if (count($product) === 0) {
            throw UnknowProductException::withProductId($productId);
        }
        return $product[0];
    }
    public function findAllOrderedByName() : array
    {
        try {
            return $this->em
                ->createQuery(
                    'SELECT o FROM \Myapp\Component\Product\Domain\Product o ORDER BY o.name ASC'
                )
                ->getResult();
        } catch (Exception $e) {
            throw RepositoryException::withError($e);
        }
    }
}