<?php

namespace UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Covoiturage
 *
 * @ORM\Table(name="covoiturage", indexes={@ORM\Index(name="id_u", columns={"id_u"})})
 * @ORM\Entity(repositoryClass="CovoiturageBundle\Repository\CovoiturageRepository")
 */
class Covoiturage
{
    /**
     * @var string
     *
     * @ORM\Column(name="depart", type="string", length=100, nullable=false)
     */
    private $depart;

    /**
     * @var string
     *
     * @ORM\Column(name="destination", type="string", length=100, nullable=false)
     */
    private $destination;

    /**
     * @var boolean
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="etat", type="boolean", nullable=false)
     */
    private $etat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vue", type="boolean", nullable=false)
     */
    private $vue;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \UtilisateurBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="UtilisateurBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_u", referencedColumnName="id")
     * })
     */
    private $idU;



    /**
     * Set depart
     *
     * @param string $depart
     *
     * @return Covoiturage
     */
    public function setDepart($depart)
    {
        $this->depart = $depart;

        return $this;
    }

    /**
     * Get depart
     *
     * @return string
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * Set destination
     *
     * @param string $destination
     *
     * @return Covoiturage
     */
    public function setDestination($destination)
    {
        $this->destination = $destination;

        return $this;
    }

    /**
     * Get destination
     *
     * @return string
     */
    public function getDestination()
    {
        return $this->destination;
    }

    /**
     * Set type
     *
     * @param boolean $type
     *
     * @return Covoiturage
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set etat
     *
     * @param boolean $etat
     *
     * @return Covoiturage
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return boolean
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Covoiturage
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
     * Set vue
     *
     * @param boolean $vue
     *
     * @return Covoiturage
     */
    public function setVue($vue)
    {
        $this->vue = $vue;

        return $this;
    }

    /**
     * Get vue
     *
     * @return boolean
     */
    public function getVue()
    {
        return $this->vue;
    }

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
     * Set idU
     *
     * @param \UtilisateurBundle\Entity\User $idU
     *
     * @return Covoiturage
     */
    public function setIdU(\UtilisateurBundle\Entity\User $idU = null)
    {
        $this->idU = $idU;

        return $this;
    }

    /**
     * Get idU
     *
     * @return \UtilisateurBundle\Entity\User
     */
    public function getIdU()
    {
        return $this->idU;
    }
}
