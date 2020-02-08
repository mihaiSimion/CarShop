<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Profile;
use Doctrine\ORM\EntityRepository;

class Profiles extends EntityRepository
{
    public function getProfilesByPage(int $page, int $limit = 3): array
    {
        $qb = $this->createQueryBuilder('p')
            ->setFirstResult($page * $limit)
            ->setMaxResults($limit + 1);

        return $qb->getQuery()->getResult();
    }

    public function insertProfiles(array $profiles): void
    {
        /** @var Profile $profile */
        foreach ($profiles as $profile) {
            $this->_em->persist($profile);
        }
        $this->_em->flush();
    }

    public function getProfilesWithCarCount()
    {
        $qb = $this->createQueryBuilder('p')
            ->select('p.id, p.username, p.password , COUNT(p.id)')
            ->innerJoin('p.cars', 'c')
            ->addGroupBy('p.id');

        return $qb->getQuery()->getResult();
    }

    public function getProfiles($name)
    {
        $qb = $this->createQueryBuilder('p')
            ->where('p.firstName LIKE :string')
            ->setParameter('string', $name)
            ->andWhere('p.numberOfAccidents <1 ');

        return $qb->getQuery()->getResult();
    }
}
