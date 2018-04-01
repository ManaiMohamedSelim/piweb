<?php

namespace UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="fk_document_id", columns={"id_document"}), @ORM\Index(name="fk_collocation_id", columns={"id_collocation"}), @ORM\Index(name="fk_covoiturage_id", columns={"id_covoiturage"}), @ORM\Index(name="fk_event_id", columns={"ID_Evenement"}), @ORM\Index(name="id_user", columns={"id_user"}), @ORM\Index(name="id_reclamation", columns={"id_topic"})})
 * @ORM\Entity
 */
class Commentaire
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_collocation", type="integer", nullable=true)
     */
    private $idCollocation;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_covoiturage", type="integer", nullable=true)
     */
    private $idCovoiturage;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Evenement", type="integer", nullable=true)
     */
    private $idEvenement;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Post", type="datetime", nullable=true)
     */
    private $post = 'CURRENT_TIMESTAMP';

    /**
     * @var string
     *
     * @ORM\Column(name="Contenu", type="string", length=255, nullable=false)
     */
    private $contenu;

    /**
     * @var string
     *
     * @ORM\Column(name="Etat_Commentaire", type="string", length=255, nullable=true)
     */
    private $etatCommentaire;

    /**
     * @var integer
     *
     * @ORM\Column(name="rating", type="integer", nullable=true)
     */
    private $rating;

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
     *   @ORM\JoinColumn(name="id_user", referencedColumnName="id")
     * })
     */
    private $idUser;

    /**
     * @var \UtilisateurBundle\Entity\Document
     *
     * @ORM\ManyToOne(targetEntity="UtilisateurBundle\Entity\Document")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_document", referencedColumnName="id")
     * })
     */
    private $idDocument;

    /**
     * @var \UtilisateurBundle\Entity\Topic
     *
     * @ORM\ManyToOne(targetEntity="UtilisateurBundle\Entity\Topic")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_topic", referencedColumnName="id")
     * })
     */
    private $idTopic;


}

