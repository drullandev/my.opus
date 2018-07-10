<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Topics
 *
 * @ORM\Table(name="topics")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TopicsRepository")
 */
class Topics
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
     * @ORM\Column(name="value", type="string", length=64, unique=true)
     */
    private $value;

    /**
     * @var int
     *
     * @ORM\Column(name="idrelated", type="integer", nullable=true)
     */
    private $idrelated;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return Topics
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set idrelated
     *
     * @param integer $idrelated
     * @return Topics
     */
    public function setIdrelated($idrelated)
    {
        $this->idrelated = $idrelated;

        return $this;
    }

    /**
     * Get idrelated
     *
     * @return integer 
     */
    public function getIdrelated()
    {
        return $this->idrelated;
    }
}
