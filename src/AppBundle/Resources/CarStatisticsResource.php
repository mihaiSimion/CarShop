<?php

namespace AppBundle\Resources;

class CarStatisticsResource
{
    private $id;
    private $name;
    private $numberOfProfiles;

    public function __construct(int $id, string $name, int $numberOfProfiles)
    {
        $this->id = $id;
        $this->name = $name;
        $this->numberOfProfiles = $numberOfProfiles;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getNumberOfProfiles(): int
    {
        return $this->numberOfProfiles;
    }

    public function setNumberOfProfiles(int $numberOfProfiles): void
    {
        $this->numberOfProfiles = $numberOfProfiles;
    }
}
