<?php

namespace AppBundle\Factory;

use AppBundle\Entity\Car;
use AppBundle\Entity\Profile;

class ProfileFactory
{
    public function create(array $user): Profile
    {
        $profile = new Profile();
        $profile->setUsername($user['username'])
            ->setPassword($user['password'])
            ->addCar($user['car']);

        return $profile;
    }

    public function createList(array $users): array
    {
        $profiles = [];
        foreach ($users as $user) {
            $profiles[] = $this->create($user);
        }

        return $profiles;
    }

    public function createProfilesForCar(Car $car, int $numberOfProfiles): array
    {
        $users = [];
        for ($i = 0; $i < $numberOfProfiles; $i++) {
            $users[] = $this->create($this->generateProfileData($car));
        }

        return $users;
    }

    private function generateProfileData(Car $car): array
    {
        $random = rand(1, 1000);
        $profileData = [
            "lastName" => "Generated User - " . $random,
            "password" => "Password" . $random,
            "car" => $car,
        ];

        return $profileData;
    }
}
