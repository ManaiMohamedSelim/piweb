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


}

