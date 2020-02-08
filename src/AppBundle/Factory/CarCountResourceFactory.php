<?php

namespace AppBundle\Factory;

use AppBundle\Resources\CarCountResource;

class CarCountResourceFactory
{
    public function create(array $car)
    {
        return new CarCountResource($car["model"], $car["km"]);
    }

    public function createList(array $cars)
    {
        $resource = [];

        foreach ($cars as $car) {
            array_push($resource, $this->create($car));
        }
        return $resource;
    }
}
