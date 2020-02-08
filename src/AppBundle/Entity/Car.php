<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Cars")
 * @ORM\Table(name="cars")
 */
class Car
{
    /**
     * @ORM\Column(type="integer" , unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Mark", inversedBy="cars")
     * @JoinColumn(name="mark_id", referencedColumnName="id")
     */
    private $mark;

    /**
     * @ORM\Column(type="string",length=100)
     */
    private $model;

    /**
     * @ORM\Column(type="string",length=100)
     */
    private $type;

    /**
     * @ORM\Column(type="integer",length=100)
     */
    private $km;

    /**
     * @ORM\Column(type="boolean",length=100)
     */
    private $new;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Dealership", inversedBy="cars")
     * @JoinColumn(name="dealerShip_id", referencedColumnName="id")
     */
    private $dealerShip;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Profile", mappedBy="cars")
     */
    private $profiles;

    public function __construct()
    {
        $this->profiles = new ArrayCollection();
    }

    public function addProfile(Profile $profile): self
    {
        $this->profiles->add($profile);
        return $this;
    }

    public function removeProfile(Profile $profile): self
    {
        $this->profiles->remove($profile);
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getMark(): ?Mark
    {
        return $this->mark;
    }

    public function setMark(Mark $mark): self
    {
        $this->mark = $mark;
        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;
        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function getKm(): ?int
    {
        return $this->km;
    }

    public function setKm(int $km): self
    {
        $this->km = $km;
        return $this;
    }

    public function getNew(): ?bool
    {
        return $this->new;
    }

    public function setNew(bool $new): self
    {
        $this->new = $new;
        return $this;
    }

    public function getDealerShip(): ?Dealership
    {
        return $this->dealerShip;
    }

    public function setDealerShip(Dealership $dealerShip): self
    {
        $this->dealerShip = $dealerShip;
        return $this;
    }

    public function getProfiles(): array
    {
        return $this->profiles->toArray();
    }

    public function setProfiles(ArrayCollection $profiles): self
    {
        $this->profiles = $profiles;
        return $this;
    }
}

