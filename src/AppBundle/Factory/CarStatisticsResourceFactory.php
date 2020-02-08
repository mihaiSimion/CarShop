<?php

namespace AppBundle\Factory;

use AppBundle\Resources\CarStatisticsResource;

class CarStatisticsResourceFactory
{
    public function create(array $car)
    {
        return new CarStatisticsResource($car["id"], $car["name"], $car[1]);
    }

    public function createList(array $cars)
    {
        $resources = [];
        foreach ($cars as $car) {
            $resources[] = $this->create($car);
        }

        return $resources;
    }
}
