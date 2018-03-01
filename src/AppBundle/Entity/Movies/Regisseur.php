<?php

namespace AppBundle\Entity\Movies;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Movies\Movie;

/**
 * Regisseur
 *
 * @ORM\Table(name="movies_regisseur")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Movies\RegisseurRepository")
 */
class Regisseur
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="fullName", type="string", length=255)
     */
    private $fullName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="datetime", nullable=true)
     */
    private $birthday;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Movies\Movie", mappedBy="regisseur")
     */
    private $movies;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getMovies()
    {
        return $this->movies;
    }

    /**
     * @param mixed $movies
     */
    public function setMovies($movies)
    {
        $this->movies = $movies;
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fullName
     *
     * @param string $fullName
     *
     * @return Regisseur
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;

        return $this;
    }

    /**
     * Get fullName
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     *
     * @return Regisseur
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    public function __toString()
    {
        return $this->fullName;
    }
}

