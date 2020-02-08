<?php

namespace AppBundle\Services;

use AppBundle\Factory\ProfileFactory;
use AppBundle\Resources\CarStatisticsResource;
use Doctrine\ORM\EntityManager;

class CarStatisticsPersistance
{
    private $profileFactory;
    private $em;

    public function __construct(ProfileFactory $profileFactory, EntityManager $em)
    {
        $this->profileFactory = $profileFactory;
        $this->em = $em;
    }

    public function persistData(array $carStatisticsResources, CarStatisticsResource $carWithMostProfiles)
    {
        /**
         * @var CarStatisticsResource $carStatisticsResource
         */
        foreach ($carStatisticsResources as $carStatisticsResource) {
            $car = $this->em->getRepository('AppBundle:Car')->find($carStatisticsResource->getId());
            $numberOfProfiles = $carWithMostProfiles->getNumberOfProfiles() - $carStatisticsResource->getNumberOfProfiles();
            $users = $this->profileFactory->createProfilesForCar($car, $numberOfProfiles);
            $this->em->getRepository('AppBundle:Profile')->insertProfiles($users);
        }
    }
}
