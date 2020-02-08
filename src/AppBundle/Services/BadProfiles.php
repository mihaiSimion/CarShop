<?php

namespace AppBundle\Services;

class BadProfiles
{
    private $data;

    public function __construct(DatabaseConnection $data)
    {
        $this->data = $data;
    }

    public function getAllBadProfiles()
    {
        $resources = $this->data->returnAllProfiles();
        $badusers = [];
        foreach ($resources as $profile) {
            if ($profile->getNumberOfAccidents() > 0) {
                array_push($badusers, $profile);
            }
        }
        return $badusers;
    }

}