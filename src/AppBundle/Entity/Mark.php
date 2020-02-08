<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Marks")
 * @ORM\Table(name="mark")
 */
class Mark
{
    /**
     * @ORM\Column(type="integer" , unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Car", mappedBy="mark")
     */
    private $cars;

    /**
     * @ORM\Column(type="string",length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="integer",length=100)
     */
    private $numberOfCarsProduced;

    /**
     * @ORM\Column(type="string",length=100)
     */
    private $class;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCars(): ?array
    {
        return $this->cars->toArray();
    }

    public function setCars(array $cars): self
    {
        $this->cars = $cars;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getNumberOfCarsProduced(): ?int
    {
        return $this->numberOfCarsProduced;
    }

    public function setNumberOfCarsProduced(int $numberOfCarsProduced): self
    {
        $this->numberOfCarsProduced = $numberOfCarsProduced;
        return $this;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function setClass(string $class): self
    {
        $this->class = $class;
        return $this;
    }
}