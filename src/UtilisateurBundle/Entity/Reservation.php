<?php

namespace UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity
 */
class Reservation
{
    /**
     *@ORM\ManyToOne (targetEntity="UtilisateurBundle\Entity\Evenement", inversedBy="reservations")
     *@ORM\JoinColumn(name="ID_Evenement", referencedColumnName="ID")
     */
    private $idEvenement;

    /**
     *@ORM\ManyToOne (targetEntity="UtilisateurBundle\Entity\User")
     *@ORM\JoinColumn(name="ID_Participant", referencedColumnName="id")
     */
    private $idParticipant;

    /**
     * @var string
     *
     * @ORM\Column(name="Type_Reservation", type="string", length=255, nullable=false)
     */
    private $typeReservation;

    /**
     * @var float
     *
     * @ORM\Column(name="Tarif", type="float", precision=10, scale=0, nullable=true)
     */
    private $tarif;

    /**
     * @var string
     *
     * @ORM\Column(name="Numero_Ticket", type="string", length=255, nullable=true)
     */
    private $numeroTicket;

    /**
     * @var string
     *
     * @ORM\Column(name="Etat", type="string", length=255, nullable=false)
     */
    private $etat;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Reservation", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idReservation;

    /**
     * Set typeReservation
     *
     * @param string $typeReservation
     *
     * @return Reservation
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
     * Set tarif
     *
     * @param float $tarif
     *
     * @return Reservation
     */
    public function setTarif($tarif)
    {
        $this->tarif = $tarif;

        return $this;
    }

    /**
     * Get tarif
     *
     * @return float
     */
    public function getTarif()
    {
        return $this->tarif;
    }

    /**
     * Set numeroTicket
     *
     * @param string $numeroTicket
     *
     * @return Reservation
     */
    public function setNumeroTicket($numeroTicket)
    {
        $this->numeroTicket = $numeroTicket;

        return $this;
    }

    /**
     * Get numeroTicket
     *
     * @return string
     */
    public function getNumeroTicket()
    {
        return $this->numeroTicket;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Reservation
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
     * Get idReservation
     *
     * @return integer
     */
    public function getIdReservation()
    {
        return $this->idReservation;
    }

    /**
     * Set idEvenement
     *
     * @param \UtilisateurBundle\Entity\Evenement $idEvenement
     *
     * @return Reservation
     */
    public function setIdEvenement(\UtilisateurBundle\Entity\Evenement $idEvenement = null)
    {
        $this->idEvenement = $idEvenement;

        return $this;
    }

    /**
     * Get idEvenement
     *
     * @return \UtilisateurBundle\Entity\Evenement
     */
    public function getIdEvenement()
    {
        return $this->idEvenement;
    }


    /**
     * Set idParticipant
     *
     * @param \UtilisateurBundle\Entity\User $idParticipant
     *
     * @return Reservation
     */
    public function setIdParticipant(\UtilisateurBundle\Entity\User $idParticipant = null)
    {
        $this->idParticipant = $idParticipant;

        return $this;
    }

    /**
     * Get idParticipant
     *
     * @return \UtilisateurBundle\Entity\User
     */
    public function getIdParticipant()
    {
        return $this->idParticipant;
    }
}
