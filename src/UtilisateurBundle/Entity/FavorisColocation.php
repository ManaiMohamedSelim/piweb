<?php

namespace UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FavorisColocation
 *
 * @ORM\Table(name="favoris_colocation", indexes={@ORM\Index(name="id_colocation", columns={"id_colocation"}), @ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class FavorisColocation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_fav", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idFav;

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
     * @var \UtilisateurBundle\Entity\Colocation
     *
     * @ORM\ManyToOne(targetEntity="ColocationBundle\Entity\Colocation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_colocation", referencedColumnName="id")
     * })
     */
    private $idColocation;



    /**
     * Get idFav
     *
     * @return integer
     */
    public function getIdFav()
    {
        return $this->idFav;
    }

    /**
     * Set idUser
     *
     * @param \UtilisateurBundle\Entity\User $idUser
     *
     * @return FavorisColocation
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
     * Set idColocation
     *
     * @param \UtilisateurBundle\Entity\Colocation $idColocation
     *
     * @return FavorisColocation
     */
    public function setIdColocation(\ColocationBundle\Entity\Colocation $idColocation = null)
    {
        $this->idColocation = $idColocation;

        return $this;
    }

    /**
     * Get idColocation
     *
     * @return \UtilisateurBundle\Entity\Colocation
     */
    public function getIdColocation()
    {
        return $this->idColocation;
    }
}
