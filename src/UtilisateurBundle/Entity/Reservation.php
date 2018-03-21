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


}

