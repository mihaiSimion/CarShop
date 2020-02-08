<?php

namespace AppBundle\Resources;

class CarCountResource
{
    private $model;
    private $km;

    public function __construct(string $model, int $km)
    {
        $this->km = $km;
        $this->model = $model;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;
        return $this;
    }

    public function getKm(): int
    {
        return $this->km;
    }

    public function setKm(int $km): self
    {
        $this->km = $km;
        return $this;
    }


}