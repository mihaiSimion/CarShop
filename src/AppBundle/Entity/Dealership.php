<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Dealerships")
 * @ORM\Table(name="dealership")
 */
class Dealership
{
    /**
     * @ORM\Column(type="integer" , unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string",length=100)
     */
    private $name;

    /**
     * @ORM\Column(type="string",length=100)
     */
    private $address;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Car", mappedBy="id")
     */
    private $cars;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Profile")
     * @JoinColumn(name="director_id", referencedColumnName="id")
     */
    private $director;

    /**
     * @ORM\Column(type="time",length=100)
     */
    private $closeHour;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress($address): self
    {
        $this->address = $address;
        return $this;
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

    public function getDirector(): ?Profile
    {
        return $this->director;
    }

    public function setDirector($director): self
    {
        $this->director = $director;
        return $this;
    }

    public function getCloseHour(): ?\DateTime
    {
        return $this->closeHour;
    }

    public function setCloseHour($closeHour): self
    {
        $this->closeHour = $closeHour;
        return $this;
    }
}
