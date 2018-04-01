<?php

namespace UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Colocation
 *
 * @ORM\Table(name="colocation", indexes={@ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity
 */
class Colocation
{
    /**
     * @var string
     *
     * @ORM\Column(name="type_colocation", type="string", length=20, nullable=true)
     */
    private $typeColocation;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=100, nullable=true)
     */
    private $adresse;

    /**
     * @var float
     *
     * @ORM\Column(name="prix", type="float", precision=10, scale=0, nullable=true)
     */
    private $prix;

    /**
     * @var integer
     *
     * @ORM\Column(name="place_dispo", type="integer", nullable=true)
     */
    private $placeDispo;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=1, nullable=true)
     */
    private $sexe;

    /**
     * @var string
     *
     * @ORM\Column(name="type_maison", type="string", length=20, nullable=true)
     */
    private $typeMaison;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=30, nullable=true)
     */
    private $path;

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
     * Set typeColocation
     *
     * @param string $typeColocation
     *
     * @return Colocation
     */
    public function setTypeColocation($typeColocation)
    {
        $this->typeColocation = $typeColocation;

        return $this;
    }

    /**
     * Get typeColocation
     *
     * @return string
     */
    public function getTypeColocation()
    {
        return $this->typeColocation;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Colocation
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set prix
     *
     * @param float $prix
     *
     * @return Colocation
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set placeDispo
     *
     * @param integer $placeDispo
     *
     * @return Colocation
     */
    public function setPlaceDispo($placeDispo)
    {
        $this->placeDispo = $placeDispo;

        return $this;
    }

    /**
     * Get placeDispo
     *
     * @return integer
     */
    public function getPlaceDispo()
    {
        return $this->placeDispo;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Colocation
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set typeMaison
     *
     * @param string $typeMaison
     *
     * @return Colocation
     */
    public function setTypeMaison($typeMaison)
    {
        $this->typeMaison = $typeMaison;

        return $this;
    }

    /**
     * Get typeMaison
     *
     * @return string
     */
    public function getTypeMaison()
    {
        return $this->typeMaison;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Colocation
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
     * Set path
     *
     * @param string $path
     *
     * @return Colocation
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
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
     * @return Colocation
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
