<?php

namespace AppBundle\Resources;

class CarForHomepageStatisticsResource
{

    private $id;
    private $model;
    private $km;


    public function __construct($model, $km)
    {
        $this->model = $model;
        $this->km = $km;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }


    public function setModel($model): self
    {
        $this->model = $model;
        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm($km): self
    {
        $this->km = $km;
        return $this;
    }
}