<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class Cars extends EntityRepository
{

    public function getCarsByPage(int $page, int $limit = 2)
    {
        $qb = $this->createQueryBuilder('p')
            ->setFirstResult($page * $limit)
            ->setMaxResults($limit + 1);

        return $qb->getQuery()->getResult();
    }

    public function getCarsWithCounter()
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c.id, c.name, COUNT(c.id)')
            ->innerJoin('c.profiles', 'p')
            ->groupBy('c.id');

        return $qb->getQuery()->getResult();
    }
}
