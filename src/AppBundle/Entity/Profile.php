<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Profiles")
 * @ORM\Table(name="users")
 */
class Profile implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer" )
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="last_name", type="string",length=100, nullable=false)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string",length=100)
     */
    private $firstName;

    /**
     * @ORM\Column(type="string",length=100)
     */
    private $username;

    /**
     * @ORM\Column(type="string",length=100)
     */
    private $password;

    /**
     * @ORM\Column(type="date",length=100)
     */
    protected $birthday;

    /**
     * @ORM\Column(type="string",length=100)
     */
    private $driverLicenseCategory;

    /**
     * @ORM\ManyToMany(targetEntity="Car", inversedBy="profiles")
     * @JoinTable(name="profiles_cars")
     */
    private $cars;

    /**
     * @ORM\Column(type="integer",length=100)
     */
    private $numberOfAccidents;

    /**
     * @ORM\Column(type="boolean",length=100)
     */
    private $casco;

    /**
     * @ORM\Column(type="date",length=100)
     */
    private $asuranceExpireDate;

    /**
     * @ORM\Column(type="array" , nullable=true)
     */
    private $roles = [];

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }

    public function addCar(Car $car): self
    {
        $this->cars->add($car);
        return $this;
    }

    public function removeCar(Car $car): self
    {
        $this->cars->removeElement($car);
        return $this;
    }

    public function getCars(): ?array
    {
        return $this->cars->toArray();
    }

    public function setCars(Car $car): self
    {
        $this->cars->add($car);
        return $this;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;
        return $this;
    }

    public function getBirthday()
    {
        return $this->birthday;
    }

    public function setBirthday($birthday): self
    {
        $this->birthday = $birthday;
        return $this;
    }

    public function getDriverLicenseCategory(): ?string
    {
        return $this->driverLicenseCategory;
    }

    public function setDriverLicenseCategory(string $driverLicenseCategory): self
    {
        $this->driverLicenseCategory = $driverLicenseCategory;
        return $this;
    }

    public function getNumberOfAccidents(): ?int
    {
        return $this->numberOfAccidents;
    }

    public function setNumberOfAccidents(int $numberOfAccidents): self
    {
        $this->numberOfAccidents = $numberOfAccidents;
        return $this;
    }

    public function getCasco(): ?bool
    {
        return $this->casco;
    }

    public function setCasco(bool $casco): self
    {
        $this->casco = $casco;
        return $this;
    }

    public function getAsuranceExpireDate(): ?\DateTime
    {
        return $this->asuranceExpireDate;
    }

    public function setAsuranceExpireDate($asuranceExpireDate): self
    {
        $this->asuranceExpireDate = $asuranceExpireDate;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword($password): self
    {
        $this->password = $password;
        return $this;
    }

    public function setUsername($username): self
    {
        $this->username = $username;
        return $this;
    }

    public function getRoles()
    {
        return array_unique($this->roles);
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {

    }

    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password
        ]);
    }

    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password
            ) = unserialize($serialized);
    }

    public function setRoles($roles)
    {
        $this->roles = $roles;
        return $this;
    }
}
