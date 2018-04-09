<?php

namespace UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reclamation
 *
 * @ORM\Table(name="reclamation")
 * @ORM\Entity
 */
class Reclamation
{
    /**
     * @var string
     *
     * @ORM\Column(name="objet", type="string", length=30, nullable=false)
     */
    private $objet;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

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
     * @ORM\ManyToOne(targetEntity="UtilisateurBundle\Entity\User",inversedBy="reclamations")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;


    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="text", nullable=false)
     */
    private $etat="attente";


    /**
     * Set objet
     *
     * @param string $objet
     *
     * @return Reclamation
     */
    public function setObjet($objet)
    {
        $this->objet = $objet;

        return $this;
    }

    /**
     * Get objet
     *
     * @return string
     */
    public function getObjet()
    {
        return $this->objet;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Reclamation
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Reclamation
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set idUser.
     *
     * @param \UtilisateurBundle\Entity\User|null $idUser
     *
     * @return Reclamation
     */
    public function setIdUser(\UtilisateurBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser.
     *
     * @return \UtilisateurBundle\Entity\User|null
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set etat.
     *
     * @param string $etat
     *
     * @return Reclamation
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat.
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }
}
