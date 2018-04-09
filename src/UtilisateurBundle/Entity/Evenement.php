<?php

namespace UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Evenement
 *
 * @ORM\Table(name="evenement")
 * @ORM\Entity(repositoryClass="UtilisateurBundle\Entity\EvenementRepository")
 * @Vich\Uploadable
 */
class Evenement
{

    /**
     * @var integer
     *
     * @ORM\Column(name="ID", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     *@ORM\ManyToOne (targetEntity="UtilisateurBundle\Entity\User")
     *@ORM\JoinColumn(name="ID_Organisateur", referencedColumnName="id")
     */
    private $idOrganisateur;

    /**
     * @var string
     * @ORM\Column(name="Nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @var string
     * @Assert\Choice(
     *     choices = { "Associatif", "Culturel", "Autres" },
     *     message = "Veuillez choisir un type pour votre événement."
     * )
     * @ORM\Column(name="Type", type="string", length=255, nullable=false)
     */
    private $type;

    /**
     * @var string
     * @Assert\Choice(
     *     choices = { "Gratuite", "Payante" },
     *     message = "Veuillez choisir un type de réservation."
     * )
     * @ORM\Column(name="Type_Reservation", type="string", length=255, nullable=false)
     */
    private $typeReservation;

    /**
     * @var \DateTime
     * @Assert\GreaterThanOrEqual(
     *     value = "now",
     *     message = "Veuillez choisir une date valide."
     * )
     * @ORM\Column(name="Date_Event", type="datetime", nullable=false)
     */
    private $dateEvent;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern     = "/^[a-zA-Z0-9 ]+$/",
     *     match=true,
     *     message="Veuillez un choisir une durée valide."
     * )
     * @ORM\Column(name="Duree", type="string", length=255, nullable=false)
     */
    private $duree;

    /**
     * @var string
     * @Assert\Regex(
     *     pattern     = "/^[a-zA-Z0-9 ]+$/",
     *     match=true,
     *     message="Veuillez un choisir une localisation valide"
     * )
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
     * @Assert\Length(max=255)
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
     * @Assert\Image(
     *     maxSize="5M",
     *     mimeTypesMessage = "Veuillez uploader un fichier de type Image"
     * )
     * @Vich\UploadableField(mapping="event_affiche", fileNameProperty="affiche")
     */
    private $afficheFile;

    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="Etat", type="string", length=255, nullable=false)
     */
    private $etat;

    /**
     * @var integer
     * @Assert\GreaterThanOrEqual(
     *     value = "1",
     *     message = "Veuillez choisir un entier valide."
     * )
     * @ORM\Column(name="Prix", type="integer", nullable=true)
     */
    private $prix;


    /**
     * @ORM\OneToMany (targetEntity="UtilisateurBundle\Entity\Commentaire", mappedBy="idEvenement")
     */
    private $commentaires;

    /**
     * @ORM\OneToMany (targetEntity="UtilisateurBundle\Entity\Reservation", mappedBy="idEvenement")
     */
    private $reservations;

    /**
     * @ORM\OneToMany (targetEntity="UtilisateurBundle\Entity\Evaluation", mappedBy="idEvenement")
     */
    private $evaluations;


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

    public function setAfficheFile(File $affiche = null)
    {
        $this->afficheFile = $affiche;

        if ($affiche) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }

    }

    public function getAfficheFile()
    {
        return $this->afficheFile;
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
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->commentaires = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add commentaire
     *
     * @param \UtilisateurBundle\Entity\Commentaire $commentaire
     *
     * @return Evenement
     */
    public function addCommentaire(\UtilisateurBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param \UtilisateurBundle\Entity\Commentaire $commentaire
     */
    public function removeCommentaire(\UtilisateurBundle\Entity\Commentaire $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Add reservation
     *
     * @param \UtilisateurBundle\Entity\Reservation $reservation
     *
     * @return Evenement
     */
    public function addReservation(\UtilisateurBundle\Entity\Reservation $reservation)
    {
        $this->reservations[] = $reservation;

        return $this;
    }

    /**
     * Remove reservation
     *
     * @param \UtilisateurBundle\Entity\Reservation $reservation
     */
    public function removeReservation(\UtilisateurBundle\Entity\Reservation $reservation)
    {
        $this->reservations->removeElement($reservation);
    }

    /**
     * Get reservations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReservations()
    {
        return $this->reservations;
    }

    /**
     * Add evaluation
     *
     * @param \UtilisateurBundle\Entity\Evaluation $evaluation
     *
     * @return Evenement
     */
    public function addEvaluation(\UtilisateurBundle\Entity\Evaluation $evaluation)
    {
        $this->evaluations[] = $evaluation;

        return $this;
    }

    /**
     * Remove evaluation
     *
     * @param \UtilisateurBundle\Entity\Evaluation $evaluation
     */
    public function removeEvaluation(\UtilisateurBundle\Entity\Evaluation $evaluation)
    {
        $this->evaluations->removeElement($evaluation);
    }

    /**
     * Get evaluations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEvaluations()
    {
        return $this->evaluations;
    }

    /**
     * Set idOrganisateur
     *
     * @param \UtilisateurBundle\Entity\User $idOrganisateur
     *
     * @return Evenement
     */
    public function setIdOrganisateur(\UtilisateurBundle\Entity\User $idOrganisateur = null)
    {
        $this->idOrganisateur = $idOrganisateur;

        return $this;
    }

    /**
     * Get idOrganisateur
     *
     * @return \UtilisateurBundle\Entity\User
     */
    public function getIdOrganisateur()
    {
        return $this->idOrganisateur;
    }
}
