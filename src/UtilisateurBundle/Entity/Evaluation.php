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
     *@ORM\ManyToOne (targetEntity="UtilisateurBundle\Entity\Evenement", inversedBy="reservations")
     *@ORM\JoinColumn(name="ID_Evenement", referencedColumnName="ID")
     */
    private $idEvenement;

    /**
     *@ORM\ManyToOne (targetEntity="UtilisateurBundle\Entity\User")
     *@ORM\JoinColumn(name="ID_User", referencedColumnName="id")
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
     * @ORM\Column(name="ID_Evaluation", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idEvaluation;


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
     * Get idEvaluation
     *
     * @return integer
     */
    public function getIdEvaluation()
    {
        return $this->idEvaluation;
    }

    /**
     * Set idEvenement
     *
     * @param \UtilisateurBundle\Entity\Evenement $idEvenement
     *
     * @return Evaluation
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
     * Set idUser
     *
     * @param \UtilisateurBundle\Entity\User $idUser
     *
     * @return Evaluation
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
}
