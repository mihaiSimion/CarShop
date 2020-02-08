<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

class RemoveRoleUser
{
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
}