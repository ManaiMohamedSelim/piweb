<?php

namespace UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire", indexes={@ORM\Index(name="fk_document_id", columns={"id_document"}), @ORM\Index(name="fk_collocation_id", columns={"id_collocation"}), @ORM\Index(name="fk_covoiturage_id", columns={"id_covoiturage"}), @ORM\Index(name="id_user", columns={"id_user"}), @ORM\Index(name="id_reclamation", columns={"id_topic"})})
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
     *@ORM\Column(name="id_covoiturage", type="integer", nullable=true)
     */
    private $idCovoiturage;

    /**
     *@ORM\ManyToOne (targetEntity="UtilisateurBundle\Entity\Evenement", inversedBy="commentaires")
     *@ORM\JoinColumn(name="ID_Evenement", referencedColumnName="ID")
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



    /**
     * Set idCollocation
     *
     * @param integer $idCollocation
     *
     * @return Commentaire
     */
    public function setIdCollocation($idCollocation)
    {
        $this->idCollocation = $idCollocation;

        return $this;
    }

    /**
     * Get idCollocation
     *
     * @return integer
     */
    public function getIdCollocation()
    {
        return $this->idCollocation;
    }

    /**
     * Set idCovoiturage
     *
     * @param integer $idCovoiturage
     *
     * @return Commentaire
     */
    public function setIdCovoiturage($idCovoiturage)
    {
        $this->idCovoiturage = $idCovoiturage;

        return $this;
    }

    /**
     * Get idCovoiturage
     *
     * @return integer
     */
    public function getIdCovoiturage()
    {
        return $this->idCovoiturage;
    }


    /**
     * Set post
     *
     * @param \DateTime $post
     *
     * @return Commentaire
     */
    public function setPost($post)
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get post
     *
     * @return \DateTime
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * Set contenu
     *
     * @param string $contenu
     *
     * @return Commentaire
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;

        return $this;
    }

    /**
     * Get contenu
     *
     * @return string
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * Set etatCommentaire
     *
     * @param string $etatCommentaire
     *
     * @return Commentaire
     */
    public function setEtatCommentaire($etatCommentaire)
    {
        $this->etatCommentaire = $etatCommentaire;

        return $this;
    }

    /**
     * Get etatCommentaire
     *
     * @return string
     */
    public function getEtatCommentaire()
    {
        return $this->etatCommentaire;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     *
     * @return Commentaire
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer
     */
    public function getRating()
    {
        return $this->rating;
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
     * Set idUser
     *
     * @param \UtilisateurBundle\Entity\User $idUser
     *
     * @return Commentaire
     */
    public function setIdUser(\UtilisateurBundle\Entity\User $idUser = null)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return \UtilisateurBundle\Entity\User
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set idDocument
     *
     * @param \UtilisateurBundle\Entity\Document $idDocument
     *
     * @return Commentaire
     */
    public function setIdDocument(\UtilisateurBundle\Entity\Document $idDocument = null)
    {
        $this->idDocument = $idDocument;

        return $this;
    }

    /**
     * Get idDocument
     *
     * @return \UtilisateurBundle\Entity\Document
     */
    public function getIdDocument()
    {
        return $this->idDocument;
    }

    /**
     * Set idTopic
     *
     * @param \UtilisateurBundle\Entity\Topic $idTopic
     *
     * @return Commentaire
     */
    public function setIdTopic(\UtilisateurBundle\Entity\Topic $idTopic = null)
    {
        $this->idTopic = $idTopic;

        return $this;
    }

    /**
     * Get idTopic
     *
     * @return \UtilisateurBundle\Entity\Topic
     */
    public function getIdTopic()
    {
        return $this->idTopic;
    }

    /**
     * Set idEvenement
     *
     * @param \UtilisateurBundle\Entity\Evenement $idEvenement
     *
     * @return Commentaire
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
}
