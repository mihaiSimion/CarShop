<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class Marks extends EntityRepository
{
    public function getMarksByPage(int $page, int $limit = 3)
    {
        $qb = $this->createQueryBuilder('m')
            ->setFirstResult($page * $limit)
            ->setMaxResults($limit + 1);

        return $qb->getQuery()->getResult();
    }
}