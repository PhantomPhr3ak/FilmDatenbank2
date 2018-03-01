<?php

namespace AppBundle\Entity\Movies;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Movies\Regisseur;

/**
 * Movie
 *
 * @ORM\Table(name="movies_movie")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Movies\MovieRepository")
 */
class Movie
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Movies\Regisseur", inversedBy="movies")
     * @ORM\JoinColumn(name="regisseur", referencedColumnName="id")
     */
    private $regisseur;

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
     * @return Movie
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Movie
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Movie
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set regisseur
     *
     * @param integer $regisseur
     *
     * @return Movie
     */
    public function setRegisseur($regisseur)
    {
        $this->regisseur = $regisseur;

        return $this;
    }

    /**
     * Get regisseur
     *
     * @return int
     */
    public function getRegisseur()
    {
        return $this->regisseur;
    }
}