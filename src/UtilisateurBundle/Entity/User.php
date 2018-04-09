<?php
/**
 * Created by PhpStorm.
 * User: Manai
 * Date: 13/03/2018
 * Time: 02:41
 */

namespace UtilisateurBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Mgilet\NotificationBundle\Annotation\Notifiable;
use Mgilet\NotificationBundle\NotifiableInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="UtilisateurBundle\Entity\UserRepository")
 * @Notifiable(name="user")
 */
class User extends BaseUser implements  NotifiableInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $niveau;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $photo;

    /**
     * @ORM\OneToMany(targetEntity="UtilisateurBundle\Entity\Reclamation", mappedBy="idUser")
     */
    private $reclamations;


    /**
     * Set niveau
     *
     * @param string $niveau
     *
     * @return User
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
     * Set photo
     *
     * @param string $photo
     *
     * @return User
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Add reclamation
     *
     * @param \UtilisateurBundle\Entity\Reclamation $reclamation
     *
     * @return User
     */
    public function addReclamation(\UtilisateurBundle\Entity\Reclamation $reclamation)
    {
        $this->reclamations[] = $reclamation;

        return $this;
    }

    /**
     * Remove reclamation
     *
     * @param \UtilisateurBundle\Entity\Reclamation $reclamation
     */
    public function removeReclamation(\UtilisateurBundle\Entity\Reclamation $reclamation)
    {
        $this->reclamations->removeElement($reclamation);
    }

    /**
     * Get reclamations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReclamations()
    {
        return $this->reclamations;
    }
}
