<?php

namespace UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity
 */
class Evenement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Organisateur", type="integer", nullable=false)
     */
    private $idOrganisateur = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="Nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="Type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_Reservation", type="string", length=255, nullable=false)
     */
    private $typeReservation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Event", type="datetime", nullable=true)
     */
    private $dateEvent;

    /**
     * @var string
     *
     * @ORM\Column(name="Duree", type="string", length=255, nullable=false)
     */
    private $duree;

    /**
     * @var string
     *
     * @ORM\Column(name="Lieu", type="string", length=255, nullable=false)
     */
    private $lieu;

    /**
     * @var integer
     *
     * @ORM\Column(name="Nombre", type="integer", nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="Affiche", type="string", length=255, nullable=false)
     */
    private $affiche;

    /**
     * @var string
     *
     * @ORM\Column(name="Etat", type="string", length=255, nullable=false)
     */
    private $etat;

    /**
     * @var integer
     *
     * @ORM\Column(name="Prix", type="integer", nullable=false)
     */
    private $prix = '0';

    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set idOrganisateur
     *
     * @param integer $idOrganisateur
     *
     * @return Evenement
     */
    public function setIdOrganisateur($idOrganisateur)
    {
        $this->idOrganisateur = $idOrganisateur;

        return $this;
    }

    /**
     * Get idOrganisateur
     *
     * @return integer
     */
    public function getIdOrganisateur()
    {
        return $this->idOrganisateur;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Evenement
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Evenement
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set typeReservation
     *
     * @param string $typeReservation
     *
     * @return Evenement
     */
    public function setTypeReservation($typeReservation)
    {
        $this->typeReservation = $typeReservation;

        return $this;
    }

    /**
     * Get typeReservation
     *
     * @return string
     */
    public function getTypeReservation()
    {
        return $this->typeReservation;
    }

    /**
     * Set dateEvent
     *
     * @param \DateTime $dateEvent
     *
     * @return Evenement
     */
    public function setDateEvent($dateEvent)
    {
        $this->dateEvent = $dateEvent;

        return $this;
    }

    /**
     * Get dateEvent
     *
     * @return \DateTime
     */
    public function getDateEvent()
    {
        return $this->dateEvent;
    }

    /**
     * Set duree
     *
     * @param string $duree
     *
     * @return Evenement
     */
    public function setDuree($duree)
    {
        $this->duree = $duree;

        return $this;
    }

    /**
     * Get duree
     *
     * @return string
     */
    public function getDuree()
    {
        return $this->duree;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return Evenement
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set nombre
     *
     * @param integer $nombre
     *
     * @return Evenement
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return integer
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Evenement
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
     * Set affiche
     *
     * @param string $affiche
     *
     * @return Evenement
     */
    public function setAffiche($affiche)
    {
        $this->affiche = $affiche;

        return $this;
    }

    /**
     * Get affiche
     *
     * @return string
     */
    public function getAffiche()
    {
        return $this->affiche;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Evenement
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set prix
     *
     * @param integer $prix
     *
     * @return Evenement
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer
     */
    public function getPrix()
    {
        return $this->prix;
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
}
