<?php
/**
 * Created by PhpStorm.
 * User: selim
 * Date: 06/04/2018
 * Time: 17:31
 */

namespace UtilisateurBundle\Entity;


use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    public function getUsers(){
        $query=$this->getEntityManager()->createQuery("Select u from UtilisateurBundle:User u ");

        return $query->getResult();
    }

}