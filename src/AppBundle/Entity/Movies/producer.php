<?php

namespace AppBundle\Entity\Movies;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * producer
 *
 * @ORM\Table(name="moviesproducer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Movies\producerRepository")
 */
class producer
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="website", type="string", length=255, nullable=true, unique=true)
     */
    private $website;

    /**
     * @var array
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Movies\Movie", mappedBy="producer")
     */
    private $movies;

    public function __construct()
    {
        $this->movies = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return producer
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return producer
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set movies
     *
     * @param array $movies
     *
     * @return producer
     */
    public function setMovies($movies)
    {
        $this->movies = $movies;

        return $this;
    }

    /**
     * Get movies
     *
     * @return array
     */
    public function getMovies()
    {
        return $this->movies;
    }

    public function __toString()
    {
        return (string)$this->name;
    }
}

