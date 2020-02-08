<?php

namespace AppBundle\Services;

use AppBundle\Resources\CarStatisticsResource;

class CarStatisticsCalculator
{
    public function getCarWithMostProfiles(array $carStatisticResources): CarStatisticsResource
    {
        $max = 0;
        $position = 0;
        /** @var CarStatisticsResource $carStatisticResource */
        foreach ($carStatisticResources as $index => $carStatisticResource) {
            if ($carStatisticResource->getNumberOfProfiles() > $max) {
                $position = $index;
                $max = $carStatisticResource->getNumberOfProfiles();
            }
        }

        return $carStatisticResources[$position];
    }
}
