<?php

namespace UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation", indexes={@ORM\Index(name="fk_event_res_id", columns={"ID_Evenement"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Evenement", type="integer", nullable=false)
     */
    private $idEvenement;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Participant", type="integer", nullable=false)
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
     * Set idEvenement
     *
     * @param integer $idEvenement
     *
     * @return Reservation
     */
    public function setIdEvenement($idEvenement)
    {
        $this->idEvenement = $idEvenement;

        return $this;
    }

    /**
     * Get idEvenement
     *
     * @return integer
     */
    public function getIdEvenement()
    {
        return $this->idEvenement;
    }

    /**
     * Set idParticipant
     *
     * @param integer $idParticipant
     *
     * @return Reservation
     */
    public function setIdParticipant($idParticipant)
    {
        $this->idParticipant = $idParticipant;

        return $this;
    }

    /**
     * Get idParticipant
     *
     * @return integer
     */
    public function getIdParticipant()
    {
        return $this->idParticipant;
    }

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
}
