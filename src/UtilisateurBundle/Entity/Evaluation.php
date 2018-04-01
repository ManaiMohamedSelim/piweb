<?php

namespace UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Evaluation
 *
 * @ORM\Table(name="evaluation")
 * @ORM\Entity
 */
class Evaluation
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
     * @ORM\Column(name="ID_User", type="integer", nullable=false)
     */
    private $idUser;

    /**
     * @var integer
     *
     * @ORM\Column(name="Note", type="integer", nullable=true)
     */
    private $note;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Commentaire", type="integer", nullable=true)
     */
    private $idCommentaire;

    /**
     * @var string
     *
     * @ORM\Column(name="Etat_Commentaire", type="string", length=255, nullable=true)
     */
    private $etatCommentaire;

    /**
     * @var integer
     *
     * @ORM\Column(name="ID_Evaluation", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvaluation;



    /**
     * Set idEvenement
     *
     * @param integer $idEvenement
     *
     * @return Evaluation
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
     * Set idUser
     *
     * @param integer $idUser
     *
     * @return Evaluation
     */
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;

        return $this;
    }

    /**
     * Get idUser
     *
     * @return integer
     */
    public function getIdUser()
    {
        return $this->idUser;
    }

    /**
     * Set note
     *
     * @param integer $note
     *
     * @return Evaluation
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return integer
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set idCommentaire
     *
     * @param integer $idCommentaire
     *
     * @return Evaluation
     */
    public function setIdCommentaire($idCommentaire)
    {
        $this->idCommentaire = $idCommentaire;

        return $this;
    }

    /**
     * Get idCommentaire
     *
     * @return integer
     */
    public function getIdCommentaire()
    {
        return $this->idCommentaire;
    }

    /**
     * Set etatCommentaire
     *
     * @param string $etatCommentaire
     *
     * @return Evaluation
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
     * Get idEvaluation
     *
     * @return integer
     */
    public function getIdEvaluation()
    {
        return $this->idEvaluation;
    }
}
