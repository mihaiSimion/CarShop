<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class Dealerships extends EntityRepository
{
    public function getDealershipsByPage(int $page, int $limit = 5)
    {
        $qb = $this->createQueryBuilder('d')
            ->setFirstResult($page * $limit)
            ->setMaxResults($limit + 1);

        return $qb->getQuery()->getResult();
    }
}