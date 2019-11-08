<?php


namespace App\Repository;


use Doctrine\ORM\EntityRepository;

class ComponentRepository extends EntityRepository
{
    public function findAllComponents()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT c FROM App:Component c'
            )
            ->getResult();
    }
}