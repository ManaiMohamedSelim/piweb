<?php

namespace UtilisateurBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Document
 *
 * @ORM\Table(name="document", indexes={@ORM\Index(name="id_user", columns={"id_user"})})
 * @ORM\Entity(repositoryClass="DocumentBundle\Repository\documentRepository")
 */
class Document
{
    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=50, nullable=false)
     */
    private $titre;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=50, nullable=true)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="niveau", type="string", length=11, nullable=true)
     */
    private $niveau;

    /**
     * @var string
     *
     * @ORM\Column(name="matiere", type="string", length=50, nullable=true)
     */
    private $matiere;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255, nullable=true)
     */
    private $etat;

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
     * @Assert\File(maxSize="6000000")
     */
    private  $file;




    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Document
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Document
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
     * @return Document
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
     * Set niveau
     *
     * @param string $niveau
     *
     * @return Document
     */
    public function setNiveau($niveau)
    {
        $this->niveau = $niveau;

        return $this;
    }

    /**
     * Get niveau
     *
     * @return string
     */
    public function getNiveau()
    {
        return $this->niveau;
    }

    /**
     * Set matiere
     *
     * @param string $matiere
     *
     * @return Document
     */
    public function setMatiere($matiere)
    {
        $this->matiere = $matiere;

        return $this;
    }

    /**
     * Get matiere
     *
     * @return string
     */
    public function getMatiere()
    {
        return $this->matiere;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Document
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
     * @return Document
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

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../piweb/web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the _DIR_ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads';
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFile()->getClientOriginalName()
        );

        // set the path property to the filename where you've saved the file
        $this->path = $this->getFile()->getClientOriginalName();

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }

}
