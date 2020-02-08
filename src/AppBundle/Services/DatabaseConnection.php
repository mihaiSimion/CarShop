<?php

namespace AppBundle\Services;

use Doctrine\ORM\EntityManager;

class DatabaseConnection
{

    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function returnAllProfiles()
    {
        $allUsers = $this->em->getRepository('AppBundle:Profile')->findAll();
        return $allUsers;
    }

}